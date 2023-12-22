<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'id',
        'account',
        'customer_name',
        'type', // 99: Khách vãng lai
        'password',
        'phone',
        'email',
        'birthday',
        'gender',
        'country',
        'city',
        'district',
        'wards',
        'address1',
        'address2',
        'address3',
        'memo',
        'disp'
    ];

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
