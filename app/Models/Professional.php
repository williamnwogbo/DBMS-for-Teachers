<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model {

    /**
     * Generated
     */

    protected $table = 'professionals';
    protected $fillable = ['id', 'qualifications', 'year', 'subject_of_specialisation', 'subject_id', 'classifications', 'post_held', 'retirement', 'appointment', 'last_promotion', 'teacher_id', 'uploaded', 'online_id'];


    public function subject() {
        return $this->belongsTo(\App\Models\Subject::class, 'subject_id', 'id');
    }

    public function teacher() {
        return $this->belongsTo(\App\Models\Teacher::class, 'teacher_id', 'id');
    }


}
