<?php

namespace App\Models\Finance\Buy;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

abstract class BuyTrait implements HasMedia
{
    use InteractsWithMedia;

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('normal')
            ->width(800)
            ->height(800)
            ->sharpen(10)
            ->optimize();
    }
}
