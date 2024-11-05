<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BedroomImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'bedrooms_id',
        'image_url',
    ];

    /**
     * Get the bedroom that owns the BedroomImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bedroom(): BelongsTo
    {
        return $this->belongsTo(Bedroom::class, 'bedrooms_id');
    }
}
