<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StoreToDisk implements Rule
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
        $configuredBackupDisks = ['google', 'dropbox'];

        return in_array($value, $configuredBackupDisks);
    }

    public function message()
    {
        return 'Current disk is not configured as a backup disk';
    }
}
