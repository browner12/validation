<?php namespace browner12\validation;

use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider
     *
     * @return void
     */
    public function register()
    {
        //register commands
        $this->commands([
            Commands\ValidatorMakeCommand::class,
        ]);
    }
}
