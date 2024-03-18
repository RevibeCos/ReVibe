<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Company extends Model
{
    use HasFactory, SoftDeletes,HasTranslations;
    public $translatable = ['description'];

    protected $fillable = [
        'name', 'description', 'image'
    ];

    protected $dates = ['deleted_at'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
