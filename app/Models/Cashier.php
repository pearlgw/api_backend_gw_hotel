<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cashier extends Model
{
    use HasFactory;
    protected $fillable = [
        'code_cashier',
        'user_id',
        'order_id',
        'total_price',
        'pay_money',
        'refund_money',
    ];

    /**
     * Get all of the detailCashier for the Cashier
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailCashier(): HasMany
    {
        return $this->hasMany(DetailCashier::class);
    }

    /**
     * Get the user that owns the Cashier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the order that owns the Cashier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(User::class, 'order_id');
    }
}
