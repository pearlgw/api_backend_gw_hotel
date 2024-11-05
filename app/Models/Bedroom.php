<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bedroom extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_bedrooms_id',
        'code_bedroom',
        'main_image_url',
        'is_available',
        'description',
    ];

    /**
     * Get the categoryBedroom that owns the Bedroom
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoryBedroom(): BelongsTo
    {
        return $this->belongsTo(CategoryBedroom::class, 'category_bedrooms_id');
    }

    /**
     * Get all of the bedroomImage for the Bedroom
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bedroomImage(): HasMany
    {
        return $this->hasMany(BedroomImage::class, 'bedrooms_id');
    }

    /**
     * Get all of the facility for the Bedroom
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function facility(): HasMany
    {
        return $this->hasMany(Facility::class);
    }

    /**
     * Get all of the detailReservation for the Bedroom
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailReservation(): HasMany
    {
        return $this->hasMany(DetailReservation::class);
    }

    /**
     * Get all of the detailCashier for the Bedroom
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailCashier(): HasMany
    {
        return $this->hasMany(DetailCashier::class);
    }
}
