<?php

class Response {
    public function redirect($uri=''){
        if(preg_match('~^(http|https)~is', $uri)){
            header('Location: ' . $uri);
        } else {
            header('Location: ' . _WEB_ROOT . '/' . $uri);
        }
        exit();
    }
    public function json($data){
        header('Content-Type: application/json');
        // format utf8
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit();
    }
    public function view($view, $data = array()){
        $view = str_replace('.', '/', $view);
        $view = _DIR_ROOT . '/app/views/' . $view . '.php';
        if(file_exists($view)){
            extract($data);
            require_once $view;
        } else {
            echo 'View not found';
        }
        exit();
    }
}
?>