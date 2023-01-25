<?php

declare(strict_types=1);

namespace App\Models\Finance\Buy;

use App\Models\Finance\Provider;
use App\Models\Utilities\PaymentType;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BuyBcommand extends Model
{
    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;

    /**
     * @var string[]|array<int,string>
     */
    protected $fillable = [];

    /**
     * @var string[]|array<int,string>
     */
    protected $casts = [];

    // Relationships
    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(PaymentType::class);
    }
    // Helper Methods
}
