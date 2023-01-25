<?php

declare(strict_types=1);

namespace App\Models\Utilities;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;

    /**
     * @var string[]|array<int,string>
     */
    protected $fillable = [
        'name',
        'symbole',
        'code',
        'default',
        'code',
    ];

    /**
     * @var string[]|array<int,string>
     */
    protected $casts = [
        'default' => 'boolean',
        'active' => 'boolean',
    ];

    // Relationships

    // Helper Methods
}
