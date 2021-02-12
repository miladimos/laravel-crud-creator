<?php

return [

    'base_app_namespace' => 'App',

    'models_namespace' => 'Models',

    'request' => [
        'namespace' => 'Request',

        'suffix' => 'Request',
    ],

    'api' => [
        'namespace' => 'Api',

        'version' => 'v1',

        'resources' => [
            'namespace' => 'Resource',

            'suffix' => 'Resource',
        ],
    ],

    'web' => [
        'namespace' => 'Site',
    ],

    'pagination' => [
        'per_page' => 8,
    ],
];
