<?php

declare(strict_types=1);

namespace App\Models\Catalog;

use App\Models\Finance\Invoice;
use App\Models\Stock\AdjustmentProduct;
use App\Models\Utilities\Tax;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use UuidGenerator;
    use GetModelByUuid;

    /**
     * @var string[]|array<int,string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'description',
        'qte',
        'price_brut',
        'price_net',
        'price_buy',
        'price_sell',
        'price_tax',
        'price_sell_total',
        'sku',
        'category_id',
        'brand_id',
        'tax_id',
        'unite_id',
    ];

    /**
     * @var string[]|array<int,string>
     */
    protected $casts = [
        'qte' => 'integer',
    ];

    // Relationships

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function unite(): BelongsTo
    {
        return $this->belongsTo(Unite::class);
    }

    public function tax(): BelongsTo
    {
        return $this->belongsTo(Tax::class);
    }

    public function adjustmentsProducts(): HasMany
    {
        return $this->hasMany(AdjustmentProduct::class);
    }

    public function invoices(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Invoice::class, 'invoice_product');
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

    // Accessors

    protected function totalQte(): Attribute
    {
        return new Attribute(function () {
            $additions = $this->adjustmentsProducts->where('type', 'add')->sum('qte');
            $subbs = $this->adjustmentsProducts->where('type', 'sub')->sum('qte');
            if ($additions > $subbs) {
                return $additions - $subbs;
            }

            return 00;
        });
    }
}
