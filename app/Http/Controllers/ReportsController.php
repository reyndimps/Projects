<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\SalesOrderItem;
use App\Models\SalesOrder;
use App\Models\StockTransaction;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportsController extends Controller
{

    public function getWeeklyInventoryData()
    {
        $startOfWeek = Carbon::now()->startOfWeek(); 
        $endOfWeek = Carbon::now()->endOfWeek(); 
    
        $inventoryData = StockTransaction::whereBetween('created_at', [$startOfWeek, $endOfWeek])
                                        ->selectRaw('DAYOFWEEK(stock_transactions.created_at) as day, SUM(quantity_changed) as total_added')
                                        ->groupBy('day')
                                        ->orderBy('day')
                                        ->get();
    
        $salesData = SalesOrderItem::whereHas('salesOrder', function ($query) use ($startOfWeek, $endOfWeek) {
                                        $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                                    })
                                    ->selectRaw('DAYOFWEEK(sales_order_items.created_at) as day, SUM(quantity) as total_sold')
                                    ->groupBy('day')
                                    ->orderBy('day')
                                    ->get();
    
                                    $inventory = Inventory::with('product')->get(); // Get inventory data for all products

                                    $productQuantities = Product::with('inventory')->get()->mapWithKeys(function ($product) use ($inventory) {
                                        // Sum the quantity from the inventory table for the product
                                        $totalQuantity = $inventory->where('product_id', $product->id)->sum('quantity');
                                        return [
                                            $product->id => [
                                                'quantity' => $totalQuantity, // Total quantity available for the product
                                                'product' => $product->product,
                                                'image' => $product->image ? asset($product->image) : null, 
                                            ]
                                        ];
                                    });
    
        $weeklyData = [
            'labels' => [],
            'inventory' => [],
            'sales' => [],
            'product_quantities' => $productQuantities,
        ];
    
        for ($i = 1; $i <= 7; $i++) {
            $weeklyData['labels'][] = $startOfWeek->copy()->addDays($i - 1)->format('l');
            $weeklyData['inventory'][] = $inventoryData->where('day', $i)->first()->total_added ?? 0;
            $weeklyData['sales'][] = $salesData->where('day', $i)->first()->total_sold ?? 0;
        }
    
        return $weeklyData;
    }
    
    public function generateWeeklyReport()
    {
        // Get the start and end of the current week
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
    
        // Get the latest inventory and sales within the week
        $latestInventory = Inventory::whereBetween('date_added', [$startOfWeek, $endOfWeek])
                                     ->latest('date_added')  // Get the most recent inventory
                                     ->get();
    
        $latestSales = SalesOrder::whereBetween('created_at', [$startOfWeek, $endOfWeek])
                                 ->latest('created_at')  // Get the most recent sales
                                 ->get();
    
        $data = [
            'weeklyInventory' => $latestInventory,
            'weeklySales' => $latestSales,
            'startOfWeek' => $startOfWeek->format('F j, Y'),  // Format start of the week as "December 12, 2024"
            'endOfWeek' => $endOfWeek->format('F j, Y'),      // Format end of the week as "December 12, 2024"
        ];
    
        // Load the PDF view with the latest inventory and sales data
        $pdf = Pdf::loadView('reports.weekly_report', $data);
        return $pdf->stream('weekly_inventory_sales_report.pdf');
    }
    
    
    public function reports()
    {
        $weeklyData = $this->getWeeklyInventoryData();
        return view('admin.reports', compact('weeklyData'));
    }
}
