<?php 

namespace PHPMVC\LIB\Database;

abstract class DatabaseHandler{

    abstract protected static function init();

    abstract protected static function getInstance();


    public static function factory(){
        return PDODatabaseHandler::getInstance();
    }

}