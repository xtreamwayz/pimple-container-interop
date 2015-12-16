<?php

namespace Interop\Container\PimpleTests;

use Interop\Container\Pimple\PimpleInterop;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testHas()
    {
        $container = new PimpleInterop();
        $container['foo'] = 'bar';

        $this->assertTrue($container->has('foo'));
        $this->assertFalse($container->has('wow'));
    }

    public function testGet()
    {
        $container = new PimpleInterop();
        $container['foo'] = 'bar';

        $this->assertEquals('bar', $container->get('foo'));
    }
}
