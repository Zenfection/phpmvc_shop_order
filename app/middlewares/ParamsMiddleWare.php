<?php

class ParamsMiddleWare extends MiddleWare {
    public function handle(){
        if(!empty($_SERVER['QUERY_STRING'])){
            $params = explode('&', $_SERVER['QUERY_STRING']);
            // 0: password=123456
            // => password: 123456
            foreach($params as $param){
                $param = explode('=', $param);
                if(!empty($param[0]) && !empty($param[1])){
                    $_SESSION[$param[0]] = $param[1];
                }
            }
            $reponse = new Response();
            $reponse->redirect(Route::getFullUrl($params));
        }
    }
}
?>