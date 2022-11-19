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
        $totalProductOrder = $this->models('OrderModel')->totalProductOrder($id);
        
        $this->data['page_title'] = 'Chi tiết sản phẩm';
        $this->data['content'] = 'admin/product/detail';
        
        
        $this->data['sub_content']['current_sidebar'] = 'product';
        $this->data['sub_content']['product_detail'] = $productDetail;
        $this->data['sub_content']['similar_product'] = $similarProduct;
        $this->data['sub_content']['total_product_order'] = (int)$totalProductOrder;
        $this->data['sub_content']['msg'] = Session::flash('msg');
        
        $this->render('layouts/admin_layout', $this->data);
    }

    public function edit($id){
        $id = (int)$id;
        $name = $_POST['name'];
        $price = (int)$_POST['price'];
        $discount = (int)$_POST['discount'];
        $quantity = (int)$_POST['quantity'];
        $description = $_POST["description"];

        $data = [
            'name' => $name,
            'price' => $price,
            'discount' => $discount,
            'quantity' => $quantity,
            'description' => $description
        ];

        $data = $this->models('ProductModel')->updateProduct($id, $data);
        echo json_encode($data);
    }
}
?>