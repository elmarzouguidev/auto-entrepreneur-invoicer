<?php

namespace App\Models\Finance;

use App\Models\Catalog\Product;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    use UuidGenerator;

    //use SoftDeletes;

    protected $fillable = [
        'articleable_id',
        'articleable_type',
        'designation',
        'description',
        'quantity',
        'prix_unitaire',
        'montant_ht',
        'remise_fix',
        'remise',
        'taux_remise',
        'product_id',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'remise_fix' => 'boolean',
        //'montant_ht' => 'integer',
        //'prix_unitaire' => 'integer'
    ];

    public function articleable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getFormatedMontantHtAttribute(): string
    {
        return number_format($this->montant_ht, 2);
    }

    public function getFormatedPrixUnitaireAttribute(): string
    {
        return number_format($this->prix_unitaire, 2);
    }

    public function getFormatedPriceRemiseAttribute(): string
    {
        return number_format($this->taux_remise, 2);
    }

    /* public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = nl2br($value);
    }*/

    public function setDesignationAttribute($value)
    {
        $this->attributes['designation'] = nl2br($value);
    }
}
