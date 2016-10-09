<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class AccountController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.account')->with(compact('users'));
    }

    public function deleteAccount($encrypted_id){
        $id = encrypt_decrypt('decrypt',$encrypted_id);
        $user = User::where('id',$id)->first();
        $user->delete();
        session()->flash('delete_data','User account has been deleted.');
        return back();
    }

    public function addUser(Requests\AddUser $request){
        $request_data = $request->all();
        User::create($request_data);
        session()->flash('alert-success','User account has been created.');
        return back();
    }
}
