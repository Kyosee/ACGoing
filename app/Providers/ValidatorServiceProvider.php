<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('same_session', function($attribute, $value, $parameters) {
            if(empty($parameters))
                throw new ValidationException('Validator: You mast pause which is the filed in sesssion !');

            return Session::get($parameters[0], '') == $value;
        }, 'The :attribute and :parameter in the session must match.');

        Validator::replacer('same_session', function($message, $attribute, $rule, $parameters) {
            return str_replace([':attribute', ':parameter'], [$attribute, $parameters[0]], $message);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
