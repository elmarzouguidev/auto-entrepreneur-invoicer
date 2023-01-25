<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

trait UuidGenerator
{
    public static function bootUuidGenerator(): void
    {
        static::creating(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'uuid')) {
                $model->uuid = Str::uuid();
            }
        });
    }
}
