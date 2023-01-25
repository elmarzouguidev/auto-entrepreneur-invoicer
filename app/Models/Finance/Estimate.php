<?php

namespace App\Models\Finance;

use App\Models\Client;
use App\Models\Scopes\EstimateScopes;
use App\Models\Utilities\History;
use App\Models\Utilities\PaymentType;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Estimate extends Model
{
    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;
    //use SoftDeletes;

    use EstimateScopes;

    protected $fillable = [
        'is_invoiced',
        'code',
        'full_number',
        'price_ht',
        'price_total',
        'price_tva',
        'ht_price_remise',
        'status',
        'estimate_date',
        'due_date',
        'invoice_id',
        'client_id',
        'is_send',
        'active',
        'condition_general',
        'payment_type_id',
    ];

    protected $with = [];

    //protected $dates = ['due_date', 'estimate_date'];

    protected $casts = [
        'is_send' => 'boolean',
        'due_date' => 'date:Y-m-d',
        'estimate_date' => 'date:Y-m-d',
        'has_header' => 'boolean',
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

    public function getFormatedHtPriceRemiseAttribute(): string
    {
        return number_format($this->ht_price_remise, 2);
    }

    public function getUrlAttribute(): string
    {
        return route('commercial:estimates.single', $this->uuid);
    }

    public function getEditUrlAttribute(): string
    {
        return route('commercial:estimates.edit', $this->uuid);
    }

    public function getUpdateUrlAttribute(): string
    {
        return route('commercial:estimates.update', $this->uuid);
    }

    public function getCreateInvoiceUrlAttribute(): string
    {
        return route('commercial:estimates.create.invoice', $this->uuid);
    }

    public function getPdfUrlAttribute(): string
    {
        return route('public.show.estimate', ['estimate' => $this->uuid]);
    }

    public function getIsPublishedAttribute(): bool
    {
        return $this->published_at->lessThanOrEqualTo(Carbon::now());
    }

    public function getFullDateAttribute(): string
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at);

        return $date->translatedFormat('d').' '.$date->translatedFormat('F').' '.$date->translatedFormat('Y');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (self::count() <= 0) {
                $number = getDocument()->estimate_start;
            } else {
                $number = ($model->max('code') + 1);
            }

            $code = str_pad($number, 5, 0, STR_PAD_LEFT);

            $model->code = $code;

            $model->full_number = getDocument()->estimate_prefix.$code;
        });
    }
}
