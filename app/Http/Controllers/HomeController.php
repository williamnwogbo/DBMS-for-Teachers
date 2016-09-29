<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;

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
    }

    public function installation(){
        
    }
}
