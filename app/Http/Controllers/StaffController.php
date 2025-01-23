<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesOrder;
use App\Models\Inventory;
use App\Models\User;
use App\Models\SalesOrderItem;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function transactions()
    {
        $salesorder = SalesOrder::orderBy('created_at', 'desc')->paginate(10);
        return view('user.transaction', compact('salesorder'));
    }
    
    public function warranty(Request $request)
        {
            $search = $request->input('search');
            
            $salesItems = SalesOrderItem::with(['inventory.product'])
                ->whereHas('inventory.product', function ($query) use ($search) {
                    if ($search) {
                        $query->where('product', 'like', "%{$search}%")
                            ->orWhere('product_code', 'like', "%{$search}%");
                    }
                })
                ->orderBy('created_at', 'desc') // Order by latest first
                ->paginate(12); // Add pagination
            
            $salesItems->getCollection()->transform(function ($item) {
                $item->warranty_end_date = $item->created_at->addMonths(2);
                return $item;
            });
            
            return view('user.warranty', compact('salesItems'));
        }

    public function settings()
    {
        $user = Auth::user();
        return view('user.settings', compact('user'));
    }
    
}
