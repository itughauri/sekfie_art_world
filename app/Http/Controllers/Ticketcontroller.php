<?php

namespace App\Http\Controllers;

use App\Models\Qrs;
use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\SessionDetails;
use TCPDF;
use Illuminate\Support\Facades\DB;

class Ticketcontroller extends Controller
{

    public function index()
    {
        return view('Tickets.add', [
            'sessions'  => Session::get()
        ]);
    }
    public function store(Request $request)
    {
        $sessionCount = SessionDetails::where('session_id', $request->session)->count();
        foreach ($request->multiple_qr as $qr) {
            if (Qrs::find($qr)) {
                if ($sessionCount != 200) {
                    SessionDetails::create([
                        'customer_id' => $request->customer_id,
                        'session_id'  => $request->session,
                        'qr_id'       => $qr,
                        'date'        => date('Y-m-d'),
                        'status'      => 'sold',
                        'socks'       => '0'
                    ]);
                    Qrs::where('id', $qr)->update([
                        'allotted'   => '1',
                        'session_id' => $request->session
                    ]);
                }
            } else {
                return redirect()->back()->with('error', 'Invalid Qr');
            }
        }
        return redirect()->back()->with('message', 'Ticket generated successfully');
    }

   
}
