<?php

namespace App\Overriden\Spatie\MediaLibrary;

use Illuminate\Support\Collection;
use Spatie\MediaLibrary\Conversions\Conversion;
use Spatie\MediaLibrary\Conversions\ImageGenerators\ImageGenerator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Image extends ImageGenerator
{
    public function convert(string $path, Conversion $conversion = null): string
    {
        return $path;
    }

    public function canConvert(Media $media): bool
    {
        if (! $this->requirementsAreInstalled()) {
            return false;
        }

        $validExtension = $this->canHandleExtension($media->extension);

        $validMimeType = $this->canHandleMime(strtolower($media->mime_type));

        if ($this->shouldMatchBothExtensionsAndMimeTypes()) {
            return $validExtension && $validMimeType;
        }

        return $validExtension || $validMimeType;
    }

    public function requirementsAreInstalled(): bool
    {
        //dd('One 2');
        return true;
    }

    public function supportedExtensions(): Collection
    {
        $extensions = ['png', 'jpg', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF'];
        if (config('media-library.image_driver') === 'imagick') {
            $extensions[] = 'tiff';
        }

        return collect($extensions);
    }

    public function supportedMimeTypes(): Collection
    {
        $mimeTypes = ['image/jpeg', 'image/gif', 'image/png'];
        if (config('media-library.image_driver') === 'imagick') {
            $mimeTypes[] = 'image/tiff';
        }

        return collect($mimeTypes);
    }
}
