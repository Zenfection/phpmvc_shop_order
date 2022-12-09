<?php

namespace App\controllers;

use Core\Controller;
use Core\Session;

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

    public function content(){
        $page_title = 'Đăng nhập';
        $msg = Session::flash('msg');

        $contentView = file_get_contents(_DIR_ROOT . '/app/views/login/index.php');
        eval('?>' . $contentView . '<?php');
    }
}
