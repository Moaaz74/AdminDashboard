<?php
namespace PHPMVC;

use PDO;
use PHPMVC\LIB\Dictionary;
use PHPMVC\LIB\front_controller;
use PHPMVC\LIB\Language;
use PHPMVC\LIB\Messanger;
use PHPMVC\LIB\Registry;
use PHPMVC\LIB\SessionManager;
use PHPMVC\LIB\Template\Template;

if(!defined('DS')) define('DS' , DIRECTORY_SEPARATOR);


require_once '..' . DS . 'app' . DS . 'config'  . DS . 'config.php';


require_once APP_PATH . DS . 'lib' . DS . 'autoload.php';

$session = new  SessionManager(); 
$session->start();


$template_parts = require_once '..' . DS . 'app' . DS . 'config'  . DS . 'templateconfig.php';

$messanger = Messanger::getInstance($session);

$template = new Template($template_parts);

$dictionary = new Dictionary();

$registry = Registry::getInstance();

$registry->session = $session;

$registry->messanger = $messanger;

$registry->dictionary = $dictionary;

$front_controller = new front_controller($template , $registry);
$front_controller->dispatch();
