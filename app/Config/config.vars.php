<?php

date_default_timezone_set('America/Sao_Paulo');
session_start();

// $envPath = str_replace('app\\Config','', __DIR__);
// $env = parse_ini_file($envPath.'.env-dev');

$env = parse_ini_file('.env');

// URL
define('BASE_URL', 'http://soft.localhost');
define('BASE_URL_QRCODE', 'https://visual.nellure.com');

// CONST CHAVE SECRETA JWT
define('SECRET_KEY', $env['JWT_SECRET_KEY']);

// CONST NOME DA SESSION E DO COOKIE
define('COOKIE_NAME','auth-system');

define('ROLES',[
    'admin' => ['type' => 'admin', 'level' => 99],
    'subadmin' => ['type' => 'subadmin', 'level' => 90],
]);

