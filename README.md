# Factory
Factory helps you create php classes, interfaces and more

[![Author](http://img.shields.io/badge/author-@clarkeash-blue.svg?style=flat-square)](https://twitter.com/clarkeash)
[![Travis](https://img.shields.io/travis/clarkeash/factory.svg?style=flat-square)](https://travis-ci.org/clarkeash/factory)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/clarkeash/factory.svg?style=flat-square)](https://scrutinizer-ci.com/g/clarkeash/factory)
[![Codecov](https://img.shields.io/codecov/c/github/clarkeash/factory.svg?style=flat-square)](https://codecov.io/github/clarkeash/factory)
[![Packagist Version](https://img.shields.io/packagist/v/clarkeash/factory.svg?style=flat-square)](https://packagist.org/packages/clarkeash/factory)
[![License](https://img.shields.io/packagist/l/clarkeash/factory.svg?style=flat-square)](https://github.com/clarkeash/factory/blob/master/LICENSE)

## Installation

```bash
composer global require clarkeash/factory
```

## Usage

This package requires that you have psr-4 autoloading enabled in your composer.json file, as this is how it calculates the namespace for the classes you create.

The factory command should be ran from the root directory, where the composer.json lives.

#### Class

Create a basic class

```bash
factory make:class Application
```

Generates:

````php
<?php

namespace Acme;

class Application
{

}
````

Create an abstract class

```bash
factory make:class Example --abstract
```

Generates:

````php
<?php

namespace Acme;

abstract class Example
{

}
````

#### Interface

Create an interface

```bash
factory make:interface ExampleInterface
```

Generates:

````php
<?php

namespace Acme;

interface ExampleInterface
{

}
````


#### Trait

Create a trait

```bash
factory make:trait ExampleTrait
```

Generates:

````php
<?php

namespace Acme;

trait ExampleTrait
{

}
````

#### Test

Create a test

```bash
factory make:test Application
```

The above command will create a test class to test the Application class. And will generate the following:

````php
<?php

use Acme\Application;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Application
     */
    protected $unit;

    public function setUp()
    {
        $this->unit = new Application();
    }

    /**
     * @test
     */
    public function it_works()
    {
        $this->assertTrue(true);
    }
}
````

## Testing

``` bash
./vendor/bin/phpunit
```

##License

This package is released under the MIT license. Please see the [License File](LICENSE) for more information.
