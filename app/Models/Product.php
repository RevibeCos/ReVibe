<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'discount' => 'double',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
    ];

    /**
     * Get the company that owns the product.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class)
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
    public function getRelatedProducts($limit = 5)
    {

        return Product::where('company_id', $this->company_id)
            ->where('id', '!=', $this->id) // Exclude the current product
            ->limit($limit) // Limit the number of related products to 5
            ->get();
    }

    public function getNewestProducts($limit = 5)
    {
        return $this->orderBy('created_at', 'desc')->limit($limit)->get();
    }

    public function getTopSellerProducts($limit = 5)
    {
        // Assuming you have a field indicating sales count, adjust the field name accordingly
        // return $this->orderBy('sales_count', 'desc')->limit($limit)->get();
    }

    public function getSpecialProducts($limit = 5)
    {
        // Assuming you have a field indicating special status, adjust the field name accordingly
        // return $this->where('is_special', true)->limit($limit)->get();
    }
}
