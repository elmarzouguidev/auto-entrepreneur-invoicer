<?php

namespace App\Overriden\Spatie\MediaLibrary;

use Spatie\MediaLibrary\Conversions\Conversion;
use Spatie\MediaLibrary\Support\FileNamer\FileNamer as BaseFileNamer;

class FileNamer extends BaseFileNamer
{
    public function originalFileName(string $fileName): string
    {
        return pathinfo($fileName, PATHINFO_FILENAME);
    }

    public function conversionFileName(string $fileName, Conversion $conversion): string
    {
        $strippedFileName = pathinfo($fileName, PATHINFO_FILENAME);

        return "{$strippedFileName}-{$conversion->getName()}";
    }

    public function responsiveFileName(string $fileName): string
    {
        return pathinfo($fileName, PATHINFO_FILENAME);
    }
}
