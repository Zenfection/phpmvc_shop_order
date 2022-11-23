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

            $db = new Database();
            $check = $db->table('tb_user')->where('username', '=', $username)->where('password', '=', $password)->count();

            if ($check > 0) {
                Session::data('user', $username);
                $this->fetchSuccess('Đăng nhập thành công');
            } else {
                $this->fetchError('Sài tài khoản hoặc mật khẩu');
            }
        } else {
            $this->fetchServerError('Không nhận được dữ liệu');
        }
    }

    // public function validate(){
    //     $request = new Request();
    //     $response = new Response();
    //     if($request->isPost()){
    //         //set rule
    //         $request->rules([
    //             'username' => 'min:5|max:50',
    //             'password' => 'min:3'
    //         ]);

    //         // set message
    //         $request->message([
    //             'username.min' => 'Tên đăng nhập phải có ít nhất 5 ký tự',
    //             'username.max' => 'Tên đăng nhập không được quá 50 ký tự',
    //             'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự'
    //         ]);

    //         // validate
    //         $validate = $request->validate();
    //         $check = $this->login_user($_POST['username']);

    //         if(!$validate || !$check){
    //             Session::data('msg', [
    //                 'type' => 'error',
    //                 'icon' => 'fa-duotone fa-user-xmark',
    //                 'position' => 'center',
    //                 'content' => 'Đăng nhập thất bại'
    //             ]);
    //             $response->redirect('login');
    //         } else {
    //             Session::data('msg', [
    //                 'type' => 'success',
    //                 'icon' => 'fa-duotone fa-user-check',
    //                 'position' => 'bottom',
    //                 'content' => 'Đăng nhập thành công'
    //                 ]);
    //             Session::data('user', $_POST['username']);
    //             $response->redirect('home');
    //         }
    //     }
    // }
    // static public function login_user($username){
    //     $db = new Database();
    //     $password = md5($_POST['password']);
    //     $check = $db->table('tb_user')->where('username', '=', $username)->where('password', '=', $password)->count();
    //     if($check > 0){
    //         return true;
    //     } else {
    //         $request = new Request();
    //         $request->setError('username', 'login_user');
    //         return false;
    //     }
    // }
}
