<?php

class App{
    private $__controller;
    private $__action;
    private $__params;
    private $__routes;
    private $__db;

    public static $app;

    public function __construct(){
        global $routes;
        global $config;

        self::$app = $this;

        $this->__routes = new Route();

        if(!empty($routes['default_controller'])){
            $this->__controller = $routes['default_controller'];
        }
        $this->__action = 'index';
        $this->__params = array();

        if(class_exists('DB')){
            $dbObject = new DB();
            $this->__db = $dbObject->db;
        }

        $this->handleUrl();
    }

    public function getUrl(){

        if(!empty($_SERVER["REQUEST_URI"])){
            $url = $_SERVER["REQUEST_URI"];
        } else {
            $url = '/';
        }
        return $url;
    }
    public function handleUrl(){
        $url = $this->getUrl();
        $urlArr = array_filter(explode('/', $url));
        $urlArr = array_values($urlArr);
        
        $url = $this->__routes->handleRoute($url);
        
        // Kiểm tra nào là file
        $urlCheck = '';
        if(!empty($urlArr)){
            foreach($urlArr as $key => $item){
                $urlCheck .= $item . '/';
                $fileCheck = rtrim($urlCheck, '/');
                $fileArr = explode('/', $fileCheck);
                $fileArr[count($fileArr) - 1] = ucfirst($fileArr[count($fileArr) - 1]);
                $fileCheck = implode('/', $fileArr);
                
                if(!empty($urlArr[$key - 1])){
                    unset($urlArr[$key - 1]);
                }
                if(file_exists('app/controllers/' . $fileCheck . '.php')){
                    break;
                }
            }
            $urlArr = array_values($urlArr);
        }
        
        // Xử lý controller
        if(!empty($urlArr[0])){
            $this->__controller = ucfirst($urlArr[0]);
        } else {
            $this->__controller = ucfirst($this->__controller);
        }

        if(empty($fileCheck)){
            $fileCheck = $this->__controller;
        }

        if(file_exists('app/controllers/' . $fileCheck . '.php')){
            require_once 'app/controllers/' . $fileCheck . '.php';

            if(class_exists($this->__controller)){
                $this->__controller = new $this->__controller();
                unset($urlArr[0]);
                if(!empty($this->__db)){
                    $this->__controller->db = $this->__db;
                }
            } else {
                die('Class ' . $this->__controller . ' không tồn tại');
            }
        } else {
            $this->loadError();
        }

        // Xử lý action
        if(!empty($urlArr[1])){
            $this->__action = $urlArr[1];
            unset($urlArr[1]);
        }

        //Xử lý params
        $this->__params = array_values($urlArr);

        //Xử lý method
        if(method_exists($this->__controller, $this->__action)){
            call_user_func_array(array($this->__controller, $this->__action), $this->__params);
        } else {
            die('Method ' . $this->__action . ' không tồn tại');
        }
    }

    public function loadError($name = '404', $data = []){
        extract($data);
        require_once 'error/' . $name . '.php';
    }
}