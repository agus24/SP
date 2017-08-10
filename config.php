<?php

return [
    'app_name' => "Micro",
    "session_time" => 120, // dalam menit
    'auth' => [
        "redirect" => [
            "afterLogin" => "",
            "afterLogout" => ""
        ]
    ],
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
