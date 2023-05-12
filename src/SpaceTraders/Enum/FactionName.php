<?php
declare(strict_types=1);

namespace App\SpaceTraders\Enum;

use App\Common\Trait\Enum;

enum FactionName: string
{
    use Enum;

    case COSMIC = 'COSMIC';
    case VOID = 'VOID';
    case GALACTIC = 'GALACTIC';
    case QUANTUM = 'QUANTUM';
    case DOMINION = 'DOMINION';
}
