<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Session;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function ticket()
    {
        $customers = Customer::all();
        return view('Customers.index', ['exist_customers' => $customers]);
    }

    public function addNewCustomer(Request $request){

        $exists = Customer::where('cnic', $request->cnic)->orWhere('contact_no', $request->contact)->count();
        if($exists > 0){
            return [
                'success' => false,
                'message' => 'Customer already exists'
            ];
        }

        Customer::create([
                'name'       => $request->name,
                'gender'     => $request->gender,
                'cnic'       => $request->cnic,
                'contact_no' => $request->contact_no,
                'age'        => $request->age,
                'email'      => $request->email
            ]);

        return [
            'success' => true,
            'message' => 'Customer successfully added'
        ];
    }

    //Find Customer by CNIC or Contact number
    public function find(Request $request){

        if($customer = Customer::where('cnic', $request->queryData)->orWhere('contact_no', $request->queryData)->first()){
            return [
                'success'  => true,
                'customer' => $customer
            ];
        }else{
            return [
                'failed' => true,
                'customer' => 'not existed'
            ];
        }
    }

    public function add()
    {
        $session =  Session::all();
        return view('Customers.add', ['session' => $session]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'contact_no'  => 'required',
        ]);

        $customer = Customer::create([
            'name'       => $request->name,
            'gender'     => $request->gender,
            'cnic'       => $request->cnic,
            'contact_no' => $request->contact_no,
            'age'        => $request->age,
            'email'      => $request->email,
        ]);

        return redirect('/customer')->with('message', 'Customer added Successfully');
    }

    public function update_ticket(Request $request){
        $cid = $request->post('id');
        return $result = DB::table('tickets')->where('customer_id', $cid)->get();

    }

    public function update_status(Request $request)
    {
        $StatusId = $request->post('id');
        $data = $request->all();
        return $result = DB::table('tickets')->where(['status'=>0])->update(['status', $StatusId]);
    }
}
