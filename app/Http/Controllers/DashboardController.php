<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SessionDetails;
use App\Models\Customer;
use App\Models\EntryRecord;
use App\Models\ExitRecord;
use App\Models\Lockerlog;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function view()
    {
        if(Auth::check()){

            return view('dashboard.index', [
                'booking'        => SessionDetails::where('qr_id', 0)->where('status', 'manual booked')->where('date', date('Y-m-d'))->count(),
                'customers'      => SessionDetails::where('date', date('Y-m-d'))->where('status', 'sold')->count(),
                'entry'          => EntryRecord::where('date', date('Y-m-d'))->count(),
                'exit'           => ExitRecord::where('date', date('Y-m-d'))->count(),
                'entry_records'  => EntryRecord::with('qr', 'customer', 'session')->where('date', date('Y-m-d'))->orderBy('id', 'desc')->get(),
                'exit_records'   => ExitRecord::with('qr', 'session', 'customer')->where('date', date('Y-m-d'))->orderBy('id', 'desc')->get(),
                'data'           => Lockerlog::with('locker', 'customer', 'session')->where('date', date('Y-m-d'))->orderBy('id', 'desc')->get(),
                'tickets'        => SessionDetails::with('qr', 'session', 'customer')->where('date', date('Y-m-d'))->orderBy('id', 'desc')->get()
            ]);
        }else{
            return redirect('/auth/login');
        }
    }
}
