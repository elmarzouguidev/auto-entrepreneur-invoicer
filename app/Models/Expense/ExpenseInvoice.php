<?php

declare(strict_types=1);

namespace App\Models\Expense;

use App\Models\Client;
use App\Models\Finance\Provider;
use App\Models\Utilities\Currency;
use App\Models\Utilities\PaymentType;
use App\Models\Utilities\Tax;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ExpenseInvoice extends Model implements HasMedia
{
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;
    use InteractsWithMedia;

    /**
     * @var string[]|array<int,string>
     */
    protected $fillable = [];

    /**
     * @var string[]|array<int,string>
     */
    protected $casts = [
        'invoice_date' => 'date',
        'conditions' => 'array',
        'active' => 'boolean',
        'price_total' => 'float',
        'price_ht' => 'float',
        'price_tax' => 'float',
    ];

    // Relationships

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class);
    }

    public function currency(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function expense(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Expense::class);
    }

    public function payment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
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

    // Helper Methods
    public function getFormatedPriceHtAttribute()
    {
        return number_format($this->price_ht, 2);
    }

    public function getFormatedPriceTotalAttribute()
    {
        return number_format($this->price_total, 2);
    }

    public function getFormatedPriceTaxAttribute()
    {
        return number_format($this->price_tax, 2);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (self::count() <= 0) {
                $number = getDocument()->expense_invoice_start;
            } else {
                $number = ($model->max('code') + 1);
            }

            $code = str_pad("$number", 5, '0', STR_PAD_LEFT);

            $model->code = $code;

            $model->full_number = getDocument()->expense_invoice_prefix.$code;
        });
    }
}
