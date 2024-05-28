<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $guarded=[];

    /**
     * Get the product associated with the product tag.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the tag associated with the product tag.
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
