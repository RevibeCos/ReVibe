<?php

namespace App;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'cart_id',
        'type',
        'amount',
        'total',
        'vat',
        'date',
        'discount',
    ];

    /**
     * Get the user associated with the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the cart associated with the transaction.
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
