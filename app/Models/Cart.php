<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'session_id',
        'status',
        'price',
        'discount',
        'total_price',
        'delivery_cost',
        'coupon_id',
    ];


    protected $casts = [
        'discount' => 'double',
        'total_price' => 'double',
        'delivery_cost' => 'double',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_product')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

}
