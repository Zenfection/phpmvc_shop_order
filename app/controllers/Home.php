<?php

namespace App\controllers;

use Core\Controller;
use Core\Session;

class Home extends Controller {
    public $data;

    public function __construct(){}

    public function index(){
        $product = $this->models('ProductModel')->getProduct();
        $topProductRanking = $this->models('ProductModel')->topProductRanking(8);
        $topProductDiscount = $this->models('ProductModel')->topProductDiscount(8);
        $topProductSeller = $this->models('ProductModel')->topProductSeller(8);

        $category = $this->db->table('tb_category')->where('active', '=', 1)->get();
        $title = 'Trang Chủ';
        
        $this->data['sub_content']['product'] = $product;
        $this->data['sub_content']['top_product_ranking'] = $topProductRanking;
        $this->data['sub_content']['top_product_discount'] = $topProductDiscount;
        $this->data['sub_content']['top_product_seller'] = $topProductSeller;
        $this->data['sub_content']['category'] = $category;
        $this->data['page_title'] = $title;
        $this->data['content'] = 'home/index';

        $this->data['sub_content']['msg'] = Session::flash('msg');

        $this->render('layouts/client_layout', $this->data);
    }

    public function content(){
        $category = $this->models('ProductModel')->getCategory();
        $user = Session::data('user');

        $top_product_ranking = $this->models('ProductModel')->topProductRanking(8);
        $top_product_discount = $this->models('ProductModel')->topProductDiscount(8);
        $top_product_seller = $this->models('ProductModel')->topProductSeller(8);

        $contentView = file_get_contents(_DIR_ROOT . '/app/views/home/index.php');
        eval('?>' . $contentView . '<?php');
    }
}
