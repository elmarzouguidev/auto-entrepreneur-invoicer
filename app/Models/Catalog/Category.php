<?php

namespace App\Models\Catalog;

use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pipeline\Pipeline;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements HasMedia
{
    use HasFactory;
    use UuidGenerator;
    use InteractsWithMedia;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'logo',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getIsPublishedAttribute(): string
    {
        return  $this->attributes['is_published'] ? 'Oui' : 'Non';
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('normal')
            ->width(200)
            ->height(200)
            ->sharpen(10)
            ->optimize();
    }

    public static function allCategories()
    {
        $categories = app(Pipeline::class)
            ->send(self::query())
            ->through([
                \App\Filters\QueryFilters\Active::class,
                \App\Filters\QueryFilters\Sort::class,
                \App\Filters\QueryFilters\MaxCount::class,
            ])
            ->thenReturn()
            ->paginate(2);

        return $categories;
    }
}
