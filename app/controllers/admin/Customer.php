<?php

class Customer extends Controller {
    public function info($user){
        $this->data['page_title'] = 'Thông tin khách hàng';
        $this->data['content'] = 'admin/customer/info';

        $this->data['sub_content']['msg'] = Session::flash('msg');

        $userData = $this->models('AccountModel')->getAccount($user);
        $countOrdered = $this->models('AccountModel')->countOrderUser($user);
        $totalMoneyOrder = $this->models('AccountModel')->sumMoneyOrder($user);
        $totalRecentProduct = $this->models('ProductModel')->countRecentViewProduct($user);
        $orderData = $this->models('OrderModel')->getOrderUser($user);

        $this->data['sub_content']['user_data'] = $userData;
        $this->data['sub_content']['count_ordered'] = $countOrdered;
        $this->data['sub_content']['total_money_order'] = $totalMoneyOrder;
        $this->data['sub_content']['total_recent_product'] = $totalRecentProduct;
        $this->data['sub_content']['order'] = $orderData;


        $this->render('layouts/admin_layout', $this->data);
    }

    //! POST
    public function edit(){
        if(isset($_POST['username'], $_POST['fullname'], $_POST['email'], $_POST['phone'], $_POST['address'])){
            $username = $_POST['username'];
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            $newData = [
                'fullname' => $fullname,
                'email' => $email,
                'phone' => $phone,
                'address' => $address
            ];

            $temp = $this->models('AccountModel')->getAccount($username);
            $oldData = [
                'fullname' => $temp['fullname'],
                'email' => $temp['email'],
                'phone' => $temp['phone'],
                'address' => $temp['address']
            ];

            $data = $this->checkDiff($oldData, $newData);
            if(empty($data)){
                $this->fetchNoChange('Không có gì thay đổi');
            } else {
                $result = $this->models('AccountModel')->changeInfo($username, $data);
                if($result){
                    $this->fetchSuccess('Cập nhật thông tin thành công');
                } else {
                    $this->fetchError('Cập nhật thông tin thất bại');
                }
            }
        } else {
            $this->fetchServerError('Server không nhân được dữ liệu');
        }
    }
}
