<?php 

class Checkout extends Controller{
    public $data;
    
    public function __construct(){
        
    }

    public function index(){
        $title = 'Đặt Hàng';
        $user = Session::data('user');
        $account = $this->db->table('tb_user')->where('username', '=', $user)->get();
        $cart = $this->models('CartModel')->getCartUser($user);

        $provinceData = $this->models('AddressModel')->getProvince();
        
        if(!$cart){
            Session::data('msg', [
                'type' => 'warning',
                'icon' => 'fa-duotone fa-basket-shopping-simple',
                'position' => 'top',
                'content' => 'Giỏ hàng của bạn đang trống'
            ]);
            $response = new Response();
            $response->redirect('');
            return;
        }
        
        $this->data['page_title'] = $title;
        $this->data['content'] = 'checkout/index';

        
        $this->data['sub_content']['fullname'] = $account[0]['fullname'];
        $this->data['sub_content']['email'] = $account[0]['email'];
        $this->data['sub_content']['phone'] = $account[0]['phone'];
        $this->data['sub_content']['address'] = $account[0]['address'];
        $this->data['sub_content']['province_data'] = $provinceData;

        
        $this->render('layouts/client_layout', $this->data);
    }

    public function validate(){
        $request = new Request();
        //set rule
        $request->rules([
            'fullname' => 'min:5|max:50',
            'email' => 'email',
            'phone' => 'min:10|max:11',
            'address' => 'min:5|max:255',
        ]);
        //set message 
        $request->message([
            'fullname.min' => 'Họ tên phải có ít nhất 5 ký tự',
            'fullname.max' => 'Họ tên không được quá 50 ký tự',
            'email.email' => 'Email không đúng định dạng',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 ký tự',
            'phone.max' => 'Số điện thoại không được quá 11 ký tự',
            'address.min' => 'Địa chỉ phải có ít nhất 5 ký tự',
            'address.max' => 'Địa chỉ không được quá 255 ký tự',
        ]);

        //validate
        $validate = $request->validate();
        $response = new Response();
        if(!$validate){
            Session::data('msg', [
                'type' => 'error',
                'icon' => 'fa-duotone fa-circle-exclamation',
                'position' => 'center',
                'content' => 'Đặt hàng lỗi, vui lòng kiểm tra lại'
            ]);
            $response->redirect('checkout');
        } else {
            $id_order = $this->checkoutOrder($_POST['fullname'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['province'], $_POST['city'], $_POST['ward']);

            Session::data('msg', [
                'type' => 'success',
                'icon' => 'fa-duotone fa-cart-circle-check',
                'position' => 'center',
                'content' => 'Đặt hàng thành công'
            ]);
            $response->redirect('account/order/'.$id_order);
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
                $dataCart = [
                    'id_order' => $id_order,
                    'id_product' => (int)$item['id_product'],
                    'amount' => (int)$item['amount'],
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
    private function randomOrder($length){
        $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        $id_order = strtoupper(substr(str_shuffle($str), 0, $length));
        return $id_order;
    }
}
?>