<?php 
namespace PHPMVC\LIB;

class Autoload 
{
    public static function autoload($class_name){
        $class_name = str_replace('PHPMVC','',$class_name);
        $class_name = strtolower($class_name);
        $class_name = $class_name . '.php';          
        if(file_exists(APP_PATH . DS . $class_name))
            require_once APP_PATH . DS . $class_name;
    }
}


spl_autoload_register(__NAMESPACE__ . '\Autoload::autoload');
