<?php
declare(strict_types=1);

namespace App\SpaceTraders\Enum;

use App\Common\Trait\Enum;

enum ShipCrewRotation: string
{
    use Enum;

    case STRICT = "STRICT";
    case RELAXED = "RELAXED";
}
