<?php

namespace Core;

use App\App;
use PDO;
use Exception;

class ConnectDB{
    private static $instance = null;
    private static $conn = null;

    private function __construct($config){
        try {
            $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['db'] . ';port=' . $config['port'];
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
            // Kết nối database
            $con = new PDO($dsn, $config['user'], $config['pass'], $options);
            self::$conn = $con;
        } catch (Exception $e) {
            $data = [
                'message' => $e->getMessage()
            ];
            App::$app->loadError('database', $data);
        }
    }

    public static function getInstance($config){
        if(!self::$instance){
            $connection = new ConnectDB($config);
            self::$instance = self::$conn;
        }
        return self::$instance;
    }
}
?>