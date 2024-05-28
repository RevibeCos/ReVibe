<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Company extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;
    public $translatable = ['description'];

    protected  $guarded=[];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'deleted_at',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_id');
    }
}
