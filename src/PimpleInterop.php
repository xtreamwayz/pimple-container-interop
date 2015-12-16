<?php

namespace Interop\Container\Pimple;

use Interop\Container\ContainerInterface;
use Pimple\Container as Pimple;
use Interop\Container\Pimple\Exception\ContainerException;
use Interop\Container\Pimple\Exception\NotFoundException;

class PimpleInterop extends Pimple implements ContainerInterface
{
    public function offsetGet($id)
    {
        try {
            return parent::offsetGet($id);
        } catch (\InvalidArgumentException $exception) {
            throw new NotFoundException($exception->getMessage(), $exception->getCode(), $exception);
        } catch (\Exception $exception) {
            throw new ContainerException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    public function get($id)
    {
        return $this->offsetGet($id);
    }
    public function has($id)
    {
        return $this->offsetExists($id);
    }
}
