<?php

declare(strict_types=1);

namespace App\Models\Stock;

use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;
    use UuidGenerator;

    /**
     * @var string[]|array<int,string>
     */
    protected $fillable = [
        'name',
        'active',
        'code',
    ];

    /**
     * @var string[]|array<int,string>
     */
    protected $casts = [];

    // Relationships

    public function warehouses(): HasMany
    {
        return $this->hasMany(Warehouse::class);
    }
    // Helper Methods
}
