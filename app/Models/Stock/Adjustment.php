<?php

declare(strict_types=1);

namespace App\Models\Stock;

use App\Models\User;
use App\Models\Utilities\History;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Adjustment extends Model
{
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;

    /**
     * @var string[]|array<int,string>
     */
    protected $fillable = [
        'uuid',
        'qte_brut',
        'qte_net',
        'qte',
        'type',
        'date',
        'reference',
        'notes',
        'warehouse_id',
    ];

    /**
     * @var string[]|array<int,string>
     */
    protected $casts = [];

    // Relationships

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function adjustmentsProducts(): HasMany
    {
        return $this->hasMany(AdjustmentProduct::class);
    }

    public function histories(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(History::class, 'historyable')->orderByDesc('created_at');
    }

    // Helper Methods

    // Accessors
    protected function getType(): Attribute
    {
        return new Attribute(
            fn () => $this->type === 'add' ? 'Addition' : 'Soustraction'
        );
    }
}
