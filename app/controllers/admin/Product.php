<?php
namespace App\controllers\admin;

use Core\Controller;
use Core\Session;

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
     *   * 2.add_new_product()              =>  thêm sản phẩm mới
     *    
    */

    //! PAGE ------------------------------
    
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

    //! POST ------------------------------
    public function edit($id){
        if(isset($_POST['name'], $_POST['price'], $_POST['discount'], $_POST['quantity'], $_POST["description"])){
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
                $this->fetchNoChange('Không có gì thay đổi');
            } else {
                $update = $this->models('ProductModel')->updateProduct($id, $data);
                if($update){
                    $this->fetchSuccess('Sửa thông tin ' . $name . ' thành công');
                } else {
                    $this->fetchError('Sửa thông tin ' . $name . ' thất bại');
                }
            }
        } else {
            $this->fetchServerError('Server không nhận được dữ liệu');
        }
    }

    public function add_new_product(){
        if(isset($_POST['name'], $_POST['description'], $_POST['price'], $_POST['quantity'], $_POST['discount'], $_POST['ranking'], $_POST['category'], $_FILES['image'])){
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = (int)$_POST['price'];
            $quantity = (int)$_POST['quantity'];
            $discount = (int)$_POST['discount'];
            $ranking = (int)$_POST['ranking'];
            $category = $_POST['category'];
            $image = $_FILES['image'];

            $data = [
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'ranking' => $ranking,
                'image' => $image['name'],
                'discount' => $discount,
                'quantity' => $quantity,
                'id_category' => $category,
            ];

            $check = $this->models('ProductModel')->insertProduct($data);
            if($check){
                $this->fetchSuccess('Thêm sản phẩm ' . $name . ' thành công');
            } else {
                $this->fetchError('Thêm sản phẩm thất bại');
            }
        } else {
            $this->fetchServerError('Server không nhận được dữ liệu');
        }
    }
}
