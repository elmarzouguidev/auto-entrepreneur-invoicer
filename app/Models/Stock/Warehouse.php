<?php

declare(strict_types=1);

namespace App\Models\Stock;

use App\Models\Catalog\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warehouse extends Model
{
    use HasFactory;

    /**
     * @var string[]|array<int,string>
     */
    protected $fillable = [
        'name',
        'address',
        'map',
        'city_id',
        'user_id',
    ];

    /**
     * @var string[]|array<int,string>
     */
    protected $casts = [];

    // Relationships
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function adjustments(): HasMany
    {
        return $this->hasMany(Adjustment::class);
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(
            Product::class,
            AdjustmentProduct::class,
            firstKey: 'warehouse_id',
            secondKey: 'id',
            localKey: 'id',
            secondLocalKey: 'product_id'
        );
    }

    // Helper Methods
}
