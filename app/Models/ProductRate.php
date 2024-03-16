<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRate extends Model
{
    protected $fillable = [
        'product_id',
        'rating',
        'review',
    ];

    /**
     * Get the product that owns the rate.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
