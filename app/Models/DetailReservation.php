<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailReservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'reservations_id',
        'bedrooms_id',
        'duration',
        'total_price_per_room',
        'check_in',
        'check_out',
    ];

    /**
     * Get the bedroom that owns the DetailReservation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bedroom(): BelongsTo
    {
        return $this->belongsTo(Bedroom::class, 'bedrooms_id');
    }

    /**
     * Get the reservation that owns the DetailReservation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class, 'reservations_id');
    }
}
