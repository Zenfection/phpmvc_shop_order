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

    public function detail($id){
        $productDetail = $this->models('ProductModel')->getDetail($id);
        $similarProduct = $this->models('ProductModel')->similarProduct($productDetail['id_category']);

        
        $this->data['page_title'] = 'Chi tiết sản phẩm';
        $this->data['content'] = 'admin/product/detail';
        
        $this->data['sub_content']['current_sidebar'] = 'product';
        $this->data['sub_content']['product_detail'] = $productDetail;
        $this->data['sub_content']['similar_product'] = $similarProduct;
        $this->data['sub_content']['msg'] = Session::flash('msg');
        
        $this->render('layouts/admin_layout', $this->data);
    }
}
?>