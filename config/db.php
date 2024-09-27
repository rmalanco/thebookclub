<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '\..\local');
$dotenv->load();

return [
    // 'class' => 'yii\db\Connection',
    // 'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    // 'username' => 'root',
    // 'password' => '12345678',
    // 'charset' => 'utf8',

    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=' . $_ENV['DB_LOCALHOST'] . ';dbname=' . $_ENV['DB_NAME'],
    'username' => $_ENV['DB_USERNAME'],
    'password' => '',
    'charset' => $_ENV['DB_CHARSET'],

    // .env
    // ### DEVELOPMENT ###
    // DB_LOCALHOST=localhost
    // DB_NAME=TheBookClubDB
    // DB_USERNAME=root
    // DB_PASSWORD=
    // DB_CHARSET=utf8


    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];