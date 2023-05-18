<?php

declare(strict_types=1);

namespace App\SpaceTraders\Enum;

use App\Common\Trait\Enum;

enum WaypointType: string
{
    use Enum;

    case PLANET = "PLANET";
    case GAS_GIANT = "GAS_GIANT";
    case MOON = "MOON";
    case ORBITAL_STATION = "ORBITAL_STATION";
    case JUMP_GATE = "JUMP_GATE";
    case ASTEROID_FIELD = "ASTEROID_FIELD";
    case NEBULA = "NEBULA";
    case DEBRIS_FIELD = "DEBRIS_FIELD";
    case GRAVITY_WELL = "GRAVITY_WELL";
}
