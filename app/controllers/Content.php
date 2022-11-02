<?php

class Content extends Controller{
    public $data;

    public function about(){
        $this->loadContent('about');
    }

    public function home(){
        $category = $this->db->table('tb_category')->get();
        $user = Session::data('user');

        $top_product_ranking = $this->models('ProductModel')->topProductRanking(8);
        $top_product_discount = $this->models('ProductModel')->topProductDiscount(8);
        $top_product_seller = $this->models('ProductModel')->topProductSeller(8);

        $contentView = file_get_contents(_DIR_ROOT . '/app/views/' . 'home' . '/index.php');
        
        // add array into eval code
        eval('?>' . $contentView . '<?php');
    }
    public function contact(){
        $this->loadContent('contact');
    }
    
    private function dataShop(){
        $this->data['product'] = $this->db->table('tb_product')->get();
        $this->data['category'] = $this->db->table('tb_category')->get();

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
        $page = 1;

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

        $contentView = file_get_contents(_DIR_ROOT . '/app/views/products/detail.php');
        eval('?>' . $contentView . '<?php');
    }
    
    public function filter_shop($categoryFilter, $sortby = 'default', $page = 1, $keyword = ''){
        $this->dataShop();

        $keyword = urldecode($keyword);
        $category = $this->data['category'];
        $product = $this->data['product'];
        
        $handle = $this->runHandle($categoryFilter, $sortby, $keyword);
        if($handle){
            $product =  $this->data['sub_content']['product'];
        }
        $total = count($product);
        
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

    private function loadContent($content){
        $contentView = file_get_contents(_DIR_ROOT . '/app/views/' . $content . '/index.php');
        
        //add variable to view
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
?>