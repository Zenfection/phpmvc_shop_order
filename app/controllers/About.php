<?php

class About extends Controller{
    public function index(){
        $title = 'Giới Thiệu';
        $user = Session::data('user');

        $this->data['page_title'] = $title;
        $this->data['content'] = 'about/index';
        $this->data['sub_content'] = [];

        $this->render('layouts/client_layout', $this->data);
    }

    public function content(){
        $title = 'Giới thiệu';

        $contentView = file_get_contents(_WEB_ROOT . '/app/views/' . 'about' . '.php');
        echo $contentView;
    }
}
?>