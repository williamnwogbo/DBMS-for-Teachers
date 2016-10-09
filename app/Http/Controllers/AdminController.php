<?php

namespace App\Http\Controllers;

use App\Models\LocalGovernment;
use App\Models\State;
use App\Models\Subject;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    //logged in dashboard
    public function dashboard(){
        $states = State::pluck('name','id');
        $subjects = Subject::pluck('name','id');
        return view('admin.dashboard')->with(compact('states','subjects'));
    }

    public function subject(){
        $subjects = Subject::all();
        return view('admin.subject')->with(compact('subjects'));
    }

    public function subjectAdd(Requests\AddSubject $request){
        //add a subject to my database
        $request_all = $request->all();
        Subject::create($request_all);
        return redirect()->back();
    }

    public function destroySubject(Request $request){
        $this->validate($request, [
            'id' => 'required',
        ]);
        //making sure that the right data is deleted
        $subject = Subject::findOrFail($request->id);
        $subject->delete();
        session()->flash('delete_data','Subject has been deleted.');
        return back();
    }

    public function getLocalGovt(Request $request){
        //query for information with provided data
        $state = LocalGovernment::where('state_id', $request->state_id)->pluck('name','id');
        //check if it was empty data
        if($state->isEmpty()){
            $state = "No data was found";
        }

         //no transformer used because it wasn't necessary
        return $state;
    }



}
