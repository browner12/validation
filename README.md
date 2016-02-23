# Validation

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This is a validation package built to complement Laravel's included validation. One of the main benefits of this package is a separate file houses the reusable rules for validation.

## Install

``` bash
$ composer require browner12/validation
```

## Setup

Add the service provider to the providers array in  `config/app.php`.

``` php
'providers' => [
    browner12\validation\ValidationServiceProvider::class,
];
```

## Usage

Use Artisan to generate a new validator.

``` sh
php artisan make:validator UserValidator
```

Validators extend the abstract `browner12\validation\Validator`, which contains all of the methods necessary to perform validation. The only thing you need to define are your rules. For example, if you have a 'Product' model, you could create a `ProductValidator`. While they *can* be placed anywhere that can be autoloaded, a good suggestion is `app/Validation`.

``` php
namespace App\Validation;

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

As you can see, validators can contain multiple rule sets. To use the validator, create a new `Validator` object, or use dependency injection (DI is used in the example). Pass in the data to be validated and the name of the rule set to use. A good place to handle the validation is in a dedicated class (sometimes referred to as a Service) so it can be reused throughout the site.

``` php
namespace App\Services;

use App\Validation\ProductValidator;
use browner12\validation\ValidationException;

class ProductService
{
    /**
     * constructor
     *
     * @param \App\Validation\ProductValidator $validator
     */
    public function __construct(ProductValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * store product
     *
     * @param array $input
     */
    public function store(array $input)
    {
        if ($this->validator->isValid($input, 'store')) {
    
            //data is good, save to storage
            return true;
        }
    
        throw new ValidationException('Storing a product failed.', $this->validator->getErrors());
    }
}
```

Finally, your controller will call the service, and handle any errors that are thrown.

``` php
use App\Services\ProductService;
use browner12\validation\ValidationException;

class ProductController
{
    /**
     * constructor
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * store
     */
    public function store()
    {
        try {
        
            $data = [
                'name'  => $_POST['name'],
                'price' => $_POST['price'],
            ];
        
            $this->service->store($data);
        }
        
        catch (ValidationException $e){
        
            //handle the exception
        }
    }
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
