<?php

declare(strict_types=1);

namespace App\Models\Finance\Buy;

use App\Models\Finance\Provider;
use App\Models\Utilities\PaymentType;
use App\Models\Utilities\Tax;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BuyEstimate extends Model implements HasMedia
{
    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;
    use InteractsWithMedia;

    /**
     * @var string[]|array<int,string>
     */
    protected $fillable = [
        'price_tva',
        'price_total',
        'price_ht',
    ];

    /**
     * @var string[]|array<int,string>
     */
    protected $casts = [
        'due_date' => 'date:Y-m-d',
        'estimate_date' => 'date:Y-m-d',
        'price_total' => 'float',
        'price_tva' => 'float',
        'price_ht' => 'float',
    ];

    // Relationships

    public function payment(): BelongsTo
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function taxe(): BelongsTo
    {
        return $this->belongsTo(Tax::class, 'tax_id');
    }
    // Helper Methods

    public function getFormatedPriceHtAttribute(): string
    {
        return number_format($this->price_ht, 2);
    }

    public function getFormatedPriceTotalAttribute(): string
    {
        return number_format($this->price_total, 2);
    }

    public function getFormatedPriceTvaAttribute()
    {
        return number_format($this->price_tva, 2);
    }
}
