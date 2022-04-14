<?php

namespace App\Http\Controllers;

use App\Models\SessionDetails;
use Illuminate\Http\Request;
use App\Models\EntryRecord;
use App\Models\Qrs;
use App\Models\Session;

class EntryController extends Controller
{
    public function index()
    {
        return view('entry.index');
    }

    public function show(Request $request)
    {
        {
        $id = $request->qrID;
        $session =  SessionDetails::where('qr_id', $request->qrID)->latest()->first();
        $details =  SessionDetails::join('sessions', 'session_tickets.session_id', 'sessions.id')
            ->join('customers', 'session_tickets.customer_id', 'customers.id')
            ->join('qrs', 'session_tickets.qr_id', 'qrs.id')
            ->select('sessions.name', 'customers.name as customer', 'qrs.allotted', 'session_tickets.*')
            ->where('qr_id', $id)
            ->where('allotted', '1')
            ->where('session_tickets.session_id', $session->session_id)
            ->get();
        return $details;
        }
    }

    public function add(Request $request)
    {
        $request->validate([
            'qrID'   =>   'required',
        ]);


            if($qr = Qrs::find($request->qrID)){
            $date = $request->date;
            $session_id = SessionDetails::where('qr_id', $request->qrID)->latest()->first();

            $details = SessionDetails::where('session_id', $session_id->session_id)
                ->where('qr_id', $request->qrID)
                ->where('date', $date)
                ->first();

            EntryRecord::create([
                'qr_id'          => $request->qrID,
                'customer_id'    => $details->customer_id,
                'session_id'     => $details->session_id,
                'date'           => $date
            ]);

            return redirect()->back()->with('enter', 'Enter Successfully');
        }else{
            return redirect()->back()->with('entry_error', 'QR not available');
        }

    }
}
