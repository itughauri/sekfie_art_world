<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function products()
    {
        $product = Product::orderBy('id', 'desc')->get();
        return view('inventory.products.products', ['product' => $product]);
    }

    public function show_products()
    {
        return view('inventory.products.add');
    }

    public function add_product(Request $request)
    {

        $request->validate([
            'product_name' => 'required',
        ]);
        Product::create([
            'product_name' => $request->product_name,
        ]);

        return redirect('inventory/products')->with('success', 'Product Added Successfully');
    }

    public function edit_products($id)
    {
        $product = Product::find($id);

        return view('inventory.products.edit',[
            'product' => $product
        ]);
    }

    public function update_products(Request $request, $id)
    {
        $product = Product::find($id);
        $product->product_name = $request->product_name;
        $product->save();

        return redirect('inventory/products')->with('update', 'Product Updated Successfully');
    }

    public function delete_products(Request $request)
    {
        $id = $request->product_id;
        Product::destroy($id);
        return redirect()->back()->with('delete', 'Product Deleted successfully');
    }

}
