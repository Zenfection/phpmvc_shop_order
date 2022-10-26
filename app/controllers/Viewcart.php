<?php 

class Viewcart extends Controller{
    public $data;
    
    public function __construct(){
        
    }

    public function index(){
        $data['title'] = 'Xem Giỏ Hàng';
        $this->data['page_title'] = $data['title'];

        $this->data['content'] = 'viewcart/index';
        $this->data['sub_content'] = [];

        $user = Session::data('user');
        $cart = $this->models('CartModel')->getCartUser($user);
        if(!$cart){
            Session::data('msg', 'Bạn chưa có sản phẩm nào trong giỏ hàng');
            $response = new Response();
            $response->redirect('');
            return;
        }

        $this->render('layouts/client_layout', $this->data);
    }
}
?>