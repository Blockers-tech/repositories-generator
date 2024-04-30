# Repositories Generator

[![Latest Stable Version](http://poser.pugx.org/blockers-tech/repositories/v)](https://packagist.org/packages/blockers-tech/repositories) [![Total Downloads](http://poser.pugx.org/blockers-tech/repositories/downloads)](https://packagist.org/packages/blockers-tech/repositories) [![Latest Unstable Version](http://poser.pugx.org/blockers-tech/repositories/v/unstable)](https://packagist.org/packages/blockers-tech/repositories) [![License](http://poser.pugx.org/blockers-tech/repositories/license)](https://packagist.org/packages/blockers-tech/repositories) [![PHP Version Require](http://poser.pugx.org/blockers-tech/repositories/require/php)](https://packagist.org/packages/blockers-tech/repositories)

Simple package to provide easy generation of repository classes to support Repository Pattern in Laravel.

## Installation

You can install the package via composer:

```bash
composer require blockers-tech/repositories
```



Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="repositories-generator-views"
```

## Usage

```bash
php artisan make:repository User (Any model name)
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Rose Riyadh](https://github.com/roseriyadh)
- [Blockers Technology](https://github.com/blockers-tech)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
