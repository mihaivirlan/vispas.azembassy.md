<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'user',
        'passwords' => 'users',
    ],

    //Authenticating guards
    'guards' => [
        'user' =>[
            'driver' => 'session',
            'provider' => 'user',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],
    ],

//User Providers
    'providers' => [
        'user' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],
        'admin' => [
            'driver' => 'eloquent',
            'model' => App\Admin::class,
        ]
    ],

//Resetting Password
    'passwords' => [
        'clients' => [
            'provider' => 'client',
            'email' => 'auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'admins' => [
            'provider' => 'admin',
            'email' => 'admin.auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],
];
