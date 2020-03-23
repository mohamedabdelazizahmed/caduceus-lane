<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $table = 'specialties';

    public function users()
    {
        return $this->hasMany('App\User','specialty_id');
    }
}
