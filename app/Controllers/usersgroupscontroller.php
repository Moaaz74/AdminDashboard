<?php

namespace PHPMVC\Controllers;

use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\Models\UserGroupModel;
use PHPMVC\Models\UserGroupPrivilageModel;
use PHPMVC\Models\UserPrivilageModel;

class UsersGroupsController extends AbstractController{
    
    use InputFilter;
    use Helper;
    
    public function defaultAction(){
        $this->_data['groups'] = UserGroupModel::getAll();
        $this->_view();
    }

    public function addAction(){
        
        $this->_data['privilages'] = UserPrivilageModel::getAll();
        if(isset($_POST['submit'])){
            $group = new UserGroupModel();
            $group->GroupName = $this->filterString($_POST['GroupName']);

            if($group->save()){
                if(isset($_POST['privilagesArray']) && is_array($_POST['privilagesArray'])){
                    foreach($_POST['privilagesArray'] as $privilageId){
                        $groupPrivilage = new UserGroupPrivilageModel();
                        $groupPrivilage->GroupId = $group->GroupId;
                        $groupPrivilage->PrivilageId = $privilageId;
                        $groupPrivilage->save();
                    }
                }
                $this->redirect('/usersgroups/default');
            }
        }
        
        $this->_view();
    }

    public function editAction(){
        $id = $this->filterInt($this->_params[0]);
        $group = UserGroupModel::getByPK($id);

        if($group === false){
            $this->redirect('/usersgroups/default');
        }

        $this->_data['group'] = $group;
        $this->_data['privilages'] = UserPrivilageModel::getAll();
        $groupPrivilages = UserGroupPrivilageModel::getBy(['GroupId' => $group->GroupId]);
        $selectedGroupPrivilagesIds = [];


        if($groupPrivilages !== false){
            foreach($groupPrivilages as $groupPrivilage){
                $selectedGroupPrivilagesIds[] = $groupPrivilage->PrivilageId;
            }
        }

        $this->_data['groupPrivilages'] = $selectedGroupPrivilagesIds;

        if(isset($_POST['submit'])){
            $groupName = $this->filterString($_POST['GroupName']);
            if($groupName != $group->GroupName) $group->GroupName = $groupName;

            if($group->save()){
                if(isset($_POST['privilagesArray']) && is_array($_POST['privilagesArray'])){
                    $privilagesToBeDeleted = array_diff($selectedGroupPrivilagesIds , $_POST['privilagesArray']);
                    $privilagesToBeAdded = array_diff($_POST['privilagesArray'] , $selectedGroupPrivilagesIds);
                    

                    foreach($privilagesToBeDeleted as $deletedPrivilage){
                        $deleted = UserGroupPrivilageModel::getBy(['PrivilageId' => $deletedPrivilage , 'GroupId' => $group->GroupId]);
                        $deleted->current()->delete();
                    }

                    foreach($privilagesToBeAdded as $privilageId){
                        $groupPrivilage = new UserGroupPrivilageModel();
                        $groupPrivilage->GroupId = $group->GroupId;
                        $groupPrivilage->PrivilageId = $privilageId;
                        $groupPrivilage->save();
                    }
                }
                $this->redirect('/usersgroups/default');
            }
        }
        $this->_view();
    }

    public function deleteAction(){
        $id = $this->filterInt($this->_params[0]);
        $group = UserGroupModel::getByPK($id);

        if($group === false){
            $this->redirect('/usersgroups/default');
        }

        $groupPrivilages = UserGroupPrivilageModel::getBy(['GroupId' => $group->GroupId]);
        
        if(false !== $groupPrivilages){
            foreach($groupPrivilages as $deletedGroupPrivilage){
                $deletedGroupPrivilage->delete();
            }
        }
        

        if($group->delete() ){
            $this->redirect('/usersgroups/default');
        }
    }
}