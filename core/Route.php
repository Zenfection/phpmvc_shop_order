<?php

class Route{
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
                $key = trim($key, '/');
                $key = preg_replace('/\//', '\/', $key);
                $key = preg_replace('/\(:any\)/', '(.*)', $key);
                $key = preg_replace('/\(:num\)/', '([0-9]+)', $key);
                $key = '/^' . $key . '$/';
                if(preg_match($key, $url)){
                    $handleUrl = preg_replace($key, $value, $url);
                    break;
                }
            }
        }
        return $handleUrl;
    }
}
?>