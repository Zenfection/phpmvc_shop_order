<?php

class Account extends Controller { 
    public function index(){
        $user = Session::data('user');
        $title = 'Tài Khoản';

        $account = $this->db->table('tb_user')->where('username', '=', $user)->get();
        $getOrder = $this->models('AccountModel')->getOrder($user);
    
        $this->data['page_title'] = $title;
        $this->data['sub_content']['user'] = $user;

        $this->data['content'] = 'account/index';
        $this->data['sub_content']['fullname'] = $account[0]['fullname'];
        $this->data['sub_content']['email'] = $account[0]['email'];
        $this->data['sub_content']['phone'] = $account[0]['phone'];
        $this->data['sub_content']['address'] = $account[0]['address'];
        $this->data['sub_content']['getOrder'] = $getOrder; 
        
        $this->data['sub_content']['msg'] = Session::flash('msg');
        
        $this->render('layouts/client_layout', $this->data);
    }

    public function order($id){
        $user = Session::data('user');
        $title = 'Chi Tiết Đơn Hàng';

        $orderDetail = $this->models('AccountModel')->getDetailOrder($user, $id);

        $this->data['page_title'] = $title;
        $this->data['content'] = 'account/order';

        $this->data['sub_content']['id_order'] = $id;
        $this->data['sub_content']['order_detail'] = $orderDetail;

        $this->render('layouts/client_layout', $this->data);
    }

    public function cancel_order($id){
        $user = Session::data('user');

        $result = $this->models('AccountModel')->cancelOrder($user, $id);
        if($result){
            Session::data('msg', 'Đã hủy đơn hàng thành công');
        } else {
            Session::data('msg', 'Không Hủy đơn hàng được');
        }
        $response = new Response();
        $response->redirect('/account/order/'.$id);
    }

    public function logout(){
        Session::delete('user');
        Session::data('msg', 'Dăng xuất thành công');

        $response = new Response();
        $response->redirect('');
    }

    public function validate_change_info(){
        $request = new Request();
        // set rule
        $request->rules([
            'fullname' => 'min:5|max:50',
            'phone' => 'min:10|max:11',
            'email' => 'email',
            'address' => 'min:5|max:100'
        ]);
        $request->message([
            'fullname.min' => 'Họ tên phải có ít nhất 5 ký tự',
            'fullname.max' => 'Họ tên không được quá 50 ký tự',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 ký tự',
            'phone.max' => 'Số điện thoại không được quá 11 ký tự',
            'email.email' => 'Email không đúng định dạng',
            'address.min' => 'Địa chỉ phải có ít nhất 5 ký tự',
            'address.max' => 'Địa chỉ không được quá 100 ký tự'
        ]);
        // validate
        $validate = $request->validate();
        if(!$validate){
            Session::flash('msg', 'Đã có lỗi xảy ra, vui lòng kiểm tra lại');
            $response = new Response();
            $response->redirect('account');
        } else {
            $this->change_info($_POST['fullname'], $_POST['phone'], $_POST['email'], $_POST['address']);
        }
    }
    public function validate_change_password(){
        $request = new Request();
        // set rule
        $request->rules([
            'old_password' => 'min:6:callback_check_password',
            'new_password' => 'min:6',
            'confirm_password' => 'min:6'
        ]);
        $request->message([
            'old_password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'new_password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'confirm_password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'old_password.callback_check_password' => 'Mật khẩu cũ không đúng'
        ]);
        // validate
        $validate = $request->validate();
        if(!$validate){
            Session::flash('msg', 'Đã có lỗi xảy ra, vui lòng kiểm tra lại');
            $response = new Response();
            $response->redirect('account');
        } else {
            $this->change_password($_POST['old_password'], $_POST['new_password'], $_POST['confirm_password']);
        }
    }

    private function change_info($fullname, $phone, $email, $address){
        $user = Session::data('user');
        $data = [
            'fullname' => $fullname,
            'phone' => $phone,
            'email' => $email,
            'address' => $address
        ];
        $dataChange = [];
        foreach($data as $key => $value){
            $checkChange = $this->db->table('tb_user')->where('username', '=', $user)->where($key, '=', $value)->get();
            if(!$checkChange){
                $dataChange[$key] = $value;
            }
        }
        if(empty($dataChange)){
            Session::flash('msg', 'Không có gì thay đổi');
        } else {
            $update = $this->db->table('tb_user')->where('username', '=', $user)->update($dataChange);
            Session::flash('msg', 'Đã thay đổi thông tin');
        }
        $response = new Response();
        $response->redirect('account');
    }

    private function check_password($password){
        $user = Session::data('user');
        $checkPassword = $this->db->table('tb_user')->where('username', '=', $user)->where('password', '=', md5($password))->get();
        if(!$checkPassword){
            return false;
        } else {
            return true;
        }
    }
    public function change_password($user){
        $user = Session::data('user');
        $data = [
            'password' => md5($_POST['password'])
        ];
        $update = $this->db->table('tb_user')->where('username', '=', $user)->update($data);
        Session::flash('msg', 'Đã thay đổi mật khẩu');
    }
}
?>