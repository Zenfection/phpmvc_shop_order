<?php

class Product extends Controller {
    /**
     * @param TRANG_QUẢN_LÝ_SẢN_PHẨM
     * 
     * ! PAGE: 
     *   * index()                          => Trang quản lý sản phẩm   
     *   * add()                            => Trang thêm sản phẩm
     *   * detail($id)                      => Trang chi tiết sản phẩm  //? $id của sản phẩm
     * 
     * 
     * ! POST: 
     *   * 1.edit($id)                      =>  sửa sản phẩm
     *     ? success:   thành công
     *     ? error:     thất bại
     *     ? no_change: không có gì thay đổi
     * 
     * ! FUNCTION: 
     *   * checkDiff($oldData, $newData)    => Trả về array các trường đã thay đổi
    */

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
        $this->data['sub_content']['id_product'] = $id; 
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

        $newData = [
            'name' => $name,
            'price' => $price,
            'discount' => $discount,
            'quantity' => $quantity,
            'description' => $description
        ];

        $temp = $this->models('ProductModel')->getDetail($id);
        $oldData = [
            'name' => $temp['name'],
            'price' => $temp['price'],
            'discount' => $temp['discount'],
            'quantity' => $temp['quantity'],
            'description' => $temp['description']
        ];

        $data = $this->checkDiff($oldData, $newData);
        if(!$data){
            echo json_encode(['status' => 'no_change', 'msg' => [
                'type' => 'info',
                'icon' => 'fa-duotone fa-pen-slash',
                'position' => 'center top',
                'content' => 'Không có gì thay đổi' 
            ]]);
        } else {
            $update = $this->models('ProductModel')->updateProduct($id, $data);
            if($update){
                echo json_encode(['status' => 'success', 'msg' => [
                    'type' => 'success',
                    'icon' => 'fa-duotone fa-circle-check',
                    'position' => 'center top',
                    'content' => 'Thay đổi thông tin sản phẩm thành công' 
                ]]);
            } else {
                echo json_encode(['status' => 'error', 'msg' => [
                    'type' => 'error',
                    'icon' => 'fa-duotone fa-circle-xmark',
                    'position' => 'center top',
                    'content' => 'Thay đổi thông tin sản phẩm thất bại' 
                ]]);
            }
        }
    }
}
