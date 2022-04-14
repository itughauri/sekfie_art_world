<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SessionDetails;

class BookingRecordController extends Controller
{
    public function index(){
        $ticket_detail = SessionDetails::with('qr', 'session', 'customer')->get();
        return view('booking_records.index', [
            'tickets' => $ticket_detail
        ]);
    }
}
