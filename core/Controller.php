<?php

class Controller {
    public $db;

    public function models($model){
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

    public function render($view, $data = [], $merge = true){
        if(!empty(View::$dataShare) && $merge){
            $data = array_merge($data, View::$dataShare);
        }
        
        extract($data);

        // $contentView = null;
        // if(preg_match('~^layout~', $view) && file_exists(_DIR_ROOT . '/app/views/' . $view . '.php')){
        //     require_once _DIR_ROOT . '/app/views/' . $view . '.php';
        // } else {
        //     $contentView = file_get_contents(_DIR_ROOT . '/app/views/' . $view . '.php');
        //     $template = new Template();
        //     $template->run($contentView, $data);
        // }
        require _DIR_ROOT . '/app/views/' . $view . '.php';
    }
}
?>