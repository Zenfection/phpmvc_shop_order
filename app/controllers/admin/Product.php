<?php

class Product extends Controller {
    public function index(){
        
    }

    public function add(){
        $this->data['page_title'] = 'Thêm sản phẩm';
        $this->data['content'] = 'admin/product/add';
        $this->data['sub_content']['current_sidebar'] = 'product';
        $this->data['sub_content']['msg'] = Session::flash('msg');
        
        $this->render('layouts/admin_layout', $this->data);
    }
}
?>