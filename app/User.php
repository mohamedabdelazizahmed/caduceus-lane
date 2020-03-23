<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','occupation','first_name','last_name','gender_id','specialty_id','country_id','pain_id','birth_date','role_id','mobile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function specialty()
    {
        return $this->belongsTo('App\Specialty','specialty_id');
    }

    public function role()
    {
        return $this->belongsTo('App\Role','role_id');
    }

    public function pain()
    {
        return $this->belongsTo('App\Pain','pain_id');
    }
}
