<?php

class Home extends Controller {
    public function __construct(){
        
    }

    public function index(){
        $product = $this->db->table('tb_product')->get();
        $topProductRanking = $this->models('HomeModel')->topProductRanking(8);
        $topProductDiscount = $this->models('HomeModel')->topProductDiscount(8);
        $topProductSeller = $this->models('HomeModel')->topProductSeller(8);

        $category = $this->db->table('tb_category')->get();
        $title = 'Trang Chủ';
        
        $this->data['sub_content']['product'] = $product;
        $this->data['sub_content']['top_product_ranking'] = $topProductRanking;
        $this->data['sub_content']['top_product_discount'] = $topProductDiscount;
        $this->data['sub_content']['top_product_seller'] = $topProductSeller;
        $this->data['sub_content']['category'] = $category;
        $this->data['page_title'] = $title;
        $this->data['content'] = 'home/index';
    
        $this->render('layouts/client_layout', $this->data);
    }
}
?>