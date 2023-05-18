<?php

declare(strict_types=1);

namespace App\SpaceTraders\Enum;

use App\Common\Trait\Enum;

enum MarketTransactionType: string
{
    use Enum;

    case PURCHASE = "PURCHASE";
    case SELL = "SELL";
}
