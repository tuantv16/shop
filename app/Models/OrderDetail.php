<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    protected $fillable = [
        'id', 'order_id', 'order_code', 'product_id', 'product_code', 'customer_id', 'size_id', 'color_id', 'quantity', 'price', 'total_amount'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
