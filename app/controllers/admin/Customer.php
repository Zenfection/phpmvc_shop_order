<?php
namespace App\controllers\admin;

use Core\Controller;
use Core\Session;

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

        $provinceData = $this->models('AddressModel')->getProvince();
        $cityData = $this->models('AddressModel')->getCityInProvinceByName($userData['province']);
        $wardData = $this->models('AddressModel')->getWardInCityByName($userData['city']);

        $this->data['sub_content']['user_data'] = $userData;
        $this->data['sub_content']['count_ordered'] = $countOrdered;
        $this->data['sub_content']['total_money_order'] = $totalMoneyOrder;
        $this->data['sub_content']['total_recent_product'] = $totalRecentProduct;
        $this->data['sub_content']['order'] = $orderData;
        $this->data['sub_content']['province_data'] = $provinceData;
        $this->data['sub_content']['city_data'] = $cityData;
        $this->data['sub_content']['ward_data'] = $wardData;


        $this->render('layouts/admin_layout', $this->data);
    }

    //! POST
    public function edit(){
        if(isset($_POST['username'], $_POST['fullname'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['province'], $_POST['city'], $_POST['ward'])){
            $username = $_POST['username'];
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $province = $_POST['province'];
            $city = $_POST['city'];
            $ward = $_POST['ward'];

            $newData = [
                'fullname' => $fullname,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'province' => $province,
                'city' => $city,
                'ward' => $ward
            ];

            $temp = $this->models('AccountModel')->getAccount($username);
            $oldData = [
                'fullname' => $temp['fullname'],
                'email' => $temp['email'],
                'phone' => $temp['phone'],
                'address' => $temp['address'],
                'province' => $temp['province'],
                'city' => $temp['city'],
                'ward' => $temp['ward']
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
