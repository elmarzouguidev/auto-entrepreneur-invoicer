<?php

declare(strict_types=1);

namespace App\Models\Schedule;

use App\Models\Expense\Expense;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;

    /**
     * @var string[]|array<int,string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'unite',
        'number',
        'description',
        'active',
    ];

    /**
     * @var string[]|array<int,string>
     */
    protected $casts = [
        'active' => 'boolean',
        'number' => 'integer',
    ];

    // Relationships

    public function expenses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Expense::class);
    }
    // Helper Methods
}
