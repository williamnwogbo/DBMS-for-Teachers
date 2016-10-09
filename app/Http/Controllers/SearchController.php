<?php

namespace App\Http\Controllers;

use App\Models\LocalGovernment;
use App\Models\Professional;
use App\Models\SchoolCordination;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

use App\Http\Requests;

class SearchController extends Controller
{
    //search
    public function index(){
        return view('admin.search');
    }

    public function search(Request $request){
        $teacher_data = [];
        if($request->search) {
            //get teachers by name
            $data_search = explode(" ", $request->search);

            foreach ($data_search as $search) {
                //get teachers by name
                $teachers = Teacher::where('surname', 'like', '%' . $search . '%')
                    ->orWhere('othernames', 'like', '%' . $search . '%')
                    ->orWhere('tsc_file_no', 'like', '%' . $search . '%')
                    ->orWhere('og_file_no', 'like', '%' . $search . '%')
                    ->orWhere('nationality', 'like', '%' . $search . '%')
                    ->orWhere('ward', 'like', '%' . $search . '%')
                    ->get();
                if ($teachers->count() > 0) {
                    foreach ($teachers as $teacher) {
                        $teacher_data[] = $teacher->toArray();
                    }
                }
                //search by Lga
                $lga = LocalGovernment::where('name', 'like', '%' . $search . '%')->pluck('id', 'id');
                if (!empty($lga)) {
                    $teachers = Teacher::whereIn('local_govt_id', $lga)->get();
                    if ($teachers->count() > 0) {
                        foreach ($teachers as $teacher) {
                            $teacher_data[] = $teacher->toArray();
                        }
                    }
                }

                //get by grade level
                $cordination = SchoolCordination::where('grade_level', 'like', '%' . $search . '%')->pluck('teacher_id', 'teacher_id');
                if (!empty($cordination)) {
                    $teachers = Teacher::whereIn('id', $cordination)->get();
                    if ($teachers->count() > 0) {
                        foreach ($teachers as $teacher) {
                            $teacher_data[] = $teacher->toArray();
                        }
                    }
                }

                //get by Subject of specialiation
                $subject = Subject::where('name', 'like', '%' . $search . '%')->get();
                if ($subject->count() > 0) {
                    $profession = Professional::whereIn('subject_of_specialisation', $subject)->pluck('teacher_id', 'teacher_id');
                    if (!empty($profession)) {
                        $teachers = Teacher::whereIn('id', $profession)->get();
                        if ($teachers->count() > 0) {
                            foreach ($teachers as $teacher) {
                                $teacher_data[] = $teacher->toArray();
                            }
                        }
                    }
                }

            }

//            $teacher_data =  array_unique($teacher_data);
            $search_data = $request->search;
            return view('admin.search')->with(compact('teacher_data','search_data'));
        }

        }
}
