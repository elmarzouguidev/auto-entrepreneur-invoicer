<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;

class ExcelRule implements Rule
{
    private $file;

    public function __construct(UploadedFile $file)
    {
        $this->file = $file;
    }

    public function passes($attribute, $value)
    {
        $extension = strtolower($this->file->getClientOriginalExtension());

        return in_array($extension, ['csv', 'xls', 'xlsx']);
    }

    public function message()
    {
        return 'The excel file must be a file of type: csv, xls, xlsx.';
    }
}
