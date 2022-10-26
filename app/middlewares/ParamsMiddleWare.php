<?php

class ParamsMiddleWare extends MiddleWare {
    public function handle(){
        if(!empty($_SERVER['QUERY_STRING'])){
            $reponse = new Response();
            $reponse->redirect(Route::getFullUrl());
        }
    }
}
?>