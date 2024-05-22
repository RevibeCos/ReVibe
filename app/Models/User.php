<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Nova\Auth\Impersonatable;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
use Laravel\Sanctum\HasApiTokens as SanctumHasApiTokens;

class User extends Authenticatable
{
    use SanctumHasApiTokens, HasFactory, Notifiable;

    protected  $guarded=[];

    protected $hidden = [
        'password',           // Hide the password for security reasons
        'remember_token',     // Hide the remember token
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',  // Cast email_verified_at as a datetime object
        'password' => 'hashed',             // Automatically hash the password
    ];

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
