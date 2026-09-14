<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
