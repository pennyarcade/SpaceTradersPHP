<?php
declare(strict_types=1);

namespace App\SpaceTraders\Enum;

use App\Common\Trait\Enum;

enum ShipReactorSymbolType: string
{
    use Enum;

    case REACTOR_SOLAR_I = "REACTOR_SOLAR_I";
    case REACTOR_FUSION_I = "REACTOR_FUSION_I";
    case REACTOR_FISSION_I = "REACTOR_FISSION_I";
    case REACTOR_CHEMICAL_I = "REACTOR_CHEMICAL_I";
    case REACTOR_ANTIMATTER_I = "REACTOR_ANTIMATTER_I";
}
