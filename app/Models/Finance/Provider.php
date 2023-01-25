<?php

namespace App\Models\Finance;

use App\Models\Utilities\Email;
use App\Models\Utilities\Telephone;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    use UuidGenerator;
    use GetModelByUuid;

    public function getEditAttribute()
    {
        return route('buy:providers.edit', $this->uuid);
    }

    public function bCommands(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BCommand::class);
    }

    public function telephones(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Telephone::class, 'telephoneable');
    }

    public function emails(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Email::class, 'emailable');
    }

    public static function boot()
    {
        parent::boot();

        $prefixer = config('app-config.providers.prefix');

        static::creating(function ($model) use ($prefixer) {
            $number = (self::max('id') + 1);

            $model->code = $prefixer.str_pad($number, 5, 0, STR_PAD_LEFT);
        });
    }
}
