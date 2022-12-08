<?php

namespace Core;

class Controller {
    public $db;

    public function models($model){
        if(file_exists(_DIR_ROOT . '/app/models/' . $model . '.php')){
            $model = 'App\\models\\' . $model;
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
        require _DIR_ROOT . '/app/views/' . $view . '.php';
    }
    public function getDataShare(){
        $data = View::$dataShare;
        return $data;
    }


    public function checkDiff($oldData, $newData){
        $diff = [];
        foreach($oldData as $key => $value){
            if($value != $newData[$key]){
                $diff[$key] = $newData[$key];
            }
        }
        if(count($diff) == 0){
            return false;
        }
        return $diff;
    }

    public function fetchNoChange($content){
        echo json_encode(['status' => 'no_change', 'msg' => [
            'type' => 'info',
            'icon' => 'fa-duotone fa-pen-slash',
            'position' => 'center top',
            'content' => $content
        ]]);
    }
    public function fetchError($content){
        echo json_encode(['status' => 'error', 'msg' => [
            'type' => 'error',
            'icon' => 'fa-duotone fa-circle-xmark',
            'position' => 'center top',
            'content' => $content 
        ]]);
    }
    public function fetchSuccess($content){
        echo json_encode(['status' => 'success', 'msg' => [
            'type' => 'success',
            'icon' => 'fa-duotone fa-circle-check',
            'position' => 'center top',
            'content' => $content 
        ]]);
    }
    public function fetchServerError($content){
        echo json_encode(['status' => 'error', 'msg' => [
            'type' => 'error',
            'icon' => 'fa-duotone fa-server',
            'position' => 'center top',
            'content' => $content
        ]]);
    }
}
?>