<?php

use PHPMVC\LIB\Dictionary;

if(!defined('DS')) define('DS' , DIRECTORY_SEPARATOR);// directory separator ''

define('APP_PATH' , realpath(dirname(__FILE__)) . DS . '..');
define('CONTROLLER_PATH' , 'C:\xampp\htdocs\EStore Project\app\Controllers');
define('MODELS_PATH' , 'C:\xampp\htdocs\EStore Project\app\Models');
define('VIEWS_PATH' , APP_PATH . DS . 'views' . DS);
define('TEMPLATE_PATH' , APP_PATH . DS . 'templates' . DS);
define('DICTIONARY_PATH' , APP_PATH . DS . 'dictionary' . DS);
define('CSS', '/css/');
define('JS', '/js/');


defined('SESSION_NAME') ? null : define('SESSION_NAME','_ESTORE_SESSION');

defined('SESION_LIFE_TIME') ? null : define('SESION_LIFE_TIME',0);

defined('SESSION_SAVE_PATH') ? null : define('SESSION_SAVE_PATH' ,APP_PATH . DS . '..' . DS . 'Sessions');


defined('DATABASE_HOST_NAME')   ? null : define('DATABASE_HOST_NAME' , 'locahost');

defined('DATABASE_USER_NAME')   ? null : define('DATABASE_USER_NAME' , 'root');

defined('DATABASE_HOST_PASSWORD')   ? null : define('DATABASE_HOST_PASSWORD' , 'moaaz011password');

defined('DATABASE_DB_NAME')   ? null : define('DATABASE_DB_NAME' , 'storedb');



