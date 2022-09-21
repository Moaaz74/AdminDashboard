<?php

namespace PHPMVC\Models;

class UserPrivilageModel extends AbstractModel{

    public $Privilage;
    public $PrivilageId;
    public $PrivilageTitle;
    
    

    protected static $tableName='app_users_privilages';
    public static $tableSchema=array(
        'PrivilageId'                => self::DATA_TYPE_INT,
        'Privilage'                  => self::DATA_TYPE_STR,
        'PrivilageTitle'             => self::DATA_TYPE_STR
    );

    protected static $primarykey = 'PrivilageId';

    

}