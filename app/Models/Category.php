<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    public $translatable = ['name', 'description'];

    protected $fillable = [
        'name', 'description', 'image', 'parent_id'
    ];

    protected $dates = ['deleted_at'];


    public static function getParentCategories()
    {
        return self::where('parent_id', null)->get();
    }
    public static function getSupCategories()
    {
        return self::whereHas('parent', function ($query) {
            $query->whereNull('parent_id');
        })->get();
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }


    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function isParent()
    {
        return $this->children()->exists();
    }
    public function isNotChild()
    {
        return is_null($this->parent_id);
    }
    public function isNotParent()
    {
        return !$this->children()->exists();
    }
}
