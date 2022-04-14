<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\Stock;
use App\Models\Vendor;

class PurchaseController extends Controller
{
    public function show_purchase()
    {
        return view('inventory.purchase.add' ,[
            'vendors'  => Vendor::get(),
            'products' => Product::get(),

        ]);
    }
    public function purchase()
    {
        $purchase = PurchaseDetails::join('products', 'purchase_details.product_id', 'products.id')->join('vendors', 'purchase_details.purchase_id','vendors.id')
        ->select('products.product_name', 'vendors.name', 'purchase_details.*')
        ->orderBy('id', 'desc')
        ->get();
        return view('inventory.purchase.purchase', [
            'purchase' => $purchase,

        ]);
    }

    public function add_purchase(Request $request)
    {
        $request->validate([
            'product_name'  =>  'required',
            'price'         =>  'required',
            'qty'           =>  'required',
            'vendor'        =>  'required',
        ]);

        Purchase::create([
            'vendor_id'  =>  $request->vendor,
        ]);


        PurchaseDetails::create([
            'product_id'  =>    $request->product_name,
            'price'       =>    $request->price,
            'qty'         =>    $request->qty,
            'purchase_id' =>    $request->vendor,

        ]);

        $exist = Stock::where('product_id', $request->product_name)->count();
        if($exist > 0){
            Stock::where('product_id', $request->product_name)->increment('qty', $request->qty);
        }
        else{
            Stock::create([
                'product_id' => $request->product_name ,
                'qty'        => $request->qty
            ]);
        }

        return redirect('inventory/purchase')->with('success', 'Purchase added successfully');

    }

    public function edit_purchase($id)
    {
        $purchase = PurchaseDetails::find($id);
        return view('inventory.purchase.edit', [
            'purchase'   => $purchase,
            'products'   => Product::get(),
            'vendors'    => Vendor::get()
        ]);
    }

    public function update_purchase(Request $request, $id)
    {

        $purchase = PurchaseDetails::find($id);
        $purchase->purchase_id = $request->vendor;
        $purchase->product_id  = $request->product_name;
        $currentQty = $purchase->qty;
        $purchase->qty         = $request->qty;
        $purchase->price       = $request->price;
        $purchase->save();
        //-10 + 100
        $stock = Stock::where('product_id', $request->product_name);
        $stock->decrement('qty', $currentQty);
        $stock->increment('qty', $request->qty);

        return redirect('inventory/purchase')->with('update', 'Purchase Updated Successfully');
    }

    public function delete_purchase(Request $request)
    {
        $id = $request->purchase_id;
        PurchaseDetails::destroy($id);
        return redirect()->back()->with('delete', 'Purchase Deleted Successfully');
    }
}
