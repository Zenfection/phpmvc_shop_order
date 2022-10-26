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

        $this->render('layouts/client_layout', $this->data);
    }
}
?>