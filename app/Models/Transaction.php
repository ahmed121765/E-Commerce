<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'mode',
        'status',
        'user_id',
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
