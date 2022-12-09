<?php

namespace App\controllers;

use Core\Controller;
use Core\Session;

use App\helpers\Paginator;

class Content extends Controller{
    public $data;
    
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
        $paginator = new paginator($product);
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
