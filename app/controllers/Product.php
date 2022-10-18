<?php

class Product extends Controller{
    public $data = [];
    function __construct(){
        $product = $this->models('ProductModel');
    }
    public function index(){
        
    }   
    
    public function lists(){
        $product = $this->models('ProductModel');
        $dataProduct = $product->getProductList();

        $title = 'Danh sách sản phẩm';

        $this->data['sub_content']['product_list'] = $dataProduct;
        $this->data['sub_content']['page_title'] = $title;
        $this->data['page_title'] = $title;
        $this->data['content'] = 'products/lists';

        $this->render('layouts/client_layout', $this->data);
    }

    public function detail($id = 0){
        $product = $this->models('ProductModel');
        $title = 'Chi tiết sản phẩm';

        $this->data['sub_content']['info'] = $product->getDetail($id);
        $this->data['sub_content']['title'] = $title;
        $this->data['page_title'] = $title;
        $this->data['content'] = 'products/detail';

        $this->render('layouts/client_layout', $this->data);
    }
}
?>