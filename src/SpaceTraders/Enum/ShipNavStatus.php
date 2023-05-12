<?php
declare(strict_types=1);

namespace App\SpaceTraders\Enum;

use App\Common\Trait\Enum;

enum ShipNavStatus: string
{
    use Enum;

    case IN_TRANSIT = "IN_TRANSIT";
    case IN_ORBIT = "IN_ORBIT";
    case DOCKED = "DOCKED";
}
