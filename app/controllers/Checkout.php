<?php 

class Checkout extends Controller{
    public $data;
    
    public function __construct(){
        
    }

    public function index(){
        $title = 'Liên Hệ';
        $user = Session::data('user');
        $account = $this->db->table('tb_user')->where('username', '=', $user)->get();
        $cart = $this->models('CartModel')->getCartUser($user);

        if(!$cart){
            Session::data('msg', 'Bạn chưa có sản phẩm nào trong giỏ hàng');
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

        
        $this->render('layouts/client_layout', $this->data);
    }
}
?>