<?php
declare(strict_types=1);

namespace App\SpaceTraders\Enum;

use App\Common\Trait\Enum;

enum ContractType: string
{
    use Enum;

    case PROCUREMENT = "PROCUREMENT";
    case TRANSPORT = "TRANSPORT";
    case SHUTTLE = "SHUTTLE";
}
