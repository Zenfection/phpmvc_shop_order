<?php 

class Shop extends Controller {
    public $data;
    
    public function __construct(){
        
    }

    private function runFrist(){
        $product = $this->db->table('tb_product')->get();
        $category = $this->db->table('tb_category')->get();

        //* count product category
        $countCategory = [];
        foreach($category as $key => $value){
            $productFilter = $this->models('ProductModel')->getProductCategory($value['id_category']);
            $count = count($productFilter);
            $countCategory = array_merge($countCategory, [$value['id_category'] => $count]);
        }

        //* recent view product
        $user = Session::data('user');
        if(!empty($user)){
            $recentProduct = $this->models('ProductModel')->recentViewProduct($user, 5);
            $this->data['sub_content']['recent_product'] = $recentProduct;
        }

        $this->data['sub_content']['product'] = $product;
        $this->data['sub_content']['category'] = $category;
        $this->data['sub_content']['count_category'] = $countCategory;

        $this->data['sub_content']['msg'] = Session::flash('msg');
    }

    public function category($categoryFilter = 'all', $sortby = 'default', $page = 1, $search = ''){
        $this->runFrist();
        $keyword = urldecode($search);

        $data['title'] = 'Sản phẩm ' . ucfirst($categoryFilter);
        
        $handle = $this->runHandle($categoryFilter, $sortby, $keyword);
        if(!$handle){
            $data['title'] = 'Cửa Hàng';
            $this->data['page_title'] = $data['title'];
        }

        $this->data['sub_content']['current_category'] = $categoryFilter;
        $this->data['sub_content']['current_sortby'] = $sortby;
        $this->data['sub_content']['keyword'] = $keyword;
        $this->data['sub_content']['page'] = $page;
        $this->data['content'] = 'shop/index';

        $this->render('layouts/client_layout', $this->data);
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
?>