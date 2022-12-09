<?php 

namespace App\controllers;

use Core\Controller;
use Core\Session;

class Register extends Controller {
    public function index(){
        $title = 'Đăng ký thành viên';
        $this->data['page_title'] = $title;
        $this->data['content'] = 'register/index';
        $this->data['sub_content']['msg'] = Session::flash('msg');

        $this->render('layouts/client_layout', $this->data);
    }

    public function validate(){
        if(isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])){
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $data = [
                'fullname' => $fullname,
                'email' => $email,
                'username' => $username,
                'password' => $password
            ];

            $check = $this->models('AccountModel')->addUser($data);
            if($check){
                $this->fetchSuccess('Đăng ký thành công');
            }else{
                $this->fetchError('Đăng ký thất bại');
            }
        } else {
            $this->fetchServerError('Không nhận được dữ liệu');
        }
    }

    public function content(){
        $page_title = 'Đăng ký thành viên';
        $msg = Session::flash('msg');

        $contentView = file_get_contents(_DIR_ROOT . '/app/views/register/index.php');
        eval('?>' . $contentView . '<?php');
    }
}
?>