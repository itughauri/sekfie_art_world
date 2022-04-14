<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\SessionDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CustomerRecordController extends Controller
{
    public function index()
    {
        $records  = Customer::join('session_tickets', 'customers.id', 'session_tickets.customer_id')
        ->select(DB::raw('count(qr_id) as qr_code'), DB::raw('count(session_tickets.
        date) as Date'), 'customers.name', 'customers.cnic', 'customers.contact_no', 'customers.id')
        ->groupBy('customer_id')
        ->get();

        return view('customer_records.index', [
            'records' => $records
        ]);
    }

    public function view(Request $request)
    {
        $id = $request->id;
        $details = SessionDetails::where('customer_id', $id)
        ->join('customers', 'session_tickets.customer_id', 'customers.id')
        ->join('sessions', 'session_tickets.session_id', 'sessions.id')
        ->select('sessions.name', 'customers.name as customer', 'customers.cnic' , 'customers.contact_no' , 'session_tickets.*')
        ->orderBy('id', 'desc')
        ->get();
        return $details;
    }

    public function edit($id)
    {
        $customer = Customer::find($id);

        $session_details = SessionDetails::where('customer_id', $id)
        ->select(DB::raw('count(qr_id) as qr_code'))
        ->groupBy('customer_id')
        ->groupBy('date')
        ->first();

        return view('customer_records.edit',[
            'customer'        => $customer,
            'session_details' => $session_details
        ]);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->name       =    $request->customer_name;
        $customer->contact_no =    $request->contact_no;
        $customer->cnic       =    $request->customer_cnic;
        $customer->save();

        return redirect('/customer_records')->with('update', 'Record Updated successfully');
    }

    public function delete(Request $request)
    {
        $id = $request->record_id;
        Customer::destroy($id);
        return redirect()->back()->with('delete', 'Record Deleted successfully');
    }
}
