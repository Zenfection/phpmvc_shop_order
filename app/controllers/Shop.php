<?php 

class Shop extends Controller {
    public $data;
    
    public function __construct(){
        
    }

    public function page($id = 1){
        $data['title'] = 'Cửa Hàng';
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
        $this->data['sub_content']['page'] = $id;
        $this->data['page_title'] = $data['title'];
        $this->data['content'] = 'shop/index';

        $this->data['sub_content']['msg'] = Session::flash('msg');

        $this->render('layouts/client_layout', $this->data);
    }

    public function category($categoryFilter, $page = 1){
        $data['title'] = 'Sản phẩm ' . ucfirst($categoryFilter);
        $product = $this->models('ProductModel')->getProductCategory($categoryFilter);
        $category = $this->db->table('tb_category')->get();
        
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
        $this->data['sub_content']['page'] = $page;
        $this->data['page_title'] = $data['title'];
        $this->data['content'] = 'shop/index';

        $this->data['sub_content']['msg'] = Session::flash('msg');

        $this->render('layouts/client_layout', $this->data);
    }

    public function search($keyword, $page = 1){
        $keyword = urldecode($keyword);
        $data['title'] = 'Tìm kiếm ' . ucfirst($keyword);
        $product = $this->models('ProductModel')->searchProduct($keyword);
        $category = $this->db->table('tb_category')->get();
        
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
        $this->data['sub_content']['page'] = $page;
        $this->data['sub_content']['keyword'] = $keyword;
        $this->data['page_title'] = $data['title'];
        $this->data['content'] = 'shop/index';

        $this->data['sub_content']['msg'] = Session::flash('msg');

        $this->render('layouts/client_layout', $this->data);
    }
}
?>