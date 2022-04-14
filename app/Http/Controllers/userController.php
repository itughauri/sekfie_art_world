<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\create_users;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class userController extends Controller
{
    // public function __constructor(){
    //     if(auth()->user()->role == 'admin'){

    //     };
    //     return
    // }
    public function user()
    {
        return view('add_users.add_user');
    }

    public function add_user(Request $request)
    {
        // return $request;
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'city'=>'required',
        ]);
        create_users::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'city' => $request['city'],
        ]);

        return redirect('/user/show-user')->with('message', 'User Added Successfully');

    }

    public function show_user()
    {
        $user = create_users::all();
        return view('add_users.show_users', ['user'=>$user]);
    }

    public function edit_user($id)

    {
        // dd($id);
        $edit_user = create_users::find($id);
        return view('add_users.edit_user', ['edit_user' => $edit_user]);
    }

    public function update_user(Request $request, $id)
    {
        $update_user = create_users::find($id);
        $update_user->first_name = $request->first_name;
        $update_user->last_name = $request->last_name;
        $update_user->city = $request->city;
        $update_user->save();

        return redirect('/user/show-user');
    }

    public function delete_user($id)
    {
        create_users::destroy($id);
        return redirect('/user/show-user');

    }

    public function SendEmail()
    {
        $create_users = create_users::all();
        $data = ['data' => $create_users];
        $user['to'] = 'itughauri119@gmail.com';
        Mail::send('mail', $data, function($messages) use ($user){
            $messages->to($user['to']);
            $messages->subject('hello irtaza');
        });

        return redirect('/user/show-user');
    }



}
