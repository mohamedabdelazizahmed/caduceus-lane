<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pain extends Model
{
    protected $table = 'pain';

    public function users()
    {
        return $this->hasMany('App\User','pain_id');
    }
}
