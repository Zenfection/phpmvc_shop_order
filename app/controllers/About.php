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
}
?>