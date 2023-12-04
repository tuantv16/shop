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
}
