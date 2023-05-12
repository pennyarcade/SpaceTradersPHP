<?php
declare(strict_types=1);

namespace App\SpaceTraders\Enum;

use App\Common\Trait\Enum;

enum SupplyType: string
{
    use Enum;

    case SCARCE = "SCARCE";
    case LIMITED = "LIMITED";
    case MODERATE = "MODERATE";
    case ABUNDANT = "ABUNDANT";
}
