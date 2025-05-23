<?php

return [

    'dashboard' => [
        'auth' => [
            'web' ,
            'localizationRedirect' ,
            'localeSessionRedirect',
            'localeViewPath' ,
            'localize',
            'auth:web',
            'dashboard.auth',
            'check.permission',
            'last.login',
        ],
        'guest' => [
            'web',
            'localizationRedirect',
            'localeSessionRedirect',
            'localeViewPath',
            'localize',
        ]
    ],

    'client' => [
        'auth' => [
            'web',
            'localizationRedirect' ,
            'localeSessionRedirect',
            'localeViewPath' ,
            'localize',
            'auth:client',
            'last.login',
            'client.valid.status'
        ],
        'guest' => [
            'web',
            'localizationRedirect' ,
            'localeSessionRedirect',
            'localeViewPath' ,
            'localize',
        ]
    ],

    'frontend' => [
        'auth' => [
            'web',
            'localizationRedirect',
            'localeSessionRedirect',
            'localeViewPath',
            'localize',
            'auth:web',
        ],
        'guest' => [
            'web',
            'localizationRedirect',
            'localeSessionRedirect',
            'localeViewPath',
            'localize',
        ]
    ],

    'api' => [
        'auth' => [
            'api',
            'auth:api',
        ],
        'guest' => [
            'api',
        ]
    ],
];