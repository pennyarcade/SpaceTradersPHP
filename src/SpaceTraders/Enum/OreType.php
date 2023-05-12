<?php
declare(strict_types=1);

namespace App\SpaceTraders\Enum;

use App\Common\Trait\Enum;

enum OreType: string
{
    use Enum;

    case IRON = "IRON";
    case COPPER = "COPPER";
    case SILVER = "SILVER";
    case GOLD = "GOLD";
    case ALUMINUM = "ALUMINUM";
    case PLATINUM = "PLATINUM";
    case URANITE = "URANITE";
    case MERITIUM = "MERITIUM";
    case FUEL = "FUEL";
}
