<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use App\Models\SchoolCordination;
use App\Models\State;
use App\Models\Subject;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class TeachersController extends Controller
{

    public function index(){
        $teachers = Teacher::paginate(15);
        return view('admin.teachers')->with(compact('teachers'));
    }

    //add data
    public function add(Requests\AddTeachers $request){
        //validation was successful
        //first is to save the data of the teacher
        $request_data = $request->all();
        $request_data['date_of_birth'] = Carbon::parse($request_data['date_of_birth'])->toDateString();
        $teacher = Teacher::create($request_data);

        //save professions for the teacher
        //reformat data
        $request_data['teacher_id'] = $teacher->id;
        $request_data['appointment'] = Carbon::parse($request_data['appointment'])->toDateString();
        $request_data['last_promotion'] = Carbon::parse($request_data['last_promotion'])->toDateString();
        Professional::create($request_data);

        //last thing to save is to
        if(!empty($request_data['school_info'])) {
            $i = 0;
            foreach ($request_data['school_info'] as $school) {
                $school_data[] = [
                        'school' => $school,
                        'teacher_id' => $teacher->id,
                        'from' => Carbon::parse($request_data['from'][$i])->toDateString(),
                        'to' => Carbon::parse($request_data['to'][$i])->toDateString(),
                        'grade_level' => $request_data['grade_level'][$i],
                        'designation' => $request_data['designation'][$i],
                        'subject_id' => $request_data['subject_id'][$i],
                ];
                $i++;
            }
            if(isset($school_data)){
                SchoolCordination::insert($school_data);
            }
        }
        session()->flash('alert-success', 'Teacher\'s Data has been added');

        return redirect()->to('/teacher/view/'.encrypt_decrypt('encrypt',$teacher->id));
    }

    //edit a teacher
    public function edit($id = null){
        $id = encrypt_decrypt('decrypt',$id);
        $teacher = Teacher::where('id',$id)->first();
        if(!$teacher){
            session()->flash('alert-info','Teacher not found');
            return back();
        }
        $states = State::pluck('name','id');
        $subjects = Subject::pluck('name','id');
        return view('admin.edit_teacher')->with(compact('teacher','states','subjects'));
    }

    //post request
    public function pEdit(Requests\AddTeachers $request){
        $request_all = $request->all();
        $this->teacherRepository->updateTeacher($request_all);
        session()->flash('alert-success', 'Teacher\'s Data has been updated');
        return back();
    }

    //view teachers
    public function view($id = null){
        $id = encrypt_decrypt('decrypt',$id);
        $teacher = Teacher::where('id',$id)->first();
        $subjects = Subject::pluck('name','id');
        return view('admin.view_teacher')->with(compact('teacher','subjects'));
    }

    //edit professional
    public function editProfessional(Requests\EditProfessional $request){
        $request_data = $request->all();
        $request_data['appointment'] = Carbon::parse($request_data['appointment']);
        $request_data['last_promotion'] = Carbon::parse($request_data['last_promotion']);
        unset($request_data['professional_id']);
        Professional::where('id',$request->professional_id)->update($request_data);
        session()->flash('alert-success', 'Teacher\'s Professional Profile has been updated');
        return back();
    }

    public function addProfessional(Requests\EditProfessional $request){
        $request_data = $request->all();
        Professional::create($request_data);
        session()->flash('alert-success', 'Teacher\'s Professional Profile has been added');
        return back();
    }

    //delete professional profile
    public function deleteProfessional($encrypted_id){
        $id = encrypt_decrypt('decrypt',$encrypted_id);
        $profile = Professional::where('id',$id)->first();
        $profile->delete();
        session()->flash('alert-success', 'Teacher\'s Professional Profile has been deleted');
        return back();
    }

    //delete cordination
    public function deleteCordination($encrypted_id){
        $id = encrypt_decrypt('decrypt',$encrypted_id);
        $profile = SchoolCordination::where('id',$id)->first();
        $profile->delete();
        session()->flash('alert-success', 'Teacher\'s Cordination Profile has been deleted');
        return back();
    }

    //delete cordination
    public function addCordination(Requests\AddCordination $request){
        $school_data = $school_data_new = [];
        $request_data = $request->all();
        //so i have to consider the once that need upting and need saving for the first time
        //first count how many total result came in
        $count_data = count($request_data['school_info']);
        //count the once that need an update
        $count_update = count($request_data['cordination_id']);
        for($i = 0; $i < $count_update;$i++){
            $school_data = [
                'school' => $request_data['school_info'][$i],
                'teacher_id' => $request_data['teacher_id'],
                'from' => Carbon::parse($request_data['from'][$i])->toDateString(),
                'to' => Carbon::parse($request_data['to'][$i])->toDateString(),
                'grade_level' => $request_data['grade_level'][$i],
                'designation' => $request_data['designation'][$i],
                'subject_id' => $request_data['subject_id'][$i],
            ];
            //this is not the best way around this, but till i get a better way we might have to hack it.
            //reasons why is if we have a thousand of this we would be hitting the database a thousand times, it can work well for minimal data
            SchoolCordination::where('id',$request_data['cordination_id'][$i])->update($school_data);
        }

        //to to solve the once that need saving
        for($i = $count_update; $i < $count_data;$i++) {
            $school_data_new[] = [
                'school' => $request_data['school_info'][$i],
                'teacher_id' => $request_data['teacher_id'],
                'from' => Carbon::parse($request_data['from'][$i])->toDateString(),
                'to' => Carbon::parse($request_data['to'][$i])->toDateString(),
                'grade_level' => $request_data['grade_level'][$i],
                'designation' => $request_data['designation'][$i],
                'subject_id' => $request_data['subject_id'][$i],
            ];
        }
        if(!empty($school_data_new)){
            SchoolCordination::insert($school_data_new);
        }
        session()->flash('alert-success', 'Teacher\'s Cordination Profile has been updated');
        return back();
    }
}
