<?php

namespace App\Models;

use App\Http\Resources\ProductDetails\ProductDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'id', 'name', 'survey_id', 'disp'
    ];

    public function survey(): BelongsTo {
        return $this->belongsTo(Survey::class, 'survey_id');
    }

}
