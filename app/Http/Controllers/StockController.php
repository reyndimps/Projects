<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockTransaction;
use Carbon\Carbon;
use App\Models\Inventory;
use Illuminate\Support\Facades\Log;


class StockController extends Controller
{ 
    public function stocksTransaction(Request $request)
    {
        $search = $request->input('search');

        $transactions = StockTransaction::with('product.inventory', 'product.supplier')
            ->when($search, function ($query, $search) {
                return $query->whereHas('product', function ($query) use ($search) {
                            $query->where('product', 'like', '%' . $search . '%')
                                ->orWhereHas('inventory', function ($query) use ($search) {
                                    $query->where('product_code', 'like', '%' . $search . '%');
                                })
                                ->orWhereHas('supplier', function ($query) use ($search) {
                                    $query->where('name', 'like', '%' . $search . '%');
                                });
                        })
                        ->orWhere('price_updated', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc') 
            ->paginate(8); 
    
        return view('admin.inventory.stocksTransaction', compact('transactions'));
    }
      

    public function updateStocks(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'date_added' => 'required|date',
            'expiration_date' => 'required|date',
            'price' => 'required|numeric|min:0', 
        ]);
    
        $inventory = Inventory::firstOrNew(['product_id' => $productId]);
    
    
        $inventory->quantity += $request->quantity;
        $inventory->date_added = $request->date_added;
        $inventory->expiration_date = $request->expiration_date;
        $inventory->price = $request->price; 

        $inventory->save();

        StockTransaction::create([
            'product_id' => $productId,
            'quantity_changed' => $request->quantity,
            'transaction_date' =>$request->date_added,    
            'expiration_date' => $request->expiration_date, 
            'price_updated' => $request->price, 
        ]);
    
        return redirect()->route('admin.inventory')->with('success', 'Stock updated successfully.');
    }
    
    
    public function destroy($id){

        $transaction = StockTransaction::find($id);
        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaction not found');
        }
    
        $transaction->delete();
        return redirect()->route('stocksTransaction')->with('success', 'Transaction deleted successfully');
    
    }

    public function updateInventory(Request $request, $product_id)
    {
        $inventory = Inventory::where('product_id', $product_id)->first();

        if ($inventory) {
            $inventory->quantity -= $request->input('quantity');

            if ($inventory->quantity < 0) {
                return response()->json(['error' => 'Not enough stock'], 400);
            }
            $inventory->save();

            return response()->json(['success' => 'Inventory updated']);
        } else {
            return response()->json(['error' => 'Product not found in inventory'], 404);
        }
    }
    
}
