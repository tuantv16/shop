<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'id', 'category_name', 'prefix', 'parent_id', 'level', 'disp'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
