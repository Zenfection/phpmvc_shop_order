<?php 

namespace App\controllers;

use Core\Controller;
use Core\Session;
use Core\Response;

class Viewcart extends Controller{
    public $data;
    
    public function __construct(){}

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
        $total_money = $this->models('CartModel')->totalMoneyCartUser($user);
        if(!$cart){
            echo json_encode([
                'status' => 'error',
                'msg' => [
                    'type' => 'warning',
                    'icon' => 'fa-duotone fa-basket-shopping-simple',
                    'position' => 'top right',
                    'content' => 'Giỏ hàng của bạn đang trống' 
                ],
            ]);
            exit();
        }
        
        $contentView = file_get_contents(_DIR_ROOT . '/app/views/viewcart/index.php');
        eval('?>' . $contentView . '<?php');
    }
}
?>