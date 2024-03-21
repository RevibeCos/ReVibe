<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'name',
        'company_id',
        'description',
        'image',
        'cost_price',
        'full_price',
        'price',
        'discount',
        'is_new',
        'sort_order',
    ];


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
        return $this->belongsToMany(Category::class, 'category_product');
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

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, );
    }



    public function getTopSellerProducts($limit = 5)
    {
        return $this->orderBy('created_at', 'desc')->limit($limit)->get();
        // Assuming you have a field indicating sales count, adjust the field name accordingly
        // return $this->orderBy('sales_count', 'desc')->limit($limit)->get();
    }

    public function getSpecialProducts($limit = 5)
    {
        return $this->orderBy('created_at', 'desc')->limit($limit)->get();
        // return $this->where('is_special', true)->limit($limit)->get();
    }
}
