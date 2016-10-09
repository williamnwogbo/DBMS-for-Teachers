<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model {

    /**
     * Generated
     */

    protected $table = 'professionals';
    protected $fillable = ['id', 'qualification', 'year', 'subject_of_specialisation', 'classifications', 'post_held', 'retirement', 'appointment', 'last_promotion', 'teacher_id', 'uploaded', 'online_id'];


    public function subject() {
        return $this->belongsTo(\App\Models\Subject::class, 'subject_id', 'id');
    }

    public function subject_spec() {
        return $this->belongsTo(\App\Models\Subject::class, 'subject_of_specialisation', 'id');
    }

    public function teacher() {
        return $this->belongsTo(\App\Models\Teacher::class, 'teacher_id', 'id');
    }


}
