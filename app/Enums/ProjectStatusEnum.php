<?php

namespace App\Enums;

use App\Enums\Helpers\EnumHelperTrait;

/**
 * @method isActive()
 * @method isInActive()
 */
enum ProjectStatusEnum: string
{
    use EnumHelperTrait;

    case Active = 'active';

    case InActive = 'in-active';
}
