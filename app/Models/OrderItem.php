<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'quantity',
        'options',
        'rstatus',
        'product_id',
        'order_id',
    ];

    protected $casts = [
        'rstatus' => 'boolean',
    ];

    protected function options(): Attribute
    {
        return Attribute::make(
            get: function ($value): array {
                $options = json_decode($value ?: '{}', true);

                if (is_string($options)) {
                    $options = json_decode($options, true);
                }

                return is_array($options) ? $options : [];
            },
            set: fn (array|string|null $value): string => is_string($value)
                ? $value
                : json_encode($value ?? []),
        );
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
