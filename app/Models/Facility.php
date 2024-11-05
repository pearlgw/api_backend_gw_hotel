<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Facility extends Model
{
    use HasFactory;
    protected $fillable = [
        'bedrooms_id',
        'wifi',
        'elektronik',
        'swimming_pool',
        'gym',
    ];

    /**
     * Get the bedroom that owns the Facility
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bedroom(): BelongsTo
    {
        return $this->belongsTo(Bedroom::class);
    }
}
