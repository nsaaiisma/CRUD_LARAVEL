<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'sku',
        'price',
        'stock',
        'product_category_id',
        'image_url',
        'is_active'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public static function getAll()
    {
        return Product::with('products')->get();
    }
}
