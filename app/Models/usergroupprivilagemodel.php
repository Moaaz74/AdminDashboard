<?php

namespace PHPMVC\Models;

class UserGroupPrivilageModel extends AbstractModel{

    public $Id;
    public $PrivilageId;
    public $GroupId;
    
    
    

    protected static $tableName='app_users_groups_privilages';
    public static $tableSchema=array(
        'GroupId'           => self::DATA_TYPE_INT,
        'PrivilageId'         => self::DATA_TYPE_INT,
    );

    protected static $primarykey = 'Id';

    

}