<?php

namespace PHPMVC\Controllers;

use PHPMVC\LIB\Dictionary;
use PHPMVC\Models\UserGroupModel;
use PHPMVC\Models\UserModel;

class UsersController extends AbstractController{
    
    private $_createActionRoles=[
        'Username'      => 'req|alphanum|min(3)|max(12)',
        'Password'      => 'req|min(6)',
        'Email'         => 'req|email',
        'PhoneNumber'   => 'alphanum|max(15)',
        'GroupId'       => 'req|int'
    ];

    public function defaultAction(){
        $this->dictionary->load('user.default');
        $this->_data['users'] = UserModel::getAll();
        $this->_view();
    }

    public function addAction(){
        $this->dictionary->load('user.add');
        $this->_data["groups"] = UserGroupModel::getAll();
        if(isset($_POST['submit'])){
            
            
        }
        
        $this->_view();
    }

    public function editAction(){
        $this->dictionary->load('user.edit');
        $this->_view();
    }

    public function deleteAction(){

    }
}