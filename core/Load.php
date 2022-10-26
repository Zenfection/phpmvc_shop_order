<?php

class Load {
    static public function model($model){
        if(file_exists(_DIR_ROOT . '/app/models/' . $model . '.php')){
            require_once _DIR_ROOT . '/app/models/' . $model . '.php';
            if(class_exists($model)){
                return new $model();
            } else {
                die('Class ' . $model . ' không tồn tại');
            }
            return false;
        }
    }

    static public function view($view, $data = []){
        extract($data);
        if(file_exists(_DIR_ROOT . '/app/views/' . $view . '.php')){
            require_once _DIR_ROOT . '/app/views/' . $view . '.php';
        }
    }
}
?>