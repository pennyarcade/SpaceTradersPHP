<?php
declare(strict_types=1);

namespace App\SpaceTraders\Enum;

use App\Common\Trait\Enum;

enum ShipNavFlightMode: string
{
    use Enum;

    case DRIFT = "DRIFT";
    case STEALTH = "STEALTH";
    case CRUISE = "CRUISE";
    case BURN = "BURN";
}
