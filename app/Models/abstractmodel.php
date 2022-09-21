<?php 
namespace PHPMVC\Models;

use PDO;
use PDOStatement;
use PHPMVC\LIB\Database\DatabaseHandler;


class AbstractModel {

    const DATA_TYPE_INT = \PDO::PARAM_INT;
    const DATA_TYPE_BOOL = \PDO::PARAM_BOOL;
    const DATA_TYPE_STR = \PDO::PARAM_STR;
    const DATA_TYPE_DECIMAL = 4;
    const DATA_TYPE_DATE = 5;

    private static $db;

    private static function buildNameParametersSQL(){
        $namedParams='';
        foreach (static::$tableSchema as $columnName => $type){
            $namedParams .= $columnName . ' = :' . $columnName . ', ';
        }
        return trim($namedParams , ', ');
    }


    public static function getByPK($pk){
        $sql = 'SELECT * FROM ' . static::$tableName . ' WHERE ' . static::$primarykey .  ' = "' . $pk . '"';
        $stmt = DatabaseHandler::factory()->prepare($sql);
        if($stmt->execute() === true)  {
            if(method_exists(get_called_class() , '__construct')){
                $obj = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE , get_called_class() , array_keys(static::$tableSchema));
            }else{
                $obj = $stmt->fetchAll(PDO::FETCH_CLASS , get_called_class());
            }
            return array_shift($obj);
        }
        return false;    
    }



    protected function perpareValues(PDOStatement &$stmt){
        foreach (static::$tableSchema as $columnName => $type){
            if($type == 4){
                $sanitizedValue = filter_var($this->$columnName , FILTER_SANITIZE_NUMBER_FLOAT , FILTER_FLAG_ALLOW_FRACTION);
                $stmt->bindValue(":{$columnName}" , $sanitizedValue);
            }else{
                $stmt->bindValue(":{$columnName}" , $this->$columnName,$type);
            }
        }
    }


    public static function getAll(){
        $sql = 'SELECT * FROM ' . static::$tableName;
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $stmt->execute() ;
        if(method_exists(get_called_class(),'__construct')){
            $result = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE , get_called_class() , array_keys(static::$tableSchema));
        }else{
            $result = $stmt->fetchAll(PDO::FETCH_CLASS , get_called_class());
        }
        if((is_array($result)) && !empty($result)){
            $generator = function () use ($result){
                foreach($result as $res){
                    yield $res;
                }
            };
            return $generator();
        };
        return false;
    }


    private function create(){
        $sql = 'INSERT INTO ' . static::$tableName . ' SET ' . self::buildNameParametersSQL() ;
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $this->perpareValues($stmt);
        if($stmt->execute()){
            $this->{static::$primarykey} = DatabaseHandler::factory()->lastInsertId();
            return true;
        }
        return false;
    }



    public function save(){
        return $this->{static::$primarykey} === null ? $this->create() : $this->update(); 
    }


    private function update(){
        $sql = 'UPDATE ' . static::$tableName . ' SET ' . self::buildNameParametersSQL() . ' WHERE ' . static::$primarykey .  ' = ' . $this->{static::$primarykey};
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $this->perpareValues($stmt);
        return $stmt->execute();
    }


    public function delete(){
        $sql = 'DELETE  FROM ' . static::$tableName . ' WHERE ' . static::$primarykey .  ' = ' . $this->{static::$primarykey};
        $stmt = DatabaseHandler::factory()->prepare($sql);
        return $stmt->execute();
    }


    public static function getBy ($columns , $options = array()){
        $whereClauesColumns = array_keys($columns);
        $whereClauesValues = array_values($columns);
        $whereClause = [];
        for($i = 0 , $ii = count($whereClauesColumns); $i<$ii ; $i++){
            $whereClause[] = $whereClauesColumns[$i] . ' = "' . $whereClauesValues[$i] . '"';
        }
        $whereClause = implode(' AND ' , $whereClause);
        $sql = 'SELECT * FROM ' . static::$tableName . ' WHERE ' . $whereClause;
        return static::get($sql , $options);
    }


    public static function get($sql , $options = array()){

        $stmt = DatabaseHandler::factory()->prepare($sql);
        if(!empty($options)){
            foreach ($options as $columnName => $type){
                if($type[0] == 4){
                    $sanitizedValue = filter_var($type[1] , FILTER_SANITIZE_NUMBER_FLOAT , FILTER_FLAG_ALLOW_FRACTION);
                    $stmt->bindValue(":($columnName)" , $sanitizedValue);
                }else{
                    $stmt->bindValue(":($columnName)" , $type[1],$type[0]);
                }
            }
        }
        $stmt->execute() ;
        if(method_exists(get_called_class(),'__construct')){
            $result = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE , get_called_class() , array_keys(static::$tableSchema));
        }else{
            $result = $stmt->fetchAll(PDO::FETCH_CLASS , get_called_class());
        }
        if((is_array($result)) && !empty($result)){
            return new \ArrayIterator($result);
        };
        return false;
    }


}