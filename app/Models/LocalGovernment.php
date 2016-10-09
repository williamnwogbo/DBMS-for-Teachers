<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalGovernment extends Model {

    /**
     * Generated
     */

    protected $table = 'local_governments';
    protected $fillable = ['id', 'name', 'abbreviation', 'state_id'];



}
