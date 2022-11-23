<?php

class Cookie {
    public function __construct(){

    }

    static public function data($key, $value = ''){
        global $config;
        $cookieKey = self::isValid();
        $expire = time() + $config['cookie']['cookie_expire'];
        if(!empty($value)){
            setcookie($key, $value, $expire, '/'); //* Set cookie
            return true;
        } else {
            if(!empty($_COOKIE[$key])){
                return $_COOKIE[$key]; //* Get cookie
            }
        }
    }

    static public function delete($key = ''){
        $cookieKey = self::isValid();
        if(!empty($key)){
            if(isset($_COOKIE[$cookieKey][$key])){
                unset($_COOKIE[$cookieKey][$key]);
                return true;
            }
            return false;
        } else {
            if(!empty($_COOKIE[$cookieKey])){
                unset($_COOKIE[$cookieKey]);
                return true;
            }
            return false;
        }
    }

    static public function showErrors($message){
        $data = [ 'message' => $message ];
        App::$app->loadError('exception', $data);
        die();
    }

    static public function flash($key, $value = ''){
        $dataFlash = self::data($key, $value);
        if(empty($value)){
            self::delete($key); //* Delete flash cookie after get
        }
        return $dataFlash;
    }

    static public function isValid(){
        global $config;

        if(!empty($config['cookie'])){
            $cookieConfig = $config['cookie'];
            if(!empty($cookieConfig['cookie_key'])){
                $cookieKey = $cookieConfig['cookie_key'];
                return $cookieKey;
            } else {
                self::showErrors('Session key is not defined');
            }
        } else {
            self::showErrors('Session config is not defined');
        }
    }
}
?>