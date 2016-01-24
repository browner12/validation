# validation

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This package is a wrapper built around Laravel's validation

## Install

``` bash
$ composer require browner12/validation
```

## Setup

- Add `browner12\validation\ValidationServiceProvider` to your `config/app.php` list of service providers.

## Generator

If you wish to use the included generator, open `app/Console/Kernel.php` and add it to the commands property.

``` php
protected $commands = [
    \browner12\validation\ValidatorMakeCommand::class,
];
```

To create a validator call

``` sh
php artisan make:validator UserValidator
```

## Usage

Create validators that extends `browner12\validation\Validator`. For example, if you have a 'Product' model, you could create a `ProductValidator`. While they can be placed anywhere that can be autoloaded, a good suggestion is `app/Validation`.

``` php
class ProductValidator extends Validator
{
    protected static $store = [
        'name'  => 'required',
        'price' => 'required|int',
    ];
    
    protected static $update = [
        'name'  => 'required',
        'price' => 'required|int',
    ];
}
```

To use the validator, you can create a new object, or use automatic dependency injection. Then you will pass it the data to be validated, and the name of the rule set to use.

``` php
$validator = new ProductValidator();

$data = [
    'name'  => 'Sprocket',
    'price' => '299',
];

if ($validator->isValid($data, 'store')) {

    //data is good
}

else {
    throw new ValidationException('Storing a product failed.', $validator->getErrors());
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email browner12@gmail.com instead of using the issue tracker.

## Credits

- [Andrew Brown][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/browner12/validation.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/browner12/validation/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/browner12/validation.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/browner12/validation.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/browner12/validation.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/browner12/validation
[link-travis]: https://travis-ci.org/browner12/validation
[link-scrutinizer]: https://scrutinizer-ci.com/g/browner12/validation/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/browner12/validation
[link-downloads]: https://packagist.org/packages/browner12/validation
[link-author]: https://github.com/browner12
[link-contributors]: ../../contributors
