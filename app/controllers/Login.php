<?php

class Login extends Controller
{
    public function index()
    {
        $title = 'Đăng nhập';
        $this->data['page_title'] = $title;
        $this->data['content'] = 'login/index';
        $this->data['sub_content']['msg'] = Session::flash('msg');

        $this->render('layouts/client_layout', $this->data);
    }


    public function validate()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $check = $this->models('AccountModel')->checkExistUser($username, $password);

            if ($check) {
                Session::data('user', $username);
                $this->fetchSuccess('Đăng nhập thành công');
            } else {
                $this->fetchError('Sài tài khoản hoặc mật khẩu');
            }
        } else {
            $this->fetchServerError('Không nhận được dữ liệu');
        }
    }
}
