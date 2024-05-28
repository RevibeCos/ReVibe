<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Nova\Auth\Impersonatable;


class Admin extends Authenticatable
{
    use SoftDeletes ,HasFactory ,Impersonatable;


    protected  $guarded=[];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];
}

