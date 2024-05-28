<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRate extends Model
{
    protected  $guarded=[];

    /**
     * Get the product that owns the rate.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
