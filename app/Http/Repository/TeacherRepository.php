<?php

namespace App\Http\Repository;
use App\Models\Professional;
use App\Models\SchoolCordination;
use App\Models\Teacher;
use Auth;
use App\Http\Repository\Repository;
use Carbon\Carbon;

class TeacherRepository extends Repository
{
    public function updateTeacher($data)
    {
        //update the teacher array
        $teacher_array = [
            'surname' => $data['surname'],
            'othernames' => $data['othernames'],
            'title'  => $data['title'],
            'tsc_file_no'  => $data['tsc_file_no'],
            'og_file_no'  => $data['og_file_no'],
            'date_of_birth' => Carbon::parse($data['date_of_birth'])->toDateString(),
            'email' => $data['email'],
            'phone_no' => $data['phone_no'],
            'nationality' => $data['nationality'],
            'state_id' => $data['state_id'],
            'local_govt_id' => (isset($data['local_govt_id'])) ? $data['local_govt_id'] : $data['local_govt_id_old'],
            'ward' => $data['ward'],
            'professional_status' => $data['professional_status']
        ];
        $teacher = Teacher::where('id',$data['teacher_id'])->update($teacher_array);

        //next would be to update professional profile
        $professional_array = [
            'qualification' => $data['qualification'],
            'year'=> $data['year'],
            'subject_of_specialisation'=> $data['subject_of_specialisation'],
            'classifications'=> $data['classifications'],
            'post_held'=> $data['post_held'],
            'appointment'=> Carbon::parse($data['appointment'])->toDateString(),
            'last_promotion'=> Carbon::parse($data['last_promotion'])->toDateString(),
            'teacher_id'=> $data['teacher_id'],
        ];
        $professional = Professional::where('id',$data['professional_id'])->update($professional_array);

        //coordination
        if(!empty($data['school_info'])) {
            $i = 0;
            foreach ($data['school_info'] as $school) {
                $school_data = [
                    'school' => $school,
                    'teacher_id' => $data['teacher_id'],
                    'from' => Carbon::parse($data['from'][$i])->toDateString(),
                    'to' => Carbon::parse($data['to'][$i])->toDateString(),
                    'grade_level' => $data['grade_level'][$i],
                    'designation' => $data['designation'][$i],
                    'subject_id' => $data['subject_id'][$i],
                ];
                if(isset($data['cordination_id'][$i])){
                    $cordination = SchoolCordination::where('id', $data['cordination_id'][$i])->update($school_data);
                    $i++;

                }else{
                    $cordination = SchoolCordination::create($school_data);
                }
            }

        }
        return true;
    }
}

