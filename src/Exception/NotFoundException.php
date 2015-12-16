<?php

namespace Xtreamwayz\Pimple\Exception;

use Interop\Container\Exception\NotFoundException as NotFoundExceptionInterface;

class NotFoundException extends \InvalidArgumentException implements NotFoundExceptionInterface
{
}
