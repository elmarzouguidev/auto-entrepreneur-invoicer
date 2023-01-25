<?php

declare(strict_types=1);

namespace App\Models\Stock;

use App\Models\Catalog\Product;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdjustmentProduct extends Model
{
    use HasFactory;
    use UuidGenerator;

    /**
     * @var string[]|array<int,string>
     */
    protected $fillable = [
        'product_id',
        'adjustment_id',
        'warehouse_id',
        'qte',
        'type',
        'date',
    ];

    /**
     * @var string[]|array<int,string>
     */
    protected $casts = [];

    // Relationships

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function adjustment(): BelongsTo
    {
        return $this->belongsTo(Adjustment::class);
    }

    // Helper Methods

    // Accessors
    protected function getType(): Attribute
    {
        return new Attribute(
            fn () => $this->type === 'add' ? 'Addition' : 'Soustraction'
        );
    }

    protected function getAdditions(): Attribute
    {
        return new Attribute(
            fn () => $this->where('type', 'add')->sum('qte')
        );
    }

    protected function getSubs(): Attribute
    {
        return new Attribute(
            fn () => $this->where('type', 'sub')->sum('qte')
        );
    }

    public function totalQte($warehouseId)
    {
        $additions = $this->where('warehouse_id', $warehouseId)
            ->where('type', 'add')
            ->sum('qte');
        $subbs = $this->where('warehouse_id', $warehouseId)
            ->where('type', 'sub')
            ->sum('qte');
        if ($additions > $subbs) {
            return $additions - $subbs;
        }

        return 00;
    }
}
