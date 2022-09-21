<?php
namespace PHPMVC\Controllers;

use PHPMVC\LIB\front_controller;


class AbstractController{

    protected $_controller='index';
    protected $_action='default';
    protected $_params=array();
    protected $_template;
    protected $_registry;
    protected $_data=[];


    public function __get($key)
    {
        $this->_registry->$key;
    }

    public function notFoundAction(){
        $this->_view();
    }

    public function setController ($controllerName){
        $this->_controller=$controllerName;
    }

    public function setAction ($actionName){
        $this->_action=$actionName;
    }

    
    public function setParams ($params){
        $this->_params=$params;
    }


    public function setTemplate ($template){
        $this->_template=$template;
    }

    public function setRegistry ($registry){
        $this->_registry=$registry;
    }

    protected function _view(){
        $view =  VIEWS_PATH . $this->_controller . DS . $this->_action . '.view.php';
        if($this->_action == front_controller::NOT_FOUND_ACTION || !file_exists($view)){
            $view = VIEWS_PATH . 'notFound' . DS . 'notfound.view.php';
        } 
        $this->_template->setRegistry($this->_registry);
        $this->_template->setActionViewFile($view);
        $this->_template->setAppData($this->_data);
        $this->_template->renderApp();
        
    }

}