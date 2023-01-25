<?php

declare(strict_types=1);

namespace App\Models\Finance\Buy;

use App\Models\Finance\Article;
use App\Models\Finance\Provider;
use App\Models\Utilities\PaymentType;
use App\Models\Utilities\Tax;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BuyInvoice extends Model implements HasMedia
{
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;
    use InteractsWithMedia;

    /**
     * @var string[]|array<int,string>
     */
    protected $fillable = [
        'status',
        'type',
        'payment_mode',
        'due_date',
        'invoice_date',
        'condition_general',
        'price_tva',
        'price_ht',
    ];

    /**
     * @var string[]|array<int,string>
     */
    protected $casts = [
        'due_date' => 'date:Y-m-d',
        'invoice_date' => 'date:Y-m-d',
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

    public function articles(): MorphMany
    {
        return $this->morphMany(Article::class, 'articleable')->orderBy('created_at', 'ASC');
    }

    // Helper Methods
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('normal')
            ->width(800)
            ->height(800)
            ->sharpen(10)
            ->optimize();
    }

    /*public function setConditionGeneralAttribute($value)
    {
        $this->attributes['condition_general'] = nl2br($value);
    }

    public function getConditionAttribute()
    {
        //dd($this->condition_general);
        return str_replace('<br />', "\n", $this->attributes['condition_general']);
    }*/

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
