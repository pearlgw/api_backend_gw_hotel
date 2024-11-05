<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailCashier extends Model
{
    use HasFactory;
    protected $fillable = [
        'cashiers_id',
        'bedrooms_id',
        'duration',
        'total_price_per_room',
        'check_in',
        'check_out',
    ];

    /**
     * Get the bedroom that owns the DetailCashier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bedroom(): BelongsTo
    {
        return $this->belongsTo(User::class, 'bedrooms_id');
    }

    /**
     * Get the cashier that owns the DetailCashier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cashier(): BelongsTo
    {
        return $this->belongsTo(Cashier::class, 'cashiers_id');
    }
}
