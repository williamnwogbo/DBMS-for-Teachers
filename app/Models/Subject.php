<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model {

    /**
     * Generated
     */

    protected $table = 'subjects';
    protected $fillable = ['id', 'name'];


    public function teachers() {
        return $this->belongsToMany(\App\Models\Teacher::class, 'professionals', 'subject_id', 'teacher_id');
    }

    public function professionals() {
        return $this->hasMany(\App\Models\Professional::class, 'subject_id', 'id');
    }

    public function schoolCordinations() {
        return $this->hasMany(\App\Models\SchoolCordination::class, 'subject_id', 'id');
    }


}
