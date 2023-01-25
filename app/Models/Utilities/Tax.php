<?php

declare(strict_types=1);

namespace App\Models\Utilities;

use App\Models\Catalog\Product;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tax extends Model
{
    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;

    /**
     * @var string[]|array<int,string>
     */
    protected $fillable = [
        'name',
        'taux_percent',
        'taux',
        'active',
    ];

    /**
     * @var string[]|array<int,string>
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    // Relationships

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    // Helper Methods
}
