<?php

namespace App\Http\Controllers;

use App\Models\Qrs;
use App\Models\SessionDetails;
use Illuminate\Http\Request;
use App\Models\SocksCash;
use App\Models\Stock;

class SockController extends Controller
{
    public function index()
    {
        return view('socks.index');
    }

    public function socks(Request $request)
    {
        $qr = $request->qr;

        $session = Qrs::find($qr);
        if(!$session){
            return [
                'success' => false,
                'message' => 'Invalid QR'
            ];
        }
        if($session->allotted == '0'){
            return 'hello';
        }
        $result = SessionDetails::where('qr_id', $qr)
        ->first();

        if ($result->socks == '0') {
            SessionDetails::where('qr_id', $qr)
            // ->where('session_id', $session->session_id)
            // ->where('date', date('Y-m-d'))
            ->update([
                'socks' => '1'
            ]);

            return [
                'success' => true,
                'message' => 'Lockers given successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'This QR code is not assigned to any session yet'
            ];
        }
    }

    public function sock_cash(Request $request)
    {
        $session = Qrs::find($request->qrID);
        $sessionDetails = SessionDetails::where('qr_id', $request->qrID)

        ->first();

        SocksCash::create([
            'customer_id'  => $sessionDetails->customer_id,
            'session_id'   => $sessionDetails->session_id,
            'qr_id'        => $request->qrID,
            'amount'       => $request->amount
        ]);

        $qty = $request->qty;

        $stock = Stock::where('product_id', '15')->decrement('qty', $qty);

        return redirect()->back();
    }

}
