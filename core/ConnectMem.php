<?php

namespace Core;

use App\App;
use Exception;
use Memcache;

class ConnectMem{
    private static $instance = null;
    private static $conn = null;

    private function __construct($config){
        try {
            $mc = new Memcache;
            $mc->connect($config['host'], $config['port']);
            self::$conn = $mc;
        } catch (Exception $e) {
            $data = [
                'message' => $e->getMessage()
            ];
            App::$app->loadError('memcached', $data);
        }
    }

    public static function getInstance($config){
        if(!self::$instance){
            $connection = new ConnectMem($config);
            self::$instance = self::$conn;
        }
        return self::$instance;
    }
}
?>