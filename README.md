# Reflective Reflection

Reflective is a formally defined reflection mechanism in PHP, which is used to query detailed information about classes, methods, properties, functions, etc.

[![GitHub Tag](https://img.shields.io/github/v/tag/dependencies-packagist/reflective-reflection)](https://github.com/dependencies-packagist/reflective-reflection/tags)
[![Total Downloads](https://img.shields.io/packagist/dt/reflective/reflection?style=flat-square)](https://packagist.org/packages/reflective/reflection)
[![Packagist Version](https://img.shields.io/packagist/v/reflective/reflection)](https://packagist.org/packages/reflective/reflection)
[![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/reflective/reflection)](https://github.com/dependencies-packagist/reflective-reflection)
[![Packagist License](https://img.shields.io/github/license/dependencies-packagist/reflective-reflection)](https://github.com/dependencies-packagist/reflective-reflection)

## Installation

You can install the package via [Composer](https://getcomposer.org/):

```bash
composer require reflective/reflection
```

## Usage

```php
use Reflective\Reflection\ReflectionParentClass;

$ref = new ReflectionParentClass(AccountController::class);
dd(
    $ref->getParentsClass(),
    $ref->getParentsClass(BaseController::class),
    $ref->getParentsClass(BaseController::class, ReflectionParentClass::IS_INSTANCEOF),
);
```

## License

Nacosvel Contracts is made available under the MIT License (MIT). Please see [License File](LICENSE) for more information.
