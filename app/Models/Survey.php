<?php

namespace App\Models;

use App\Http\Resources\ProductDetails\ProductDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Survey extends Model
{
    use HasFactory;

    protected $table = 'surveys';

    protected $fillable = [
        'id', 'topic', 'disp',
    ];

    public function feedbacks(): HasMany {
        return $this->hasMany(Feedback::class);
    }

}
