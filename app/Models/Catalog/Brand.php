<?php

declare(strict_types=1);

namespace App\Models\Catalog;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Brand extends Model implements HasMedia
{
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;
    use InteractsWithMedia;

    /**
     * @var string[]|array<int,string>
     */
    protected $fillable = [
        'name',
        'description',
        'logo',
        'active',
    ];

    /**
     * @var string[]|array<int,string>
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('normal')
            ->width(200)
            ->height(200)
            ->sharpen(10)
            ->optimize();
    }
}
