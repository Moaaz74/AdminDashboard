<?php

namespace PHPMVC\Controllers;

use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\Models\UserGroupPrivilageModel;
use PHPMVC\Models\UserPrivilageModel;

class UsersPrivilagesController extends AbstractController{

    use InputFilter;
    use Helper;

    public function defaultAction(){
        $this->_data['privilages'] = UserPrivilageModel::getAll();
        $this->_view();
    }

    public function addAction(){
        if(isset($_POST['submit'])){
            $privilage = new UserPrivilageModel();
            $privilage->PrivilageTitle = $this->filterString($_POST['PrivilageTitle']);
            $privilage->Privilage = $this->filterString($_POST['Privilage']);
            if($privilage->save()){
                $this->redirect('/usersprivilages/default');
            }
        
        }
        $this->_view();
    }

    public function editAction(){
        
        $id = $this->filterInt($this->_params[0]);
        $privilage = UserPrivilageModel::getByPK($id);

        if($privilage === false){
            $this->redirect('/usersprivilages/default');
        }

        $this->_data['privilage'] = $privilage;

        if(isset($_POST['submit'])){
            $privilage->PrivilageTitle = $this->filterString($_POST['PrivilageTitle']);
            $privilage->Privilage = $this->filterString($_POST['Privilage']);

            if($privilage->save()){
                $this->redirect('/usersprivilages/default');
            }
        }

        $this->_view();
    }

    public function deleteAction(){
        $id = $this->filterInt($this->_params[0]);
        $privilage = UserPrivilageModel::getByPK($id);
        if($privilage === false){
            $this->redirect('/usersprivilages/default');
        }
        
        $privilages = UserGroupPrivilageModel::getBy(['PrivilageId' => $privilage->PrivilageId]);
        
        if(false !== $privilages){
            foreach($privilages as $deletedPrivilage){
                $deletedPrivilage->delete();
            }
        }

        if($privilage->delete() ){
            $this->redirect('/usersprivilages/default');
        }

    }
}