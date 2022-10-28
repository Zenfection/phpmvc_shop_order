<?php

require_once 'vendor/autoload.php';

define('_DIR_ROOT', $_SERVER["DOCUMENT_ROOT"]);

// Xử lý http root
if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443){
    $web_root = 'https://' . $_SERVER['HTTP_HOST'];
}else{
    $web_root = 'http://' . $_SERVER['HTTP_HOST'];
}

// $dirRoot = str_replace('\\', '/', _DIR_ROOT);
// $documentRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);

define('_WEB_ROOT', $web_root);

//* Tự động Load Config
$config_dir = scandir('configs');
if(!empty($config_dir)){
    foreach($config_dir as $file){
        if($file != '.' && $file != '..' && file_exists('configs/' . $file)){
            require_once 'configs/' . $file;
        }
    }
}

//* Load all services
if(!empty($config['app']['service'])){
    foreach($config['app']['service'] as $service){
        if(file_exists('app/core/' . $service . '.php')){
            require_once 'app/core/' . $service . '.php';
        }
    }
}

require_once 'core/ServiceProvider.php'; // Load ServiceProvider
require_once 'core/View.php'; // Load View Class
require_once 'core/Load.php'; // 
require_once 'core/MiddleWare.php'; // Load MiddleWare
require_once 'core/Route.php'; // Xử lý route
require_once 'core/Session.php'; // Xử lý session

//* Kiểm tra config và load database
if(!empty($config['database'])){
    $dbconfig = array_filter($config['database']);
    if(!empty($dbconfig)){
        require_once 'core/Connection.php'; // Xử lý kết nối database
        require_once 'core/QueryBuilder.php'; // Xử lý query builder
        require_once 'core/Database.php'; // Xử lý database
        require_once 'core/DB.php'; // Xử lý DB
    }
}

//* Load all helpers
require_once 'core/Helper.php'; // Xử lý helper

require_once 'app/App.php'; // Xử lý app

$helper_dir = scandir('app/helpers');
if(!empty($helper_dir)){
    foreach($helper_dir as $file){
        if($file != '.' && $file != '..' && file_exists('app/helpers/' . $file)){
            require_once 'app/helpers/' . $file;
        }
    }
}


require_once 'core/Model.php'; // Base model
require_once 'core/Template.php'; // Xử lý template
require_once 'core/Controller.php'; // Xử lý controller
require_once 'core/Request.php'; // Xử lý request
require_once 'core/Response.php'; // Xử lý response
?>