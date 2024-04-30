# Repositories Generator

[![Latest Version on Packagist](https://img.shields.io/packagist/v/blockers-tech/repositories-generator.svg?style=flat-square)](https://packagist.org/packages/blockers-tech/repositories)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/blockers-tech/repositories-generator/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/blockers-tech/repositories/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/blockers-tech/repositories-generator/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/blockers-tech/repositories/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/blockers-tech/repositories-generator.svg?style=flat-square)](https://packagist.org/packages/blockers-tech/repositories)

Simple package to provide easy generation to repository classes to support Repository Pattern in Laravel.

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
