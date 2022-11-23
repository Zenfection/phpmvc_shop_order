<?php

class Route{
    private $__keyRoute = '';

    function handleRoute($url){
        global $routes;
        unset($routes['default_controller']);

        $url = trim($url, '/');
        if(empty($url)){
            $url = '/';
        }
        
        $handleUrl = $url;

        if(!empty($routes)){
            foreach($routes as $key => $value){
                if(preg_match('~'.$key.'~is', $url)){
                    $handleUrl = preg_replace('~'.$key.'~is', $value, $url);
                    $this->__keyRoute = $key;
                    break;
                }
            }
            $this->__keyRoute = $handleUrl;
        } 
        return $handleUrl;
    }

    public function getUri(){
        return $this->__keyRoute;
    }

    static public function getFullUrl($params){
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        App::$app->setCurrentParams($params);
        $url = _WEB_ROOT . $uri;
        return $url;
    }
}
?>