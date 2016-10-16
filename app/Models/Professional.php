<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model {

    /**
     * Generated
     */

    protected $table = 'professionals';
    protected $fillable = ['id', 'qualification_id', 'year', 'subject_of_specialisation', 'classifications', 'post_held', 'retirement', 'appointment', 'last_promotion', 'teacher_id', 'uploaded', 'online_id'];


    public function subject() {
        return $this->belongsTo(\App\Models\Subject::class, 'subject_id', 'id');
    }

    public function subject_spec() {
        return $this->belongsTo(\App\Models\Subject::class, 'subject_of_specialisation', 'id');
    }

    public function teacher() {
        return $this->belongsTo(\App\Models\Teacher::class, 'teacher_id', 'id');
    }

    public function qualification() {
        return $this->belongsTo(\App\Models\QualificationType::class, 'qualification_id', 'id');
    }


}
