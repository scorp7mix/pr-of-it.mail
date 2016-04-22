<?php

return [

    'domain' => '{{domain}}',

    'db' => [
        'default' => [
            'driver'   => 'mysql',
            'host'     => '127.0.0.1',
            'dbname'   => 'php3',
            'user'     => 'root',
            'password' => '{{db.password}}'
        ]
    ], 
    
    'mail' => [
        'method' => 'smtp',
        'host'   => 'smtp.gmail.com',
        'port'   => 465,
        'secure' => 'ssl',
        'auth'   => [
            'username' => 'scorp7mix',
            'password' => '{{email.password}}',
        ],
        'sender' => 'Maxim Fedorov',
    ],

];