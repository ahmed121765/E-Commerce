<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'brand_id',
        'short_description',
        'description',
        'why_choose_product',
        'sample_number_list',
        'lining',
        'weight',
        'dimensions',
        'regular_price',
        'sale_price',
        'SKU',
        'quantity',
        'low_stock_threshold',
        'stock_status',
        'featured',
        'image',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
        'quantity' => 'integer',
        'low_stock_threshold' => 'integer',
    ];

    public function category()
    {

        return $this->belongsTo(Categorie::class, 'category_id');

    }

    public function brand()
    {

        return $this->belongsTo(Brand::class, 'brand_id');

    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }
}
