<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class PathToZip implements Rule
{
    /**
     * @return void
     */
    public function __construct(
        //
    ) {
    }

    /**
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Str::endsWith($value, '.zip');
    }

    public function message()
    {
        return 'It must be a zip file';
    }
}
