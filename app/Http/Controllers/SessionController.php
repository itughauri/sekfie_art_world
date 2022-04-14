<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\SessionDetails;

class SessionController extends Controller
{
    public function session()
    {
        return view('sessions.add');
    }

    public function add(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'start_time' => 'required',
            'end_time'   => 'required',
        ]);
        Session::create([
            'name' => $request['name'],
            'to'   => $request['end_time'],
            'from' => $request['start_time'],
        ]);

        return redirect('session/show')->with('message', 'Session Added Successfully');

    }

    public function show()
    {
        $session = Session::orderBy('id', 'desc')->get();
        return view('sessions.sessions', ['session' => $session]);
    }

    public function edit(Request $request, $id)
    {
        $session = Session::find($id);
        return view('sessions.edit', ['session' => $session]);
    }

    public function update(Request $request, $id)
    {
        $session = Session::find($id);
        $session->name = $request->name;
        $session->to = $request->to;
        $session->from = $request->from;
        $session->save();

        return redirect('/session/show')->with('message', 'Session Updated Successfully');
    }

    public function delete(Request $request)
    {
        $id = $request->session_id;
        Session::destroy($id);
        return redirect('/session/show')->with('delete', 'Session Deleted Successfully');
    }

    public function remainingTickets(Request $request){
        $session = SessionDetails::where('session_id', $request->queryData)->where('date', $request->date)->count();
        return [
            'success' => true,
            'sessionTickets' => $session
        ];
    }

}
