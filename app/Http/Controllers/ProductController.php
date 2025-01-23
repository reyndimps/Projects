<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Inventory;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $products = Product::latest()
            ->when($search, function ($query, $search) {
                return $query->where('product', 'like', '%' . $search . '%')
                             ->orWhere('category', 'like', '%' . $search . '%')
                             ->orWhere('brand', 'like', '%' . $search . '%')
                             ->orWhere('original_price', 'like', '%' . $search . '%')
                             ->orWhereHas('supplier', function ($query) use ($search) {
                                 $query->where('name', 'like', '%' . $search . '%');
                             });
            })
            ->with(['supplier']) 
            ->paginate(8); 
    
            $suppliers = Supplier::where('status', 'active')->get();
    
        return view('admin.products', compact('products', 'suppliers'));
    }
    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'supplier' => 'required|exists:suppliers,id',
            'category' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'description' => 'nullable|string',
            'original_price' => 'required|numeric|min:0',
        ]);
    
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
    
        try {
            // Generate product code
            $productCode = strtoupper(substr($request->product, 0, 3)) . strtoupper(Str::random(4)) . rand(10, 99) . '0';
    
            // Create the product
            $product = Product::create([
                'product' => $request->product,
                'image' => 'images/' . $imageName,
                'supplier_id' => $request->supplier,
                'category' => $request->category,
                'brand' => $request->brand,
                'description' => $request->description,
                'original_price' => $request->original_price,
                'product_code' => $productCode,
            ]);
    
            return redirect()->route('products.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the product: ' . $e->getMessage()]);
        }
    }

    
    public function show(Product $product)
    {
        
    }
    public function edit($id)
    {
        $edit = Product::findOrFail($id);
        $suppliers = Supplier::where('status', 'active')->get();
      return view('admin.products.edit', compact('edit', 'suppliers'));
    }
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'supplier' => 'required|exists:suppliers,id', 
            'category' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'description' => 'nullable|string',
            'original_price' => 'required|numeric|min:0',
        ]);
    
        $product->product = $request->product;
        $product->supplier_id = $request->supplier;
        $product->category = $request->category;
        $product->brand = $request->brand;
        $product->description = $request->description;
        $product->original_price = $request->original_price; 
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = 'images/' . $imageName;
        }
        $product->save();
        return redirect()->route('products.index')->with('update', 'Product updated successfully.');
    }
    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('delete', 'The Product was deleted');
    }
}
