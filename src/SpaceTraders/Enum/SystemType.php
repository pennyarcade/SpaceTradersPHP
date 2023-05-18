<?php

declare(strict_types=1);

namespace App\SpaceTraders\Enum;

use App\Common\Trait\Enum;

enum SystemType: string
{
    use Enum;

    case NEUTRON_STAR = "NEUTRON_STAR";
    case RED_STAR = "RED_STAR";
    case ORANGE_STAR = "ORANGE_STAR";
    case BLUE_STAR = "BLUE_STAR";
    case YOUNG_STAR = "YOUNG_STAR";
    case WHITE_DWARF = "WHITE_DWARF";
    case BLACK_HOLE = "BLACK_HOLE";
    case HYPERGIANT = "HYPERGIANT";
    case NEBULA = "NEBULA";
    case UNSTABLE = "UNSTABLE";
}
