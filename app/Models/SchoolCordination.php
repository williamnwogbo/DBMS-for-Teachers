<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolCordination extends Model {

    /**
     * Generated
     */

    protected $table = 'school_cordinations';
    protected $fillable = ['id', 'state_id', 'subject_id', 'teacher_id', 'school', 'from', 'to', 'designation', 'grade_level', 'uploaded', 'online_id', 'email', 'current', 'class'];


    public function subject() {
        return $this->belongsTo(\App\Models\Subject::class, 'subject_id', 'id');
    }


}
