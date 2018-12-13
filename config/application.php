<?php

session_start();
date_default_timezone_set('UTC');
ini_set('default_charset', 'UTF-8');
ini_set('php.internal_encoding', 'UTF-8');

$https = filter_input(INPUT_SERVER, 'HTTPS');
$scheme = isset($https) && $https == 'on' ? 'https' : 'http';
$hostname = filter_input(INPUT_SERVER, 'HTTP_HOST');

// Url
define('APP_ROOT', $scheme . '://' . $hostname . '/');

// Caminhos
define('MAIN_PATH', dirname(__FILE__) . '/../');
define('APP_PATH', MAIN_PATH . 'application/');
define('SYS_PATH', MAIN_PATH . 'system/');
define('CONFIG_PATH', MAIN_PATH . 'config/');

//define('CACHE_PATH', MAIN_PATH . 'data/cache/');
//define('LANGUAGE_PATH', MAIN_PATH . 'data/language/');
//define('UPLOAD_PATH', MAIN_PATH . 'data/uploaded/');
//define('IMAGE_CACHE_PATH', MAIN_PATH . 'data/uploaded/cache/');
//define('UPLOAD_FOLDER', 'uploaded/');

// Modo de operação
if (! defined('ENVIRONMENT')) {
    define('ENVIRONMENT', 'development');
}

switch (ENVIRONMENT) {
    case 'development':
        define('ERROR_REPORTING', '-1');
        error_reporting(ERROR_REPORTING);
        ini_set('display_errors', 1);
        break;
    case 'production':
        define(
            'ERROR_REPORTING',
            'E_ALL '
            . '& ~E_NOTICE '
            . '& ~E_DEPRECATED '
            . '& ~E_STRICT '
            . '& ~E_USER_NOTICE '
            . '& ~E_USER_DEPRECATED'
        );
        error_reporting(ERROR_REPORTING);
        ini_set('display_errors', 0);
        break;
    default:
        header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
        echo 'The application environment is not set correctly.';
        exit(1);
}

// Configurações para leitura e gravação de arquivos e diretórios
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb');
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b');
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

// Perfis de usuário
define('ADMINISTRADOR', 1);
define('ATENDENTE', 2);
define('CLIENTE', 3);