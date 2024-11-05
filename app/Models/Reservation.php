<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'code_reservation',
        'total_price',
        'status',
    ];

    /**
     * Get all of the detailReservation for the Reservation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailReservation(): HasMany
    {
        return $this->hasMany(DetailReservation::class);
    }

    /**
     * Get the user that owns the Reservation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the order that owns the Reservation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(User::class, 'order_id');
    }
}
