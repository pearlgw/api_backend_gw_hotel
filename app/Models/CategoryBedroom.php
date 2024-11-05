<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryBedroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_category_bedroom',
        'category_name',
        'price',
    ];

    /**
     * Get all of the bedroom for the CategoryBedroom
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bedroom(): HasMany
    {
        return $this->hasMany(Bedroom::class);
    }
}
