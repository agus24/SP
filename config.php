<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Nama Aplikasi
    |--------------------------------------------------------------------------
    | Value ini adalah nama aplikasi. Value ini digunakan ketika framework
    | ingin menempatkan nama aplikasi di notifikasi atau di tempat lain
    | yang diinginkan.
    */
    'app_name' => "Micro",

    /*
    |--------------------------------------------------------------------------
    | Waktu Session
    |--------------------------------------------------------------------------
    | Disini anda bisa menempatkan waktu(dalam menit) yang diperbolehkan oleh session
    | untuk tetap ada sebelum kadaluarsa.
    */
    "session_time" => 120,

    /*
    |--------------------------------------------------------------------------
    | Auth Redirect
    |--------------------------------------------------------------------------
    | Disini anda bisa mengatur kemana aplikasi akan menuju setelah login
    | ataupun logout.
    */
    'auth' => [
        "redirect" => [
            "afterLogin" => "user",
            "afterLogout" => "login"
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Database
    |--------------------------------------------------------------------------
    | Disini anda bisa mengatur koneksi dari database yang akan anda gunakan
    | oleh aplikasi.
    */
    'database' => [
        'name' => 'micro_test',
        'username' => 'root',
        'password' => '',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],
    /*
    |--------------------------------------------------------------------------
    | Error
    |--------------------------------------------------------------------------
    | Disini anda bisa mengatur kemana error akan menuju bila terjadi error
    | pada kode tertentu.
    */
    "error" => [
        "404" => "error/404",
        "405" => "error/405"
    ]
];
