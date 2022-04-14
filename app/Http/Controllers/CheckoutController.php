<?php

namespace App\Http\Controllers;

use App\Models\EntryRecord;
use App\Models\ExitRecord;
use App\Models\Lockerlog;
use App\Models\Qrs;
use Illuminate\Http\Request;
use App\Models\locker;
use App\Models\SessionDetails;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }


    public function checkOut(Request $request)
    {
        $qr = $request->qr;
        $date = $request->date;
        if ($result = Qrs::where('id',  $qr)->first()) {
            if ($result->allotted == '1') {
                Qrs::where('id', $qr)->update([
                    'allotted'   => '0',
                    'session_id' => 0
                ]);

                $ticket = EntryRecord::where('qr_id', $qr)->where('date', $date)->first();

              ExitRecord::create([
                'qr_id'            => $qr,
                'customer_id'      => $ticket->customer_id,
                'session_id'       => $ticket->session_id,
                'date'             => date('Y-m-d'),
            ]);

                return [
                    'success' => true,
                    'message' => 'Checkout successfully'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'This QR code is not assigned to any session yet'
                ];
            }
        } elseif ($result = Qrs::where('id', '!=', $qr)->first()) {
            return  'hello';
        }
    }

    public function entries_counter(Request $request)
    {
        $qr_id  = $request->qr;
        $session_id = SessionDetails::where('qr_id', $qr_id)->latest()->first();

        $entries = DB::table('entry_records')
        ->where('session_id', $session_id->session_id)
        ->where('date', date('Y-m-d'))->count();
        return $entries;
    }

    public function exit_counter(Request $request)
    {
        $qr_id = $request->qr;
        $session_id = SessionDetails::where('qr_id', $qr_id)->latest()->first();
        $exit = DB::table('exit_records')->where('session_id', $session_id->session_id)->where('date', date('Y-m-d'))->count();
        return $exit;
    }
}

