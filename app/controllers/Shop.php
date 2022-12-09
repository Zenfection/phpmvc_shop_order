<?php

namespace App\controllers;

use Core\Controller;
use Core\Session;

use App\helpers\Paginator;

class Shop extends Controller
{
    public $data;

    public function __construct(){}

    private function runFrist()
    {
        $product = $this->models('ProductModel')->getProduct();
        $category = $this->models('ProductModel')->getCategory();

        //* count product category
        $countCategory = [];
        foreach ($category as $key => $value) {
            $productFilter = $this->models('ProductModel')->getProductCategory($value['id_category']);
            $count = count($productFilter);
            $countCategory = array_merge($countCategory, [$value['id_category'] => $count]);
        }

        //* recent view product
        $user = Session::data('user');
        if (!empty($user)) {
            $recentProduct = $this->models('ProductModel')->recentViewProduct($user, 5);
            $this->data['sub_content']['recent_product'] = $recentProduct;
        }

        $this->data['sub_content']['show_type_product'] = 'list';
        $this->data['sub_content']['product'] = $product;
        $this->data['sub_content']['category'] = $category;
        $this->data['sub_content']['count_category'] = $countCategory;
        $this->data['sub_content']['msg'] = Session::flash('msg');
    }

    public function index(){
        $this->runFrist();
        $this->data['content'] = 'shop/index';

        $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 9;
        $links = (isset($_GET['links'])) ? $_GET['links'] : 7;
        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $this->data['sub_content']['limit'] = $limit;
        $this->data['sub_content']['page'] = $page;
        $this->data['sub_content']['links'] = $links;


        $paginator = new Paginator($this->data['sub_content']['product']);
        $results = $paginator->getData($limit, $page);
        $this->data['sub_content']['results'] = $results;

        $this->data['sub_content']['current_category'] = 'all';
        $this->data['sub_content']['current_sortby'] = 'default';
        $this->data['sub_content']['keyword'] = '';

        $this->data['page_title'] = 'Cửa Hàng';
        $this->render('layouts/client_layout', $this->data);
    }

    public function category($categoryFilter = 'all', $sortby = 'default', $page = 1, $search = '')
    {
        $this->runFrist();

        $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 9;
        $links = (isset($_GET['links'])) ? $_GET['links'] : 7;
        $this->data['sub_content']['limit'] = $limit;
        $this->data['sub_content']['page'] = $page;
        $this->data['sub_content']['links'] = $links;

        $keyword = urldecode($search);

        $data['title'] = 'Sản phẩm ' . ucfirst($categoryFilter);

        $handle = $this->runHandle($categoryFilter, $sortby, $keyword);
        if (!$handle) {
            $data['title'] = 'Cửa Hàng';
            $this->data['page_title'] = $data['title'];
        }
        $paginator = new Paginator($this->data['sub_content']['product']);
        $results = $paginator->getData($limit, $page);

        $this->data['sub_content']['results'] = $results;

        $this->data['sub_content']['current_category'] = $categoryFilter;
        $this->data['sub_content']['current_sortby'] = $sortby;
        $this->data['sub_content']['keyword'] = $keyword;
        $this->data['sub_content']['page'] = $page;
        $this->data['content'] = 'shop/index';

        $this->render('layouts/client_layout', $this->data);
    }

    private function runHandle($category, $sortby, $keyword)
    {
        if ($sortby == 'default') {
            if ($category == 'all') {
                if ($keyword == '') {
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
            if ($sortby == 'selling') {
                $this->data['page_title'] = 'Sản phẩm bán chạy';
                $dataProduct = $this->models('ProductModel')->sellingFilterProduct($category, $keyword);
                $this->data['sub_content']['product'] = $dataProduct;
            } else if ($sortby == 'price_asc') {
                $this->data['page_title'] = 'Sản phẩm giá tăng dần';
                $dataProduct = $this->models('ProductModel')->priceFilterProduct($category, 'ASC', $keyword);
                $this->data['sub_content']['product'] = $dataProduct;
            } else if ($sortby == 'price_desc') {
                $this->data['page_title'] = 'Sản phẩm giá giảm dần';
                $dataProduct = $this->models('ProductModel')->priceFilterProduct($category, 'DESC', $keyword);
                $this->data['sub_content']['product'] = $dataProduct;
            } else if ($sortby == 'best_discount') {
                $this->data['page_title'] = 'Sản phẩm giảm giá nhiều nhất';
                $dataProduct = $this->models('ProductModel')->discountFilterProduct($category, $keyword);
                $this->data['sub_content']['product'] = $dataProduct;
            }
        }
        return true;
    }

    public function content($current_category = 'all'){
        $this->runFrist();

        $page_title = "Cửa Hàng";
        $show_type_product = $this->data['sub_content']['show_type_product'];

        $category = $this->data['sub_content']['category'];

        if($current_category == 'all'){
            $product = $this->data['sub_content']['product'];
        } else {
            $product = $this->models('ProductModel')->getProductCategory($current_category);
        }

        $current_sortby = 'default';
        $keyword = '';
        $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 9;
        $links = (isset($_GET['links'])) ? $_GET['links'] : 7;
        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;

        $paginator = new Paginator($product);
        $results = $paginator->getData($limit, $page);

        $count_category = $this->data['sub_content']['count_category'];
        $recent_product = $this->data['sub_content']['recent_product'];


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
}
