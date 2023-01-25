<?php

declare(strict_types=1);

namespace App\Models\Chart;

use App\Models\Finance\Invoice;
use App\Models\Scopes\ClientScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillChart extends Model
{
    use HasFactory;

    protected $table = 'bills';

    public function invoice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'billable_id');
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new ClientScope);
    }
}
