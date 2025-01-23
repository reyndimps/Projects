<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Inventory;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use App\Models\StockTransaction;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function admin()
    {
        $user = User::count();
        $product = Product::count();
        $supplier = Supplier::count();
        $stockTransaction = StockTransaction::count();
        $weekDays = collect(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']);
        $weeklySales = SalesOrderItem::selectRaw('DAYNAME(created_at) as day, SUM(quantity) as total_sold')
            ->groupBy('day')
            ->orderByRaw('FIELD(DAYNAME(created_at), "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday")')
            ->get()
            ->pluck('total_sold', 'day');
        $salesCounts = $weekDays->map(fn($day) => $weeklySales->get($day, 0));
        return view('admin.dashboard', compact('user', 'product', 'supplier', 'stockTransaction', 'weekDays', 'salesCounts'));
    }
    
    
    


    public function index(Request $request)
    {
        $search = $request->input('search'); 
        $category = $request->input('category', 'all'); 
    
        $products = Product::with('inventory')
            ->when($search, function ($query, $search) {
                $query->where('product', 'like', '%' . $search . '%')
                      ->orWhereHas('inventory', function ($query) use ($search) {
                          $query->where('product_code', 'like', '%' . $search . '%');
                      });
            })
            ->when($category && $category !== 'all', function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->get();            
         
    
        $productcount = Product::count(); 
        
        $inventory = Inventory::latest('updated_at')->first(); 
    
        return view('user.dashboard', compact('products', 'productcount', 'inventory', 'category', 'search'));
    }
}
