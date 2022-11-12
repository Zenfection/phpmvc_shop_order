<?php

class Account extends Controller { 
    public function index(){
        $user = Session::data('user');
        $title = 'Tài Khoản';

        $account = $this->db->table('tb_user')->where('username', '=', $user)->first();
        $getOrder = $this->models('AccountModel')->getOrder($user);
    
        $this->data['page_title'] = $title;
        $this->data['sub_content']['user'] = $user;

        $this->data['content'] = 'account/index';
        $this->data['sub_content']['fullname'] = $account['fullname'];
        $this->data['sub_content']['email'] = $account['email'];
        $this->data['sub_content']['phone'] = $account['phone'];
        $this->data['sub_content']['address'] = $account['address'];
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
            Session::data('msg', [
                'type' => 'success',
                'icon' => 'fa-duotone fa-check-double',
                'position' => 'center',
                'content' => 'Đã hủy đơn hàng thành công'
            ]);
        } else {
            Session::data('msg', [
                'type' => 'error',
                'icon' => 'fa-duotone fa-shield-xmark',
                'position' => 'center',
                'content' => 'Không hủy đơn hàng được'
            ]);
        }
        $response = new Response();
        $response->redirect('/account/order/'.$id);
    }

    public function logout(){
        Session::delete('user');
        Session::data('msg', [
            'type' => 'success',
            'icon' => 'fa-duotone fa-user-slash',
            'position' => 'bottom',
            'content' => 'Đã đăng xuất thành công'
        ]);

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
        $check = $this->change_info($_POST['fullname'], $_POST['phone'], $_POST['email'], $_POST['address']);
        if(!$validate || $check == 'false'){
            Session::data('msg', [
                'type' => 'error',
                'icon' => 'fa-duotone fa-shield-xmark',
                'position' => 'center',
                'content' => 'Cập nhật thông tin không thành công'
            ]);
            $response = new Response();
            $response->redirect('account');
        } else {
            if($check == 'nochange'){
                Session::data('msg', [
                    'type' => 'info',
                    'icon' => 'fa-duotone fa-circle-info',
                    'position' => 'center',
                    'content' => 'Không có gì thay đổi'
                ]);
            } else if($check){
                Session::data('msg', [
                    'type' => 'success',
                    'icon' => 'fa-duotone fa-check-double',
                    'position' => 'center',
                    'content' => 'Đã thay đổi thông tin thành công'
                ]);
            }
            $response = new Response();
            $response->redirect('account');
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
        $check = $this->change_password($_POST['old_password'], $_POST['new_password'], $_POST['confirm_password']);
        if(!$validate || !$check){
            Session::data('msg', [
                'type' => 'error',
                'icon' => 'fa-duotone fa-shield-xmark',
                'position' => 'center',
                'content' => 'Đổi mật khẩu không thành công'
            ]);
            $response = new Response();
            $response->redirect('account');
        } else {
            Session::data('msg', [
                'type' => 'success',
                'icon' => 'fa-duotone fa-key-skeleton',
                'position' => 'center',
                'content' => 'Đã thay đổi mật khẩu thành công'
            ]);
            $response = new Response();
            $response->redirect('account');
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
        if(!empty($dataChange)){
            $update = $this->db->table('tb_user')->where('username', '=', $user)->update($dataChange);
            return ($update) ? 'true' : 'false';
        } else {
            return 'nochange';
        }
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
    private function change_password($user){
        $user = Session::data('user');
        $data = [
            'password' => md5($_POST['password'])
        ];
        $update = $this->db->table('tb_user')->where('username', '=', $user)->update($data);
        return ($update) ? true : false;
    }
}
?>