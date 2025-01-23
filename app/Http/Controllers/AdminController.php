<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function sales(){
        return view('admin.sales');
    }

    public function inventory(Request $request)
    {
        $search = $request->input('search');
        
        $products = Product::latest()
            ->when($search, function ($query, $search) {
                return $query->where('product', 'like', '%' . $search . '%')
                             ->orWhereHas('inventory', function ($query) use ($search) {
                                 $query->where('product_code', 'like', '%' . $search . '%')
                                       ->orWhere('price', 'like', '%' . $search . '%');
                             })
                             ->orWhereHas('supplier', function ($query) use ($search) {
                                 $query->where('name', 'like', '%' . $search . '%');
                             });
            })
            ->with(['supplier', 'inventory']) 
            ->paginate(8);
    
        return view('admin.inventory', compact('products'));
    }
    

    public function updateStocks(Request $request, $productId)
    {

    }

    public function onlinecatalog(){
        $products = Product::all();
        return view('admin.onlinecatalog', compact('products'));
    }

    public function accountpay(){
        return view('admin.accountpay');
    }

    public function statistics(){
        return view('admin.statistics');
    }  

    public function help(){
        return view('admin.help');
    }

    public function settings(){
        $user = Auth::user();
        return view('admin.settings', compact('user'));
    }

}
