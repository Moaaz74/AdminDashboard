<?php

namespace PHPMVC\Models;

class UserGroupModel extends AbstractModel{

    public $GroupName;
    public $GroupId;
    
    
    

    protected static $tableName='app_users_groups';
    public static $tableSchema=array(
        'GroupId'           => self::DATA_TYPE_INT,
        'GroupName'         => self::DATA_TYPE_STR,
    );

    protected static $primarykey = 'GroupId';

    

}