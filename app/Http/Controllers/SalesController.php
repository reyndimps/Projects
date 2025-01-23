<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;

class SalesController extends Controller
{
    public function monthlySales()
    {
        $months = collect([
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ]);

        $sales = SalesOrder::select(
            DB::raw('SUM(total_amount) as total_sales'),
            DB::raw('MONTH(created_at) as month')
        )
        ->groupBy('month')
        ->orderBy('month', 'ASC')
        ->get()
        ->pluck('total_sales', 'month');

        $items = SalesOrder::select(
            DB::raw('SUM(number_items) as total_items'),
            DB::raw('MONTH(created_at) as month')
        )
        ->groupBy('month')
        ->orderBy('month', 'ASC')
        ->get()
        ->pluck('total_items', 'month');

        $monthlyData = $months->mapWithKeys(function ($month, $index) use ($sales, $items) {
            $monthNumber = $index + 1;
            return [
                $month => [
                    'total_sales' => $sales->get($monthNumber, 0),
                    'total_items' => $items->get($monthNumber, 0)
                ]
            ];
        });

        return response()->json($monthlyData);
    }

    public function topItems()
    {
        $topItems = SalesOrderItem::select('inventory_id', DB::raw('SUM(quantity) as total_quantity'))
            ->with('inventory.product')
            ->groupBy('inventory_id')
            ->orderByDesc('total_quantity')
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->inventory->product->name ?? 'Unknown Item',
                    'quantity' => $item->total_quantity,
                ];
            });

        return response()->json($topItems);
    }
}
