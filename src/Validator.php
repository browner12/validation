<?php namespace browner12\validation;

use Illuminate\Contracts\Validation\Factory;

abstract class Validator
{
    /**
     * @var \Illuminate\Contracts\Validation\Factory
     */
    protected $factory;

    /**
     * @var \Illuminate\Contracts\Support\MessageBag
     */
    protected $errors;

    /**
     * constructor
     *
     * @param \Illuminate\Contracts\Validation\Factory $factory
     */
    public function __construct(Factory $factory)
    {
        //assign
        $this->factory = $factory;
    }

    /**
     * check if the input is valid
     *
     * @param array  $attributes
     * @param string $rules
     * @return bool
     */
    public function isValid(array $attributes, $rules = 'rules')
    {
        //validator
        $validator = $this->factory->make($attributes, static::${$rules});

        //passes validation
        if (!$validator->fails()) {
            return true;
        }

        //failed validation
        $this->errors = $validator->getMessageBag();
        return false;
    }

    /**
     * get errors
     *
     * @return \Illuminate\Contracts\Support\MessageBag
     */
    public function getErrors()
    {
        return $this->errors;
    }

}
