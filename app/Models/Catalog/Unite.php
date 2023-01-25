<?php

declare(strict_types=1);

namespace App\Models\Catalog;

use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unite extends Model
{
    use HasFactory;
    use UuidGenerator;

    /**
     * @var string[]|array<int,string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'symbole',
        'active',
    ];

    /**
     * @var string[]|array<int,string>
     */
    protected $casts = ['active' => 'boolean'];

    // Relationships

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // Helper Methods
}
