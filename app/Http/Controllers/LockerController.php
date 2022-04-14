<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LockerController extends Controller
{
    public function locker()
    {
        return view('locker.index');
    }
}
