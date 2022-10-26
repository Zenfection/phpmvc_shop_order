<?php

class Contact extends Controller {
    public function index(){
        $title = 'Liên Hệ';
        $user = Session::data('user');
        $this->data['page_title'] = $title;
        $this->data['content'] = 'contact/index';
        $this->data['sub_content'] = [];
        
        $this->render('layouts/client_layout', $this->data);
    }
}
?>