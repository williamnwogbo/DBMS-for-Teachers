<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model {

    /**
     * Generated
     */

    protected $table = 'teachers';
    protected $fillable = ['id', 'surname', 'other_names', 'title', 'tsc_file_no', 'og_file_no', 'date_of_birth', 'email', 'phone_no', 'country_id', 'state_id', 'local_govt_id', 'ward_id', 'professional_status', 'online_id'];


    public function subjects() {
        return $this->belongsToMany(\App\Models\Subject::class, 'professionals', 'teacher_id', 'subject_id');
    }

    public function professionals() {
        return $this->hasMany(\App\Models\Professional::class, 'teacher_id', 'id');
    }


}
