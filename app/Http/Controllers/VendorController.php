<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function vendor()
    {
        $vendor = Vendor::orderBy('id', 'desc')->get();
        return view('inventory.vendor.vendor', [
            'vendor' => $vendor
        ]);
    }

    public function add_vendor(Request $request)
    {
        $request->validate([
            'vendor_name'   =>  'required',
            'vendor_cnic'   =>  'required',
            'vendor_contact'=>  'required',
        ]);

        Vendor::create([
            'name'    =>  $request->vendor_name,
            'cnic'    =>  $request->vendor_cnic,
            'contact' =>  $request->vendor_contact,
        ]);

        return redirect('inventory/vendor')->with('success', 'Vendor Added Successfully');

    }

    public function show_vendor()
    {
        return view('inventory.vendor.add');
    }

    public function edit_vendor($id)
    {
        $vendor = Vendor::find($id);
        return view('inventory.vendor.edit', [
            'vendor' => $vendor
        ]);
    }

    public function update_vendor(Request $request, $id)
    {
        $vendor = Vendor::find($id);
        $vendor->name    = $request->vendor_name;
        $vendor->cnic    = $request->vendor_cnic;
        $vendor->contact = $request->vendor_contact;
        $vendor->save();

        return redirect('inventory/vendor')->with('update', 'Vendor Updated Successfully');
    }

    public function delete_vendor(Request $request)
    {
        $id = $request->vendor_id;
        Vendor::destroy($id);
        return redirect()->back()->with('delete', 'Vendor Deleted successfully');
    }
}
