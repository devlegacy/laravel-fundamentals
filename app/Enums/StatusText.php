<?php

namespace App\Enums;

use Rexlabs\Enum\Enum;

/**
 * The StatusText enum.
 *
 * @method static self IN_PROGRESS()
 * @method static self COMPLETE()
 * @method static self FAILED()
 */
class StatusText extends Enum
{
    const IN_PROGRESS = 'in_progress';
    const COMPLETE = 'complete';
    const FAILED = 'failed';
}

// php artisan make:enum StatusText 'IN_PROGRESS|COMPLETE|FAILED'
// read more on: https://github.com/rexlabsio/enum-php
