<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $guarded=[];
    protected $casts = [
        'item' => 'json',
        'start_date' => 'date',
        'end_date' => 'date',
        'discount' => 'double',
        'limit_user' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $hidden = [
        'deleted_at',
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'offer_products', 'offer_id');
    }
}
