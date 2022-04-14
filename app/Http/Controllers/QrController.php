<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qrs;
use App\Models\Session;


class QrController extends Controller
{
    public function QR()
    {
        $session = Session::all();
        return view('QR.QR',['session' => $session]);
    }

    public function add(Request $request)
    {


           Qrs::create([
            'code' => $request->code,
        ]);

        return redirect('/QR/show')->with('message', 'QR Added Successfully');

    }

    public function show()
    {

        $qr = Qrs::orderBy('id', 'desc')->get();

        return view('QR.show', ['qr' => $qr]);
    }

    public function edit($id)
    {
        $qr = Qrs::find($id);
        return view('QR.edit', ['qr' => $qr]);
    }

    public function update( Request $request, $id)
    {
        $qr = Qrs::find($id);
        $qr->code = $request->code;
        $qr->save();

        return redirect('/QR/show')->with('update', 'QR Updated Successfully');
    }

    public function delete(Request $request)
    {
        $id = $request->qr_id;
        Qrs::destroy($id);
        return redirect('/QR/show')->with('delete', 'QR Deleted Successfully');
    }

    public function allotted(Request $request){
        $qr = Qrs::where( 'id', $request->queryData)->first();
        if( $qr->allotted == '1'){
            return [
                'success' => false,
                'message' => 'This QR code is already allotted'
            ];
        }
    }
}
