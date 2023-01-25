<?php

declare(strict_types=1);

namespace App\Models\Utilities;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;

    /**
     * @var string[]|array<int,string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'description',
        'active',
    ];

    /**
     * @var string[]|array<int,string>
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    // Relationships

    // Helper Methods
}
