<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Roles extends Enum
{
    const SUPERADMIN =   'SUPERADMIN';
    const STAFF =   'STAFF';
    const GUEST = 'GUEST';
}
