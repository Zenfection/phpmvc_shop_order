<?php

namespace App\controllers;

use Core\Controller;
use Core\Session;

use App\helpers\Paginator;

class Content extends Controller{
    public $data;


    //! Chỉ load những trang không có data
    private function loadContent($content){
        $contentView = file_get_contents(_DIR_ROOT . '/app/views/' . $content . '/index.php');
        eval('?>' . $contentView . '<?php');
    }
    
    private function dataShop(){
        $this->data['product'] = $this->models('ProductModel')->getProduct();
        $this->data['category'] = $this->models('ProductModel')->getCategory();

        //* count product category
        $count_category = [];
        $category = $this->data['category'];
        foreach($category as $key => $value){
            $productFilter = $this->models('ProductModel')->getProductCategory($value['id_category']);
            $count = count($productFilter);
            $count_category = array_merge($count_category, [$value['id_category'] => $count]);
        }
        $this->data['count_category'] = $count_category;

        //* recent view product
        $user = Session::data('user');
        if(!empty($user)){
            $this->data['recent_product'] = $this->models('ProductModel')->recentViewProduct($user, 5);
        }
    }

    /* -----------------------------
        //* LoadContent các trang
    -------------------------------*/
    public function about(){
        $this->loadContent('about');
    }

    public function contact(){
        $this->loadContent('contact');
    }

    public function home(){
        $category = $this->models('ProductModel')->getCategory();
        $user = Session::data('user');

        $top_product_ranking = $this->models('ProductModel')->topProductRanking(8);
        $top_product_discount = $this->models('ProductModel')->topProductDiscount(8);
        $top_product_seller = $this->models('ProductModel')->topProductSeller(8);

        $contentView = file_get_contents(_DIR_ROOT . '/app/views/home/index.php');
        eval('?>' . $contentView . '<?php');
    }
    

    public function shop($categoryFilter = 'all'){
        $this->dataShop();

        $category = $this->data['category'];

        if($categoryFilter == 'all'){
            $product = $this->data['product'];
        } else {
            $product = $this->models('ProductModel')->getProductCategory($categoryFilter);
        }

        $current_category = $categoryFilter;
        $current_sortby = 'default';
        $keyword = '';
        $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 9;
        $links = (isset($_GET['links'])) ? $_GET['links'] : 7;
        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;

        $paginator = new Paginator($product);
        $results = $paginator->getData($limit, $page);

        $count_category = $this->data['count_category'];
        $recent_product = $this->data['recent_product'];


        $data = [
            'category' => $category,
            'product' => $product,
            'count_category' => $count_category,
            'current_category' => $current_category,
            'current_sortby' => $current_sortby,
            'keyword' => $keyword,
            'page' => $page,
            'recent_product' => $recent_product
        ];
        
        $dataShare = $this->getDataShare();
        if(!empty($dataShare)){
            $data = array_merge($data, $dataShare);
        }

        $contentView = file_get_contents(_DIR_ROOT . '/app/views/shop/index.php');
        eval('?>' . $contentView . '<?php');
    }

    public function product_detail($id){
        $product_detail = $this->models('ProductModel')->getDetail($id);
        $similar_product = $this->models('ProductModel')->similarProduct($product_detail['id_category']);

        $user = Session::data('user');
        if(!empty($user)){
            $addRecent = $this->models('ProductModel')->addRecent($user, $id);
        }
        
        $contentView = file_get_contents(_DIR_ROOT . '/app/views/products/detail.php');
        eval('?>' . $contentView . '<?php');
    }
    
    public function filter_shop($categoryFilter, $sortby = 'default', $page = 1, $keyword = ''){
        $this->dataShop();

        $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 9;
        $links = (isset($_GET['links'])) ? $_GET['links'] : 7;

        $keyword = urldecode($keyword);
        $category = $this->data['category'];
        $product = $this->data['product'];
        
        $handle = $this->runHandle($categoryFilter, $sortby, $keyword);
        if($handle){
            $product =  $this->data['sub_content']['product'];
        }
        $total = count($product);
        $paginator = new Paginator($this->data['sub_content']['product']);
        $results = $paginator->getData($limit, $page);
        
        $current_category = $categoryFilter;
        $current_sortby = $sortby;

        $count_category = $this->data['count_category'];
        $recent_product = $this->data['recent_product'];

        
        $data = [
            'category' => $category,
            'product' => $product,
            'count_category' => $count_category,
            'current_category' => $current_category,
            'current_sortby' => $current_sortby,
            'keyword' => $keyword,
            'page' => $page,
            'recent_product' => $recent_product
        ];

        $dataShare = $this->getDataShare();
        if(!empty($dataShare)){
            $data = array_merge($data, $dataShare);
        }
        
        $contentView = file_get_contents(_DIR_ROOT . '/app/views/shop/index.php');
        eval('?>' . $contentView . '<?php');
    }

