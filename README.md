# validation

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This package is a wrapper built around Laravel's validation.

## Install

``` bash
$ composer require browner12/validation
```

## Generator

If you wish to use the included generator, open `app/Console/Kernel.php` and add it to the commands property.

``` php
protected $commands = [
    \browner12\validation\ValidatorMakeCommand::class,
];
```

Then use Artisan to generate a new validator.

``` sh
php artisan make:validator UserValidator
```

## Usage

Validators extend the abstract `browner12\validation\Validator`, which contains all of the methods necessary to perform validation. The only thing you need to define are your rules. For example, if you have a 'Product' model, you could create a `ProductValidator`. While they can be placed anywhere that can be autoloaded, a good suggestion is `app/Validation`.

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

As you can see, you can have multiple rule sets per validator. To use the validator you create a new object, or use dependency injection (we use DI in the example). Then you will pass in the data to be validated, and the name of the rule set to use.

``` php
class ProductService()
{
    /**
     * constructor
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
        }
    
        throw new ValidationException('Storing a product failed.', $validator->getErrors());
    }
}
```

This code will most often go in some type of service, like the previous example, so it can be used throughout the site.

Finally, your controller will call the service, and handle any errors that are thrown.

``` php
class ProductController
{
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
        
            $productService->store($data);
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
