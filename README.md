# Pimple-container-interop

This container extends the Pimple 3 container. It also adds the *delegate lookup feature* from
[container-interop](https://github.com/container-interop/container-interop).

## Usage

```php
use Xtreamwayz\Pimple\Container;

$container = new Container();
```

And now you can use all [Pimple features](https://github.com/silexphp/Pimple), and also have the ``has`` and ``get``
functions from container-interop.

## Delegates

The delegate lookup feature allows several containers to share entries. It can perform dependency lookups in other
containers. They can be added with the ``delegate($container)`` function.

```php
$container = new Xtreamwayz\Pimple\Container;

$delegate  = new Acme\Container\DelegateContainer;
$container->delegate($delegate);

$delegate2 = new Xtreamwayz\Pimple\Container;
$container->delegate($delegate);
```

Once the delegate has been registered and a lookup is not resolved in the main container, it tries the ``has`` and
``get`` methods of each delegate in the order it was registered.
