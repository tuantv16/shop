<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'id', 'product_id', 'product_code', 'customer_id', 'size_id', 'color_id', 'quantity', 'price', 'total_amount'
    ];

}
