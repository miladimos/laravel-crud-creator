<?php

return [

    'base_app_namespace' => 'App',

    'models_namespace' => 'Models',

    'request_namespace' => 'Request',

    'request_suffix' => 'Request',

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
