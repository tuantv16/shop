<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    //protected $primaryKey = 'category_id';
    //public $timestamps = false;
    protected $fillable = [
        'id', 'category_name', 'parent_id', 'level', 'disp'
    ];
}
