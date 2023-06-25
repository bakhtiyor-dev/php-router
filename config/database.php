<?php

return [
    'drivers' => [
        'mysql' => [
            'host' => $_ENV['DB_HOST'] ?? '',
            'db_name' => $_ENV['DB_NAME'] ?? '',
            'username' => $_ENV['DB_USERNAME'] ?? '',
            'password' => $_ENV['DB_PASSWORD'] ?? ''
        ]
    ]
];
