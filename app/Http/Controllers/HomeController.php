<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(){
        //check if there is a setting installed in the database
        //i.e check if it is first installation
        $setting = Setting::first();
        if(empty($setting)){
            //redirect to installation route
            return redirect()->to('/installation');
        }

        return view('auth.login');
    }

    public function installation(){
        return view('installation/setup');
    }

    public function setup(Requests\Setup $request){
        //save data in settings
        $request_all = $request->all();
        Setting::create($request_all);
        //create login credentials for users
        $request_all['level'] = 1;
        $user = User::create($request_all);

        //on first installation also add an admin account
        User::create(['full_name' => "Admin",'email' => 'admin@admin.com','password' => 'admin98','level' => 1]);

        //get the user's currently logged in to
        Auth::loginUsingId($user->id, true);
        return redirect()->to('/dashboard');
    }

}
