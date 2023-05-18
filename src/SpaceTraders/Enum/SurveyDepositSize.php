<?php

declare(strict_types=1);

namespace App\SpaceTraders\Enum;

use App\Common\Trait\Enum;

enum SurveyDepositSize: string
{
    use Enum;

    case SMALL = "SMALL";
    case MODERATE = "MODERATE";
    case LARGE = "LARGE";
}
