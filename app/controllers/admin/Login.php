<?php 

class Login extends Controller {
    public function index(){
        $this->data['page_title'] = 'Đăng nhập Admin';
        $this->data['content'] = 'admin/login/index';

        $this->data['sub_content']['msg'] = Session::flash('msg');

        $this->data['sub_content']['load_only'] = true;

        $this->render('layouts/admin_layout', $this->data);
    }
}
?>