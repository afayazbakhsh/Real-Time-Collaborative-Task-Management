<?php

namespace App\Enums;

use App\Enums\Helpers\EnumHelperTrait;

enum RoleTypesEnum: string
{
    use EnumHelperTrait;

    case Admin = 'admin';

    case User = 'user';

}
