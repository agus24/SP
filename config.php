<?php

return [
    'app_name' => "Micro",
    'database' => [
        'name' => 'micro_test',
        'username' => 'root',
        'password' => '',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],
    "error" => [
        "404" => "error/404",
        "405" => "error/405"
    ]
];
