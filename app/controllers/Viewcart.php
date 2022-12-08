<?php 

namespace App\controllers;

use Core\Controller;
use Core\Session;
use Core\Response;

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

        $this->render('layouts/client_layout', $this->data);
    }
}
?>