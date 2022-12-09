<?php 

namespace App\controllers;

use Core\Controller;
use Core\Session;
use Core\Response;

class Checkout extends Controller{
    public $data;
    
    public function __construct(){}

    public function index(){
        $title = 'Đặt Hàng';
        $user = Session::data('user');
        $account = $this->models('AccountModel')->getAccount($user);
        $cart = $this->models('CartModel')->getCartUser($user);

        $provinceData = $this->models('AddressModel')->getProvince();
        $cityData = $this->models('AddressModel')->getCityInProvinceByName($account['province']);
        $wardData = $this->models('AddressModel')->getWardInCityByName($account['city']);
        
        if(!$cart){
            Session::data('msg', [
                'type' => 'warning',
                'icon' => 'fa-duotone fa-basket-shopping-simple',
                'position' => 'top right',
                'content' => 'Giỏ hàng của bạn đang trống'
            ]);
            $response = new Response();
            $response->redirect('');
            return;
        }
        
        $this->data['page_title'] = $title;
        $this->data['content'] = 'checkout/index';

        
        $this->data['sub_content']['fullname'] = $account['fullname'];
        $this->data['sub_content']['email'] = $account['email'];
        $this->data['sub_content']['phone'] = $account['phone'];
        $this->data['sub_content']['address'] = $account['address'];
        $this->data['sub_content']['province'] = $account['province'];
        $this->data['sub_content']['city'] = $account['city'];
        $this->data['sub_content']['ward'] = $account['ward'];

        $this->data['sub_content']['province_data'] = $provinceData;
        $this->data['sub_content']['city_data'] = $cityData;
        $this->data['sub_content']['ward_data'] = $wardData;

        
        $this->render('layouts/client_layout', $this->data);
    }

    public function validate(){
        if(isset($_POST['fullname']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['email']) && isset($_POST['province']) && isset($_POST['city']) && isset($_POST['city']) && isset($_POST['ward'])){
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $province = $_POST['province'];
            $city = $_POST['city'];
            $ward = $_POST['ward'];

            $id_order = $this->checkoutOrder($fullname, $email, $phone, $address, $province, $city, $ward);
            if($id_order){
                echo json_encode(['status' => 'success', 'msg' => [
                    'type' => 'success',
                    'icon' => 'fa-duotone fa-circle-check',
                    'position' => 'center top',
                    'content' => 'Đặt Hàng Thành Công' 
                ], 'id_order' => $id_order]);
            } else{
                $this->fetchError('Mua Hàng Thất Bại');
            }

        } else {
            $this->fetchServerError('Không nhận được dữ liệu');
        }
    }

    private function checkoutOrder($fullname, $email, $phone, $address, $province, $city, $ward){
        $order_date = date('Y-m-d');
        $status = 'pending';
        $user = Session::data('user');
        $totalMoney = $this->models('CartModel')->totalMoneyCartUser($user);
        $id_order = $this->randomOrder(10);

        $data = [
            'id_order' => $id_order,
            'username' => $user,
            'name_customer' => $fullname,
            'phone_customer' => $phone,
            'address_customer' => $address,
            'email_customer' => $email,
            'city_customer' => $city,
            'ward_customer' => $ward,
            'province_customer' => $province,
            'status' => $status,
            'order_date' => $order_date,
            'total_money' => $totalMoney
        ];
        $result = $this->db->table('tb_order')->insert($data);
        if(!$result){
            return false;
        } else {
            //* thêm vào bảng tb_order_detail
            $cartProduct = $this->models('CartModel')->getCartUser($user);
            foreach($cartProduct as $item){
                $product = $this->models('ProductModel')->getDetail($item['id_product']);
                $price = (int)$product['price'];
                $discount_price = $price - $price * (int)$item['discount'] / 100;
                
                $dataCart = [
                    'id_order' => $id_order,
                    'id_product' => (int)$item['id_product'],
                    'amount' => (int)$item['amount'],
                    'price' => $discount_price,
                ];
                $this->db->table('tb_order_details')->insert($dataCart);
                if(!$result){
                    return false;
                }
            }
            //* xoá giỏ hàng
            $this->models('CartModel')->clearCart($user);
            return $id_order;
        }
    }

    private function checkOrderExist($id_order){
        $result = $this->db->table('tb_order')->where('id_order', '=', $id_order)->get();
        return $result;
    }
    private function randomOrder($length){
        $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        $id_order = strtoupper(substr(str_shuffle($str), 0, $length));
        if($this->checkOrderExist($id_order)){
            $this->randomOrder($length);
        } else {
            return $id_order;
        }
    }


    public function content(){
        $user = Session::data('user');
        if(!$user){
            echo json_encode([
                'msg' => [
                    'type' => 'info',
                    'icon' => 'fa-duotone fa-user-xmark',
                    'position' => 'top right',
                    'content' => 'Đăng nhập để sử dụng chức năng này' 
                ],
            ]);
            exit();
        }

        $cart = $this->models('CartModel')->getCartUser($user);
        if(!$cart){
            echo json_encode([
                'msg' => [
                    'type' => 'warning',
                    'icon' => 'fa-duotone fa-basket-shopping-simple',
                    'position' => 'top right',
                    'content' => 'Giỏ hàng của bạn đang trống' 
                ],
            ]);
            exit();
        }
        $total_money = $this->models('CartModel')->totalMoneyCartUser($user);

        $account = $this->models('AccountModel')->getAccount($user);

        $fullname = $account['fullname'];
        $phone = $account['phone'];
        $email = $account['email'];
        $address = $account['address'];
        $province = $account['province'];
        $city = $account['city'];
        $ward = $account['ward'];
        $province_data = $this->models('AddressModel')->getProvince();
        $city_data = $this->models('AddressModel')->getCityInProvinceByName($account['province']);
        $ward_data = $this->models('AddressModel')->getWardInCityByName($account['city']);
        
        $contentView = file_get_contents(_DIR_ROOT . '/app/views/checkout/index.php');
        eval('?>' . $contentView . '<?php');
    }
}
