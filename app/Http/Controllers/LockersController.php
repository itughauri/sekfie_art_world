<?php

namespace App\Http\Controllers;

use App\Models\locker;
use App\Models\Lockerlog;
use App\Models\Qrs;
use App\Models\SessionDetails;
use Illuminate\Http\Request;

class LockersController extends Controller
{
    public function index()
    {
        return view('locker.index', [
            'lockers' => locker::all(),
        ]);
    }

    public function add_view()
    {
        return view('locker.add');
    }
    public function add_locker(Request $request)
    {
        $request->validate([
            'locker_name'  => 'required',
        ]);

        if(locker::where('name', $request->locker_name)->first()){
            return redirect()->back()->with('exists', 'Locker already exists');
        }else{
            locker::create([
                'name' => $request->locker_name,
            ]);

            return redirect('lockers')->with('success', 'Locker created successfully');
        }


    }

    public function edit_view($id)
    {
        $lockers = locker::find($id);
        return view('locker.edit', [
            'lockers' => $lockers,
        ]);
    }

    public function update(Request $request, $id)
    {

        $locker = locker::find($id);
        $locker->name = $request->locker_name;
        $locker->save();

        return redirect('lockers')->with('update', 'Locker Updated Successfully');
    }

    public function delete(Request $request)
    {
        $id = $request->locker_id;
        locker::destroy($id);
        return redirect()->back()->with('delete', 'Locker Deleted successfully');
    }

    public function assign_view()
    {
        return view('locker.assign', [
            'lockers' => locker::all(),
        ]);
    }

    public function assign_lockers(Request $request)
    {
        $qr_id = $request->qr;
        $locker_id = $request->locker_id;

        $find_qr = Qrs::find($qr_id);

        if(!$find_qr){
            return [
                'success'  => false,
                'message'  => 'QR not existed'
            ];
        }elseif($find_qr->allotted == '0'){
            return [
                'success'  => false,
                'message'  => 'QR not assigned to any session yet'
            ];
        }elseif(locker::where('id', $locker_id)->where('allotted', '0')->first()){

            $ticket = SessionDetails::where('qr_id', $qr_id)->first();
            Lockerlog::create([
                'locker_id'   => $locker_id,
                'customer_id' => $ticket->customer_id,
                'qr_id'       => $ticket->qr_id,
                'session_id'  => $ticket->session_id,
                'date'        => date('Y-m-d')
            ]);

            locker::where('id', $locker_id)->update([
                'allotted' => '1'
            ]);

            return [
                'success' =>  true,
                'message' =>  'Locker assigned successfully'
            ];
        }elseif(locker::where('id', $locker_id)->where('allotted', '1')->first()){
                return [
                    'success'  => false,
                    'message'  => 'Locker is already assigned'
                ];
        }
    }

    public function free_lockers_view()
    {
        return view('locker.free');
    }

    public function free(Request $request)
    {
        $qr_id = $request->qrID;

        if($lockerlog = Lockerlog::where('qr_id', $qr_id)->first()){
        locker::where('id', $lockerlog->locker_id)->update(['allotted' => '0']);
        return [
            'success' => true,
            'message' => 'Locker free successfully'
        ];

    }elseif($lockerlog = Lockerlog::where('qr_id', '!=' , $qr_id)->first()){
        return [
            'success' => false,
            'message' => 'QR not exists'
        ];
    }

    }
}
