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

    public function detail($id){
        $productDetail = $this->models('ProductModel')->getDetail($id);
        $similarProduct = $this->models('ProductModel')->similarProduct($productDetail[0]['id_category']);

        $title = 'Chi tiết ' . $productDetail[0]['name'];

        $user = Session::data('user');
        if(!empty($user)){
            $addRecent = $this->models('ProductModel')->addRecent($user, $id);
        }

        $this->data['page_title'] = $title;
        $this->data['sub_content']['title'] = $title;
        $this->data['sub_content']['product_detail'] = $productDetail[0];
        $this->data['sub_content']['similar_product'] = $similarProduct;
        $this->data['content'] = 'products/detail';

        $this->data['sub_content']['msg'] = Session::data('msg');

        $this->render('layouts/client_layout', $this->data);
    }
}
?>