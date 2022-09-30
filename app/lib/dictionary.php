<?php 

namespace PHPMVC\LIB;

class Dictionary {

    private $_dictionary = [];

    public function load($path){
        $pathArray = explode('.' , $path);
        $dictionaryFile = DICTIONARY_PATH . $pathArray[0] . DS . $pathArray[1] . '.php';
        if(file_exists($dictionaryFile)){
            require $dictionaryFile;
            if(is_array($_) && !empty($_)){
                foreach($_ as $key => $value){
                    $this->_dictionary[$key] = $value;
                }
                return $this->_dictionary;
            }
        }
        else trigger_error('Sorry the dictionary file ' . $path . ' does not exists', E_USER_WARNING);      
    }


    public function getDictionary(){
        return $this->_dictionary;
    }

}