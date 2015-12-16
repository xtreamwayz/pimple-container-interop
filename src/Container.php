<?php

namespace Xtreamwayz\Pimple;

use Interop\Container\ContainerInterface;
use Pimple\Container as Pimple;
use Xtreamwayz\Pimple\Exception\ContainerException;
use Xtreamwayz\Pimple\Exception\NotFoundException;

class Container extends Pimple implements ContainerInterface
{
    /**
     * @var ContainerInterface[]
     */
    protected $delegates = [];

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundException  No entry was found for this identifier.
     * @throws ContainerException Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get($id)
    {
        try {
            // Try this container
            if ($this->offsetExists($id)) {
                return $this->offsetGet($id);
            }

            // Try delegates
            foreach ($this->delegates as $container) {
                if ($container->has($id)) {
                    return $container->get($id);
                }
            }

            // Nothing found, throw exception
            throw new NotFoundException(sprintf('Identifier "%s" is not defined.', $id));
        } catch (\InvalidArgumentException $exception) {
            throw new NotFoundException($exception->getMessage(), $exception->getCode(), $exception);
        } catch (\Exception $exception) {
            throw new ContainerException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundException`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return boolean
     */
    public function has($id)
    {
        // Try this container
        if ($this->offsetExists($id)) {
            return true;
        }

        // Try delegates
        foreach ($this->delegates as $container) {
            if ($container->has($id)) {
                return true;
            }
        }

        // Nothing found, return false
        return false;
    }

    /**
     * Delegate a backup container to be checked for services if it cannot be resolved via this container.
     *
     * @param  ContainerInterface $container
     */
    public function delegate(ContainerInterface $container)
    {
        $this->delegates[] = $container;
    }
}
