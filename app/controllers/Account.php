<?php

namespace App\controllers;

use Core\Controller;
use Core\Session;
use Core\Response;

class Account extends Controller { 
     /**
     * @param TRANG_QUẢN_LÝ_TÀI_KHOẢN
     * 
     * ! PAGE: 
     *   * index()                          => Trang quản lý tài khoản
     *   * order()                          => Trang quản lý đơn hàng
     * 
     * 
     * ! POST: 
     *   * 1.edit($id)                      =>  sửa sản phẩm
     *     ? success:   thành công
     *     ? error:     thất bại
     *     ? no_change: không có gì thay đổi
     * 
     *   * 2.add_new_product()              =>  thêm sản phẩm mới
     *    
    */


    //! PAGE ------------------------------
    public function index(){
        $user = Session::data('user');
        $title = 'Tài Khoản';

        $account = $this->models('AccountModel')->getAccount($user);
        $getOrder = $this->models('AccountModel')->getOrder($user);

        $provinceData = $this->models('AddressModel')->getProvince();
        $cityData = $this->models('AddressModel')->getCityInProvinceByName($account['province']);
        $wardData = $this->models('AddressModel')->getWardInCityByName($account['city']);
    
        $this->data['page_title'] = $title;
        $this->data['sub_content']['user'] = $user;

        $this->data['content'] = 'account/index';
        $this->data['sub_content']['fullname'] = $account['fullname'];
        $this->data['sub_content']['email'] = $account['email'];
        $this->data['sub_content']['phone'] = $account['phone'];
        $this->data['sub_content']['address'] = $account['address'];

        $this->data['sub_content']['province'] = $account['province'];
        $this->data['sub_content']['city'] = $account['city'];
        $this->data['sub_content']['ward'] = $account['ward'];
        $this->data['sub_content']['getOrder'] = $getOrder; 

        $this->data['sub_content']['province_data'] = $provinceData;
        $this->data['sub_content']['city_data'] = $cityData;
        $this->data['sub_content']['ward_data'] = $wardData;
        
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

    public function change_user_info(){
        if(isset($_POST['fullname'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['province'], $_POST['city'], $_POST['ward'])){
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

            $user = Session::data('user');
            $userInfo = $this->models('AccountModel')->getAccount($user);
            $oldData = [
                'fullname' => $userInfo['fullname'],
                'email' => $userInfo['email'],
                'phone' => $userInfo['phone'],
                'address' => $userInfo['address'],
                'province' => $userInfo['province'],
                'city' => $userInfo['city'],
                'ward' => $userInfo['ward']
            ];

            $data = $this->checkDiff($oldData, $newData);
            if(!$data){
                $this->fetchNoChange('Bạn có thay đổi gì thông tin cá nhân đâu');
            } else {
                $this->models('AccountModel')->changeInfo($user, $data);
                $this->fetchSuccess('Đã thay đổi thông tin thành công');
            }
        } else {
            $this->fetchServerError('Không nhận được dữ liệu');
        }
    }

    public function change_user_password(){
        if(isset($_POST['old_password'], $_POST['new_password'], $_POST['confirm_password'])){
            $old_password = md5($_POST['old_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);

            if($new_password != $confirm_password){
                $this->fetchError('Mật khẩu mới không khớp');
            } else {
                $user = Session::data('user');
                $userInfo = $this->models('AccountModel')->getAccount($user);
                if($userInfo['password'] === $old_password){
                    $data = [
                        'password' => $new_password
                    ];
                    $this->models('AccountModel')->changePassword($user, $old_password, $data);
                    $this->fetchSuccess('Đã thay đổi mật khẩu thành công');
                } else {
                    $this->fetchError('Mật khẩu cũ không đúng');
                }
            }
        } else {
            $this->fetchServerError('Không nhận được dữ liệu');
        }
    }
}
