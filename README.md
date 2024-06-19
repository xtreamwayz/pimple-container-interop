[![No Maintenance Intended](http://unmaintained.tech/badge.svg)](http://unmaintained.tech/)

Thank you so much for being interested in this project! Open Source is rewarding, but it can also be exhausting. Therefor this code is provided as-is, and is currently not actively maintained. We invite you to peruse the code and even use it in your next project, provided you follow the included license!

No guarantee of support for the code is provided, and there is no promise that pull requests will be reviewed or merged. It’s open source, so forking is allowed; just be sure to give credit where it’s due!

---

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
$container['hi'] = 'welcome';

$delegate1 = new Acme\Container\DelegateContainer;
$delegate1['foo'] = 'bar';
$container->delegate($delegate1);

$delegate2 = new Xtreamwayz\Pimple\Container;
$delegate2['baz'] = 'qux';
$container->delegate($delegate2);

// Resolve dependency from main $container
$container->has('hi'); // true
$container->get('hi'); // returns 'welcome';

// Resolve dependency from $delegate1
$container->has('foo'); // true
$container->get('foo'); // returns 'bar';

// Resolve dependency from $delegate2
$container->has('baz'); // true
$container->get('baz'); // returns 'qux';
```

Once the delegate has been registered and a lookup is not resolved in the main container, it tries the ``has`` and
``get`` methods of each delegate in the order it was registered.
