<?php 

class Register extends Controller {
    public function index(){
        $title = 'Đăng ký thành viên';
        $this->data['page_title'] = $title;
        $this->data['content'] = 'register/index';
        $this->data['sub_content']['msg'] = Session::flash('msg');

        $this->render('layouts/client_layout', $this->data);
    }

    public function validate(){
        $request = new Request();
        $response = new Response();
        if($request->isPost()){
            //set rule
            $request->rules([
                'fullname' => 'min:5|max:50',
                'email' => 'min:5|max:50|callback_check_email',
                'username' => 'min:5|max:50|callback_check_username',
                'password' => 'min:3',
            ]);

            // set message
            $request->message([
                'username.min' => 'Tên đăng nhập phải có ít nhất 5 ký tự',
                'username.max' => 'Tên đăng nhập không được quá 50 ký tự',
                'username.unique' => 'Tên đăng nhập đã tồn tại',
                'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự'
            ]);

            // validate
            $validate = $request->validate();
            if(!$validate){
                Session::data('msg', [
                    'type' => 'error',
                    'icon' => 'fa-duotone fa-circle-exclamation',
                    'position' => 'center',
                    'content' => 'Đăng ký thất bại, vui lòng đăng ký lại'
                ]);
                $response->redirect('register');
            } else {
                $this->register_user($_POST['fullname'], $_POST['email'], $_POST['username'], $_POST['password']);
                Session::data('msg', [
                    'type' => 'success',
                    'icon' => 'fa-duotone fa-user-plus',
                    'position' => 'center',
                    'content' => 'Đăng ký thành công'
                ]);
                $response->redirect('login');
            }
        }
    }

    public function check_username(){
        $db = new Database();
        $username = $_POST['username'];
        $check = $db->table('tb_user')->where('username', '=', $username)->count();
        if($check > 0){
            $request = new Request();
            $request->setError('username', 'check_username');
            return false;
        } else {
            return true;
        }
    }
    public function check_email(){
        $db = new Database();
        $email = $_POST['email'];
        $check = $db->table('tb_user')->where('email', '=', $email)->count();
        if($check > 0){
            $request = new Request();
            $request->setError('email', 'check_email');
            return false;
        } else {
            return true;
        }
    }

    private function register_user($fullname, $email, $username, $password){
        $password = md5($password);
        $data = [
            'fullname' => $fullname,
            'email' => $email,
            'username' => $username,
            'password' => $password
        ];
        $result = $this->db->table('tb_user')->insert($data);
        return $result;
    }
}
?>