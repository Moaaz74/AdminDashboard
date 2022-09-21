<?php
namespace PHPMVC;

use PDO;
use PHPMVC\LIB\front_controller;
use PHPMVC\LIB\Registry;
use PHPMVC\LIB\SessionManager;
use PHPMVC\LIB\Template\Template;

if(!defined('DS')) define('DS' , DIRECTORY_SEPARATOR);


require_once '..' . DS . 'app' . DS . 'config'  . DS . 'config.php';


require_once APP_PATH . DS . 'lib' . DS . 'autoload.php';

$session = new  SessionManager();

$session->start();


$template_parts = require_once '..' . DS . 'app' . DS . 'config'  . DS . 'templateconfig.php';

$template = new Template($template_parts);

$registry = Registry::getInstance();

$registry->session = $session;


$front_controller = new front_controller($template , $registry);
$front_controller->dispatch();
