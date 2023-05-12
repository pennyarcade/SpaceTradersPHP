<?php

namespace App\Utility;

use Pimple\Container;
use Psr\Container\ContainerInterface;

class PsrCompatibleContainer extends Container implements ContainerInterface
{
    public function get($id): mixed
    {
        return $this[$id];
    }

    public function has($id): bool
    {
        return isset($this[$id]);
    }
}
