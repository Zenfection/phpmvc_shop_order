<?php

define('_DIR_ROOT', $_SERVER["DOCUMENT_ROOT"]);

// Xử lý http root
if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443){
    $web_root = 'https://' . $_SERVER['HTTP_HOST'];
}else{
    $web_root = 'http://' . $_SERVER['HTTP_HOST'];
}

define('_WEB_ROOT', $web_root);

/**Tự động Load Config */
$config_dir = scandir('configs');
if(!empty($config_dir)){
    foreach($config_dir as $file){
        if($file != '.' && $file != '..' && file_exists('configs/' . $file)){
            require_once 'configs/' . $file;
        }
    }
}

require_once 'core/Route.php'; // Xử lý route
require_once 'app/App.php'; // Xử lý app

/** Kiểm tra config và load database*/
if(!empty($config['database'])){
    $dbconfig = array_filter($config['database']);
    if(!empty($dbconfig)){
        require_once 'core/Connection.php'; // Xử lý kết nối database
        require_once 'core/QueryBuilder.php'; // Xử lý query builder
        require_once 'core/Database.php'; // Xử lý database
        require_once 'core/DB.php'; // Xử lý DB
    }
}
require_once 'core/Model.php'; // Base model
require_once 'core/Controller.php'; // Xử lý controller
?>