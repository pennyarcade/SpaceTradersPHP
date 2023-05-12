<?php
declare(strict_types=1);

namespace App\SpaceTraders\Enum;

use App\Common;
use App\Common\Trait\Enum;

enum ShipType: string
{
    use Enum;

    case SHIP_PROBE = "SHIP_PROBE";
    case SHIP_MINING_DRONE = "SHIP_MINING_DRONE";
    case SHIP_INTERCEPTOR = "SHIP_INTERCEPTOR";
    case SHIP_LIGHT_HAULER = "SHIP_LIGHT_HAULER";
    case SHIP_COMMAND_FRIGATE = "SHIP_COMMAND_FRIGATE";
    case SHIP_EXPLORER = "SHIP_EXPLORER";
    case SHIP_HEAVY_FREIGHTER = "SHIP_HEAVY_FREIGHTER";
    case SHIP_LIGHT_SHUTTLE = "SHIP_LIGHT_SHUTTLE";
    case SHIP_ORE_HOUND = "SHIP_ORE_HOUND";
    case SHIP_REFINING_FREIGHTER = "SHIP_REFINING_FREIGHTER";
}
