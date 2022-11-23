<?php

class AuthMiddleWare extends MiddleWare {
    public function handle(){
        if(Session::data('user') == null){
            Session::data('msg', [
                'type' => 'warning',
                'icon' => 'fa-duotone fa-right-to-bracket',
                'position' => 'center top',
                'content' => 'Bạn cần phải đăng nhập'
            ]);
            $response = new Response();
            $response->redirect('');
        } 
    }
}
?>