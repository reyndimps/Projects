<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $suppliers = Supplier::latest()->when($search, function ($query, $search) {
            return $query->where('company', 'like', '%' . $search . '%')
                         ->orWhere('name', 'like', '%' . $search . '%')
                         ->orWhere('industry_type', 'like', '%' . $search . '%')
                         ->orWhere('country', 'like', '%' . $search . '%');
        })
             ->paginate(8); 
        return view('admin.supplier', compact('suppliers'));
    }

    public function create()
    {
        return view('admin.supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email',
            'phone' => 'required|string|max:11',
            'address' => 'required|string',
            'industry_type' => 'required|string',
            'country' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $supplier = new Supplier($request->only([
            'company', 'name', 'email', 'phone', 
            'address', 'industry_type', 'country', 'status'
        ]));


        $supplier->save();

        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully!');
    }

    public function edit(Supplier $supplier)
    {
        return view('admin.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'company' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email,' . $supplier->id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'industry_type' => 'required|string',
            'country' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $supplier->update($request->only([
            'company', 'name', 'email', 'phone',
            'address', 'industry_type', 'country', 'status'
        ]));


        $supplier->save();

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully!');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully!');
    }

}
