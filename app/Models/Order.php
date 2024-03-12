<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cart_id',
        'status',
        'comment',
        'payment_method',
        'payment_status',
        'delivery_method',
        'delivery_pickup_interval',
        'paid_at',
        'shipped_at',
        'complete_at',
        'number_of_packages',
    ];

    protected $dates = [
        'paid_at',
        'shipped_at',
        'complete_at',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'paid_at' => 'date',
        'shipped_at' => 'date',
        'complete_at' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */

    /**
     * Get the cart associated with the order.
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
