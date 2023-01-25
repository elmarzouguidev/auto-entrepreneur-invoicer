<?php

declare(strict_types=1);

namespace App\Models\Expense;

use App\Models\Client;
use App\Models\Finance\Provider;
use App\Models\Schedule\Schedule;
use App\Models\Utilities\Currency;
use App\Models\Utilities\PaymentType;
use App\Models\Utilities\Tax;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Expense extends Model implements HasMedia
{
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;
    use InteractsWithMedia;

    /**
     * @var string[]|array<int,string>
     */
    protected $fillable = [
        'uuid',
        'full_number',
        'code',
        'name',
        'note',
        'expense_date',
        'price_total',
        'price_ht',
        'price_tax',
        'reference',
        'conditions',
        'active',
        'category_id',
        'currency_id',
        'client_id',
        'provider_id',
        'tax_id',
        'payment_type_id',
        'schedule_id',
    ];

    /**
     * @var string[]|array<int,string>
     */
    protected $casts = [
        'price' => 'float',
        'active' => 'boolean',
        'conditions' => 'array',
        'expense_date' => 'date',
        'price_total' => 'float',
        'price_ht' => 'float',
        'price_tax' => 'float',
    ];

    // Relationships

    public function schedule(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function currency(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function payment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function taxe(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Tax::class, 'tax_id')->withDefault();
    }

    public function provider(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Provider::class)->withDefault();
    }

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Client::class)->withDefault();
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }

    public function invoices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ExpenseInvoice::class);
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

    public function getFormatedPriceTaxAttribute(): string
    {
        return number_format($this->price_tax, 2);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (self::count() <= 0) {
                $number = getDocument()->expense_start;
            } else {
                $number = ($model->max('code') + 1);
            }

            $code = str_pad("$number", 5, '0', STR_PAD_LEFT);

            $model->code = $code;

            $model->full_number = getDocument()->expense_prefix.$code;
        });
    }
}
