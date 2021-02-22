<?php

$server = "localhost";
$username = "root";
$password = "";

return [
    'db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host='.$server.';dbname=marubiella_auth',
        'username' => $username,
        'password' => $password,
        'charset' => 'utf8',
    ],
    'psgc' => [
        'class' => 'yii\db\Connection',  
        'dsn' => 'mysql:host='.$server.';dbname=marubiella_psgc',
        'username' => $username,
        'password' => $password,
        'charset' => 'utf8',
    ],
    'marubiella' => [
        'class' => 'yii\db\Connection',  
        'dsn' => 'mysql:host='.$server.';dbname=marubiella',
        'username' => $username,
        'password' => $password,
        'charset' => 'utf8',
    ],
    
];