<?php

return [
    'login' => [
        'message' => [
            'login_success'=> 'login success'
        ],
        'form'          => [
            'btn'       => [
                'login' => 'Login Now',
            ],
            'user_name'     => 'User Name',
            'password'  => 'Password',
        ],
        'routes'        => [
            'index' => 'Login',
        ],
        'validations'   => [
            'email'     => [
                'email'     => 'Please add correct email format',
                'required'  => 'Please add your email address',
            ],
            'failed'    => 'These credentials do not match our records.',
            'blocked'    => 'Your account has been blocked !',
            'password'  => [
                'min'       => 'Password must be more than 6 characters',
                'required'  => 'The password field is required',
            ],
        ],
    ],
];
