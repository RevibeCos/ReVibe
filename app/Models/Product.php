<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;


    protected  $guarded=[];



    protected $casts = [
        'discount' => 'double',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    protected $hidden = [
        'deleted_at',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes');
    }


    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_product')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    public function rates()
    {
        return $this->hasMany(ProductRate::class);
    }

    public function averageRating()
    {
        return $this->rates()->avg('rating');
    }


}
