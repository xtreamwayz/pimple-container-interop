<?php

namespace Interop\Container\PimpleTests;

use Xtreamwayz\Pimple\Container;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Container
     */
    private $container;

    public function setup()
    {
        $this->container = new Container();
        $this->container['foo'] = 'bar';
    }

    public function testHas()
    {
        $this->assertTrue($this->container->has('foo'));
        $this->assertFalse($this->container->has('wow'));
    }

    public function testGet()
    {
        $this->assertEquals('bar', $this->container->get('foo'));
    }

    /**
     * @expectedException \Xtreamwayz\Pimple\Exception\NotFoundException
     */
    public function testNotFoundException()
    {
        $this->container->get('invalid');
    }

    public function testDelegatedHas()
    {
        $delegate = new Container();
        $delegate['baz'] = 'qux';
        $this->container->delegate($delegate);

        $this->assertTrue($this->container->has('baz'));
        $this->assertFalse($this->container->has('wow'));
    }

    public function testDelegatedGet()
    {
        $delegate = new Container();
        $delegate['baz'] = 'qux';
        $this->container->delegate($delegate);

        $this->assertEquals('qux', $this->container->get('baz'));
    }
}