    public function account(){
        $user = Session::data('user');
        $account = $this->models('AccountModel')->getAccount($user);
        $getOrder = $this->models('AccountModel')->getOrder($user);

        $province_data = $this->models('AddressModel')->getProvince();
        $city_data = $this->models('AddressModel')->getCityInProvinceByName($account['province']);
        $ward_data = $this->models('AddressModel')->getWardInCityByName($account['city']);
    
        $fullname = $account['fullname'];
        $email = $account['email'];
        $phone = $account['phone'];
        $address = $account['address'];
        $province = $account['province'];
        $city = $account['city'];
        $ward = $account['ward'];

        $msg = Session::flash('msg');

        $contentView = file_get_contents(_DIR_ROOT . '/app/views/account/index.php');
        eval('?>' . $contentView . '<?php');
    }

    public function login(){
        $this->data['msg'] = Session::flash('msg');

        if($this->data['msg']){
            $msg = $this->data['msg'];
        }

        $contentView = file_get_contents(_DIR_ROOT . '/app/views/login/index.php');
        eval('?>' . $contentView . '<?php');
    }

    public function register(){
        $this->data['msg'] = Session::flash('msg');

        if($this->data['msg']){
            $msg = $this->data['msg'];
        }

        $contentView = file_get_contents(_DIR_ROOT . '/app/views/register/index.php');
        eval('?>' . $contentView . '<?php');
    }

    public function viewcart(){
        $user = Session::data('user');
        $cart = $this->models('CartModel')->getCartUser($user);
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
        
        $dataShare = $this->getDataShare();
        $cart = $dataShare['cart'];
        $total_money = $dataShare['total_money'];
        
        $contentView = file_get_contents(_DIR_ROOT . '/app/views/viewcart/index.php');
        eval('?>' . $contentView . '<?php');
    }

    public function checkout(){
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

        $account = $this->models('AccountModel')->getAccount($user);

        $fullname = $account['fullname'];
        $phone = $account['phone'];
        $email = $account['email'];
        $address = $account['address'];
        $province = $account['province'];
        $city = $account['city'];
        $ward = $account['ward'];
        $province_data = $this->models('AddressModel')->getProvince();
        $city_data = $this->models('AddressModel')->getCityInProvinceByName($account['province']);
        $ward_data = $this->models('AddressModel')->getWardInCityByName($account['city']);

        $dataShare = $this->getDataShare();
        $total_money = $dataShare['total_money'];
        $province_data = $this->models('AddressModel')->getProvince();
        $cart = $dataShare['cart'];

        if(!$cart){
            echo json_encode([
                'msg' => [
                    'type' => 'warning',
                    'icon' => 'fa-duotone fa-basket-shopping-simple',
                    'position' => 'top right',
                    'content' => 'Giỏ hàng của bạn đang trống' 
                ],
            ]);
            exit();
        }
        $contentView = file_get_contents(_DIR_ROOT . '/app/views/checkout/index.php');
        eval('?>' . $contentView . '<?php');
    }

    private function runHandle($category, $sortby, $keyword){
        if($sortby == 'default'){
            if($category == 'all'){
                if($keyword == ''){
                    //? category = all, sortby = default, keyword = ''
                    return false;
                } else {
                    //? category = all, sortby = default, keyword = '...'
                    $dataProduct = $this->models('ProductModel')->searchProduct($keyword);
                    $this->data['page_title'] = 'Tìm kiếm ' . ucfirst($keyword);
                    $this->data['sub_content']['product'] = $dataProduct;
                }
            } else {
                //? category = '...', sortby = default, keyword = ''
                $dataProduct = $this->models('ProductModel')->getProductCategory($category, $keyword);
                $this->data['page_title'] = 'Sản phẩm ' . ucfirst($category);
                $this->data['sub_content']['product'] = $dataProduct;
            }
        } else {
            //? category = '...', sortby = '...', keyword = '...' or ''
            if ($sortby == 'selling'){
                $this->data['page_title'] = 'Sản phẩm bán chạy';
                $dataProduct = $this->models('ProductModel')->sellingFilterProduct($category, $keyword);
                $this->data['sub_content']['product'] = $dataProduct;
    
            } else if($sortby == 'price_asc'){
                $this->data['page_title'] = 'Sản phẩm giá tăng dần';
                $dataProduct = $this->models('ProductModel')->priceFilterProduct($category, 'ASC', $keyword);
                $this->data['sub_content']['product'] = $dataProduct;
    
            } else if($sortby == 'price_desc'){
                $this->data['page_title'] = 'Sản phẩm giá giảm dần';
                $dataProduct = $this->models('ProductModel')->priceFilterProduct($category, 'DESC', $keyword);
                $this->data['sub_content']['product'] = $dataProduct;
    
            } else if($sortby == 'best_discount'){
                $this->data['page_title'] = 'Sản phẩm giảm giá nhiều nhất';
                $dataProduct = $this->models('ProductModel')->discountFilterProduct($category, $keyword);
                $this->data['sub_content']['product'] = $dataProduct;
            }
        }
        return true;
    }
}
