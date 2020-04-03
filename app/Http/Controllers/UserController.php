<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //
    public function edit_user(Request $request){

        if($request->ajax()){
            if($request->input('name') == 'password'){
                User::find($request->input('pk'))->update([$request->input('name') => Hash::make($request->input('value'))]);
            }
            else{
                User::find($request->input('pk'))->update([$request->input('name') => $request->input('value')]);
            }
            //dd($request);
            
            return response()->json(['success' => true]);
        }
    }
    public function add_user(Request $req){
        $data_user = new User();
        $data_user->name = strtoupper($req['name']);
        $data_user->username = $req['username'];
        $data_user->email = $req['email'];
        $data_user->password = Hash::make($req['password']);
        $data_user->usertype = 'collector';
        $data_user->status = 'pending';
        $data_user->save();
        return redirect()->back()->with('success','User successfully added!');
    }
}
