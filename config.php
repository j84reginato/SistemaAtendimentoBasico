<?php

session_start();
date_default_timezone_set('UTC');
ini_set('default_charset', 'UTF-8');
ini_set('php.internal_encoding', 'UTF-8');

// Geral
define('APP_ROOT', 'http://' . filter_input(INPUT_SERVER, 'HTTP_HOST') . '/framework/');
define('TRACK_USER_IP', true);
define('USER_IP', filter_input(INPUT_SERVER, 'REMOTE_ADDR'));
define('MD5_PREFIX', 'e2bfcf822acf92af27aab0d849c99bc4');

// Caminhos
define('MAIN_PATH', dirname(__FILE__) . '/');
define('CACHE_PATH', MAIN_PATH . 'cache/');
define('INCLUDE_PATH', MAIN_PATH . 'includes/');
define('CLASS_PATH', MAIN_PATH . 'includes/classes/');
define('FUNCTION_PATH', MAIN_PATH . 'includes/functions/');
define('PACKAGE_PATH', MAIN_PATH . 'includes/packages/');
define('UPLOAD_PATH', MAIN_PATH . 'uploaded/');
define('IMAGE_CACHE_PATH', MAIN_PATH . 'uploaded/cache/');
define('UPLOAD_FOLDER', 'uploaded/');

// Modo de operação
define('ENVIRONMENT', 'development');

switch (ENVIRONMENT) {
    case 'development':
        error_reporting(-1);
        ini_set('display_errors', 1);
        break;
    case 'production':
        ini_set('display_errors', 0);
        if (version_compare(PHP_VERSION, '5.3', '>=')) {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        }
        break;
    default:
        header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
        echo 'The application environment is not set correctly.';
        exit(1);
}

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',				'rb');
define('FOPEN_READ_WRITE',			'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',	'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',			'ab');
define('FOPEN_READ_WRITE_CREATE',		'a+b');
define('FOPEN_WRITE_CREATE_STRICT',		'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',	'x+b');


/*
|--------------------------------------------------------------------------
| Application Data
|--------------------------------------------------------------------------
|
| These constants are used globally from the application when handling data.
|
*/
define('DB_SLUG_CUSTOMER', 'customer');
define('DB_SLUG_PROVIDER', 'provider');
define('DB_SLUG_ADMIN', 'admin');
define('DB_SLUG_SECRETARY', 'secretary');

define('FILTER_TYPE_PROVIDER', 'provider');
define('FILTER_TYPE_SERVICE', 'service');

define('AJAX_SUCCESS', 'SUCCESS');
define('AJAX_FAILURE', 'FAILURE');

define('SETTINGS_SYSTEM', 'SETTINGS_SYSTEM');
define('SETTINGS_USER', 'SETTINGS_USER');

define('PRIV_VIEW', 1);
define('PRIV_ADD', 2);
define('PRIV_EDIT', 4);
define('PRIV_DELETE', 8);

define('PRIV_APPOINTMENTS', 'appointments');
define('PRIV_CUSTOMERS', 'customers');
define('PRIV_SERVICES', 'services');
define('PRIV_USERS', 'users');
define('PRIV_SYSTEM_SETTINGS', 'system_settings');
define('PRIV_USER_SETTINGS', 'user_settings');

define('DATE_FORMAT_DMY', 'DMY');
define('DATE_FORMAT_MDY', 'MDY');
define('DATE_FORMAT_YMD', 'YMD');

define('MIN_PASSWORD_LENGTH', 7);
define('ANY_PROVIDER', 'any-provider');

define('CALENDAR_VIEW_DEFAULT', 'default'); 
define('CALENDAR_VIEW_TABLE', 'table'); 

define('AVAILABILITIES_TYPE_FLEXIBLE', 'flexible');
define('AVAILABILITIES_TYPE_FIXED', 'fixed');

