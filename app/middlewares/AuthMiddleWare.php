<?php

class AuthMiddleWare extends MiddleWare {
    public function handle(){
        if(Session::data('user') == null){
            $response = new Response();
            $response->redirect('home');
        } 
    }
}
?>