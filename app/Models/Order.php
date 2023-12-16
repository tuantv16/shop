<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'id', 'order_code', 'customer_id', 'total', 'address', 'email', 'phone', 'quantity', 'price', 'total_amount'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

}
