<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Artisan;


class SalesOrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'total_amount' => 'required|numeric',
            'cash_amount' => 'required|numeric',
            'change_amount' => 'required|numeric',
            'orderList' => 'required|array',
        ]);

        $numberItems = collect($validated['orderList'])->sum('quantity');

        // Define sales tax rate (e.g., 12%)
        $taxRate = 0.06;

        // Calculate the sales tax
        $salesTax = $validated['total_amount'] * $taxRate;

        // Calculate the total with tax
        $totalWithTax = $validated['total_amount'] + $salesTax;

        // Create a new Sales Order
        $salesOrder = new SalesOrder();
        $salesOrder->number_items = $numberItems;
        $salesOrder->total_amount = $totalWithTax; // Store total with tax
        $salesOrder->cash_amount = $validated['cash_amount'];
        $salesOrder->change_amount = $validated['change_amount'];
        $salesOrder->sales_tax = $salesTax; // Save the sales tax
        $salesOrder->save();

        // Save each item in the order
        foreach ($validated['orderList'] as $item) {
            $inventory = Inventory::where('product_id', $item['id'])->first();

            if (!$inventory) {
                return response()->json(['message' => 'Inventory item not found for Product ID ' . $item['id']], 400);
            }

            if ($inventory->quantity < $item['quantity']) {
                return response()->json(['message' => 'Insufficient stock for Product ID ' . $item['id']], 400);
            }

            $salesOrderItem = new SalesOrderItem();
            $salesOrderItem->sales_order_id = $salesOrder->id;
            $salesOrderItem->inventory_id = $inventory->id;
            $salesOrderItem->quantity = $item['quantity'];
            $salesOrderItem->price = $item['price'];
            $salesOrderItem->total = $item['quantity'] * $item['price'];
            $salesOrderItem->save();

            // Deduct quantity from inventory
            $inventory->quantity -= $item['quantity'];
            $inventory->save();
        }

        return response()->json(['message' => 'Order submitted successfully!', 'orderId' => $salesOrder->id], 200);
    }

    public function generateSalesOrderPDF($id)
    {
        // Fetch the sales order and its items, including related product names
        $salesOrder = SalesOrder::with('items.inventory.product')->find($id);

        if (!$salesOrder) {
            return response()->json(['message' => 'Sales order not found'], 404);
        }

        // Prepare data for the PDF
        $data = [
            'salesOrder' => $salesOrder,
            'items' => $salesOrder->items,
            'salesTax' => $salesOrder->sales_tax,
        ];

        // Generate the PDF using a Blade view
        $pdf = Pdf::loadView('receipts.sales', $data);

        // Stream the PDF for download
        return $pdf->stream('sales_order_' . $salesOrder->id . '.pdf');
    }

    
}
