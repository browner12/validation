<?php namespace browner12\validation;

use Illuminate\Console\GeneratorCommand;

class ValidationMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:validation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new validation definition.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Validator';

    /**
     * Parse the name and format according to the root namespace.
     *
     * @param  string $name
     * @return string
     */
    protected function parseName($name)
    {
        return ucwords(camel_case($name)) . 'Validation';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../stubs/validation.stub';
    }

    /**
     * Get the destination class path.
     *
     * @param  string $name
     * @return string
     */
    protected function getPath($name)
    {
        return base_path() . '/Validation/' . str_replace('\\', '/', $name) . '.php';
    }
}
