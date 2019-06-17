<?php

namespace App\Enums;

use Rexlabs\Enum\Enum;

/**
 * The StatusNumber enum.
 *
 * @method static self IN_PROGRESS()
 * @method static self COMPLETE()
 * @method static self FAILED()
 */
class StatusNumber extends Enum
{
    const IN_PROGRESS = 1;
    const COMPLETE = 2;
    const FAILED = 3;
}

// php artisan make:enum StatusNumber 'IN_PROGRESS=1|COMPLETE=2|FAILED=3'
// read more on: https://github.com/rexlabsio/enum-php
