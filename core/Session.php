<?php

namespace Core;

use App\App;

class Session {
    public function __construct(){
        session_start();
    }
    /**
     * @param data($key, $value) -> set session
     *        data($key)         -> get session
    */
    static public function data($key, $value = ''){
        global $config;
        $sessionKey = self::isValid();
        if(!empty($value)){
            $_SESSION[$sessionKey][$key] = $value; //* Set session
            return true;
        } else {
            if(!empty($_SESSION[$sessionKey][$key])){
                return $_SESSION[$sessionKey][$key]; //* Get session
            }
        }
    }

    /**
     * @param delete($key) -> delete session
     *        delete()     -> delete all session
    */
    static public function delete($key = ''){
        $sessionKey = self::isValid();
        if(!empty($key)){
            if(isset($_SESSION[$sessionKey][$key])){
                unset($_SESSION[$sessionKey][$key]);
                return true;
            }
            return false;
        } else {
            if(!empty($_SESSION[$sessionKey])){
                unset($_SESSION[$sessionKey]);
                return true;
            }
            return false;
        }
    }

    /**
     * * use for notifcation message in view
     * @param flash($key, $value) -> set flash session (same as session but only show once)
     *        flash($key)         -> get flash session (sanme as data function but delete after get)s
    */
    static public function flash($key, $value = ''){
        $dataFlash = self::data($key, $value);
        if(empty($value)){
            self::delete($key); //* Delete flash session after get
        }
        return $dataFlash;
    }

    static public function showErrors($message){
        $data = [ 'message' => $message ];
        App::$app->loadError('exception', $data);
        die();
    }
    static public function isValid(){
        global $config;
        if(!empty($config['session'])){
            $sessionConfig = $config['session'];
            if(!empty($sessionConfig['session_key'])){
                $sessionKey = $sessionConfig['session_key'];
                return $sessionKey;
            } else {
                self::showErrors('Session key is not defined');
            }
        } else {
            self::showErrors('Session config is not defined');
        }
    }
}
?>