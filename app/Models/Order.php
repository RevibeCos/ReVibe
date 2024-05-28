<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected  $guarded=[];
    protected $dates = [
        'paid_at',
        'shipped_at',
        'complete_at',
    ];

    protected $casts = [
        'paid_at' => 'date',
        'shipped_at' => 'date',
        'complete_at' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
