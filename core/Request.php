<?php

class Request {
    public function getMethod(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    public function isPost(){
        return $this->getMethod() == 'post';
    }
    public function isGet(){
        return $this->getMethod() == 'get';
    }

    public function getField(){
        $data = array();
        if($this->isPost()){
            if(!empty($_POST)){
                foreach($_POST as $key => $value){
                    if(is_array($value)){
                        $data[$key] = $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
        if($this->isGet()){
            if(!empty($_GET)){
                foreach($_GET as $key => $value){
                    if(is_array($value)){
                        $data[$key] = $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
        return $data;
    }
}
?>