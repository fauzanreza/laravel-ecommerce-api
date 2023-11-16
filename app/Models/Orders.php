<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'user_id',
        'items',
        'shipping_address',
        'payment_method',
        'total_price',
        'status'
    ];

    protected $casts = [
        'items' => 'array'
    ];
}
