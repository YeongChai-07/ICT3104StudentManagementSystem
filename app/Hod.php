<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Hod extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'hod';
    protected $primaryKey  = 'hodid';
    protected $fillable = [
        'hodname', 'hodemail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
