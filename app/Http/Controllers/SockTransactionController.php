<?php

namespace App\Http\Controllers;

use App\Models\SocksCash;
use Illuminate\Http\Request;

class SockTransactionController extends Controller
{
    public function index()
    {
        $transaction = SocksCash::join('customers', 'socks_cashes.customer_id', 'customers.id')
        ->join('sessions', 'socks_cashes.session_id', 'sessions.id')
        ->select('customers.name', 'sessions.name as session', 'socks_cashes.id', 'socks_cashes.amount', 'socks_cashes.qr_id', 'socks_cashes.created_at')
        ->orderBy('id', 'desc')
        ->get();
        return view('socks.transactions', [
            'transaction'   => $transaction
        ]);
    }

    public function edit($id)
    {
        $transaction = SocksCash::find($id);
        return view('socks.edit', [
            'transaction'  => $transaction
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = SocksCash::find($id);
        $product->amount     = $request->amount;
        $product->created_at = $request->date;
        $product->save();

        return redirect('socks_transactions')->with('update', 'Transaction Updated Successfully');
    }

    public function delete(Request $request)
    {
        $id = $request->record_id;
        SocksCash::destroy($id);
        return redirect()->back()->with('delete', 'Record Deleted successfully');
    }
}
