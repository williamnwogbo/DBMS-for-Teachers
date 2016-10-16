<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model {

    /**
     * Generated
     */

    protected $table = 'teachers';
    protected $fillable = ['id', 'surname', 'othernames','religion','gender', 'title', 'tsc_file_no', 'og_file_no', 'date_of_birth', 'email', 'phone_no', 'nationality', 'state_id', 'local_govt_id', 'ward', 'professional_status', 'online_id'];


    public function subjects() {
        return $this->belongsToMany(\App\Models\Subject::class, 'professionals', 'teacher_id', 'subject_id');
    }

    public function professionals() {
        return $this->hasMany(\App\Models\Professional::class, 'teacher_id', 'id');
    }

    public function coordination() {
        return $this->hasMany(\App\Models\SchoolCordination::class, 'teacher_id', 'id');
    }

    public function state(){
        return $this->belongsTo(\App\Models\State::class, 'state_id', 'id');
    }

    public function lga(){
        return $this->belongsTo(\App\Models\LocalGovernment::class, 'local_govt_id', 'id');
    }

}
