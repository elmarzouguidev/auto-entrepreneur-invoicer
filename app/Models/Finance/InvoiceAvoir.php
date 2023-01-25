<?php

namespace App\Models\Finance;

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

class InvoiceAvoir extends Model
{
    use HasFactory;

    // use SoftDeletes;
    use GetModelByUuid;
    use UuidGenerator;

    protected $fillable = ['status', 'type', 'is_send', 'condition_general', 'payment_type_id'];

    protected $casts = [
        'due_date' => 'date:Y-m-d',
        'invoice_date' => 'date:Y-m-d',
        'is_send' => 'boolean',
    ];

    public function payment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }

    public function invoice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function articles(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Article::class, 'articleable')->orderBy('created_at', 'ASC');
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

    public function getUrlAttribute(): string
    {
        return route('commercial:invoices.single.avoir', $this->uuid);
    }

    public function getEditUrlAttribute(): string
    {
        return route('commercial:invoices.edit.avoir', $this->uuid);
    }

    public function getUpdateUrlAttribute(): string
    {
        return route('commercial:invoices.update.avoir', $this->uuid);
    }

    public function getPdfUrlAttribute(): string
    {
        return route('commercial:invoices.pdf.build.avoir', $this->uuid);
    }

    public function getAddBillAttribute(): string
    {
        return route('commercial:bills.addBill.avoir', $this->uuid);
    }

    public function scopeFiltersDateInvoiceAvoir(Builder $query, $from): Builder
    {
        return $query->whereDate('invoice_date', Carbon::createFromFormat('d-m-Y', $from)->format('Y-m-d'));
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

    public function scopeFiltersClients(Builder $query, $client): Builder
    {
        return $query->where('client_id', $client);
    }

    public function scopeFiltersCompanies(Builder $query, $company): Builder
    {
        //$company = Company::whereUuid($company)->firstOrFail()->id;

        return $query->where('company_id', $company);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (self::count() <= 0) {
                $number = getDocument()->invoice_avoir_start;
            } else {
                $number = ($model->max('code') + 1);
            }

            $code = str_pad($number, 5, 0, STR_PAD_LEFT);

            $model->code = $code;

            $model->full_number = getDocument()->invoice_avoir_prefix.$code;
        });
    }
}
