<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationArea extends Model {

    /**
     * Generated
     */

    protected $table = 'registration_areas';
    protected $fillable = ['id', 'name', 'abbreviation', 'local_government_id'];



}
