<?php

namespace App\Models\Finance;

use App\Models\Catalog\Product;
use App\Models\Client;
use App\Models\Utilities\History;
use App\Models\Utilities\PaymentType;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Invoice extends Model
{
    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;
    //use SoftDeletes;

    protected $fillable = [
        'status',
        'type',
        'is_paid',
        'is_send',
        'payment_mode',
        'due_date',
        'invoice_date',
        'condition_general',
        'remise_fix',
        'remise',
        'taux_remise',
        'ht_price_remise',
        'payment_type_id',
    ];

    // protected $dates = ['due_date'];

    protected $casts = [
        'due_date' => 'date:Y-m-d',
        'invoice_date' => 'date:Y-m-d',
        'is_send' => 'boolean',
        'remise_fix' => 'boolean',
    ];

    public function payment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }

    public function avoir(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(InvoiceAvoir::class);
    }

    public function estimate(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Estimate::class);
    }

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function articles(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Article::class, 'articleable')->orderBy('created_at', 'ASC');
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'invoice_product');
    }

    public function bill(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Bill::class, 'billable')->withDefault();
    }

    public function histories(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(History::class, 'historyable')->orderBy('created_at', 'ASC');
    }

    public function setConditionGeneralAttribute($value)
    {
        $this->attributes['condition_general'] = nl2br($value);
    }

    public function getConditionAttribute(): array|string
    {
        //dd($this->condition_general);
        return str_replace('<br />', "\n", $this->attributes['condition_general']);
    }

    public function getFormatedPriceHtAttribute(): string
    {
        return number_format($this->price_ht, 2);
    }

    public function getFormatedPriceTotalAttribute(): string
    {
        return number_format($this->price_total, 2);
    }

    public function getFormatedTotalTvaAttribute(): string
    {
        return number_format($this->price_tva, 2);
    }

    public function getFormatedTotalRemiseAttribute(): string
    {
        $remise = $this->articles->sum('taux_remise');

        return number_format($remise, 2);
    }

    public function getUrlAttribute(): string
    {
        return route('commercial:invoices.single', $this->uuid);
    }

    public function getEditUrlAttribute(): string
    {
        return route('commercial:invoices.edit', $this->uuid);
    }

    public function getUpdateUrlAttribute(): string
    {
        return route('commercial:invoices.update', $this->uuid);
    }

    public function getPdfUrlAttribute(): string
    {
        return route('commercial:invoices.pdf.build', $this->uuid);
    }

    public function getAddBillAttribute(): string
    {
        return route('commercial:bills.addBill', $this->uuid);
    }

    public function getIsPublishedAttribute(): bool
    {
        return $this->published_at->lessThanOrEqualTo(Carbon::now());
    }

    public function getIsPassedAttribute(): bool
    {
        return $this->date_due->lessThanOrEqualTo(Carbon::now());
    }

    public function getFullDateAttribute(): string
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at);

        return $date->translatedFormat('d').' '.$date->translatedFormat('F').' '.$date->translatedFormat('Y');
    }

    /*******Filters **/

    public function scopeFiltersDateInvoice(Builder $query, $from): Builder
    {
        return $query->whereDate('created_at', Carbon::createFromFormat('d-m-Y', $from)->format('Y-m-d'));
    }

    public function scopeFiltersCompanies(Builder $query, $company): Builder
    {
        //$company = Company::whereUuid($company)->firstOrFail()->id;

        return $query->where('company_id', $company);
    }

    public function scopeFiltersClients(Builder $query, $client): Builder
    {
        //$company = Company::whereUuid($company)->firstOrFail()->id;

        return $query->where('client_id', $client);
    }

    public function scopeFiltersStatus(Builder $query, $status): Builder
    {
        // dd($status);
        return $query->whereStatus($status);
    }

    public function scopeFiltersPeriods(Builder $query, $period): Builder
    {
        //dd($period,"dd");
        if ($period == 1) {
            return $query->whereBetween(
                'invoice_date',
                [
                    now()->startOfYear()->startOfQuarter(),
                    now()->startOfYear()->endOfQuarter(),
                ]
            );
        }
        if ($period == 2) {
            return $query->whereBetween(
                'invoice_date',
                [
                    now()->startOfYear()->addMonths(3)->startOfQuarter(),
                    now()->startOfYear()->addMonths(3)->endOfQuarter(),
                ]
            );
        }
        if ($period == 3) {
            return $query->whereBetween(
                'invoice_date',
                [
                    now()->startOfYear()->addMonths(6)->startOfQuarter(),
                    now()->startOfYear()->addMonths(6)->endOfQuarter(),
                ]
            );
        }
        if ($period == 4) {
            return $query->whereBetween(
                'invoice_date',
                [
                    now()->startOfYear()->addMonths(9)->startOfQuarter(),
                    now()->startOfYear()->addMonths(9)->endOfQuarter(),
                ]
            );
        }
    }

    public function scopeFiltersDate(Builder $query, $from, $to): Builder
    {
        return $query->whereBetween(
            'invoice_date',
            [
                Carbon::createFromFormat('Y-m-d', $from)->format('Y-m-d'),
                Carbon::createFromFormat('Y-m-d', $to)->format('Y-m-d'),
            ]
        );
    }

    public function scopeDashboard(Builder $query): Builder
    {
        return $query->select(['id', 'uuid', 'full_number', 'price_ht', 'price_tva', 'price_total', 'status', 'due_date', 'invoice_date', 'created_at']);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (self::count() <= 0) {
                $number = getDocument()->invoice_start;
            } else {
                $number = ($model->max('code') + 1);
            }

            $code = str_pad($number, 5, 0, STR_PAD_LEFT);

            $model->code = $code;

            $model->full_number = getDocument()->invoice_prefix.$code;
        });
    }
}
