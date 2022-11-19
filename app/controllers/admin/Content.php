<?php

class Content extends Controller{
    public $data;

    public function dashboard(){
        $count_order = $this->models('DashboardModel')->getSumOrder();
        $total_money_order = $this->models('DashboardModel')->getSumMoneyOrder();
        $count_product = $this->models('DashboardModel')->getSumProduct();
        $count_customer = $this->models('DashboardModel')->getSumCustomer();
        $count_pending = $this->models('DashboardModel')->getSumOrder('pending');
        $count_shipping = $this->models('DashboardModel')->getSumOrder('shipping');
        $count_delivered = $this->models('DashboardModel')->getSumOrder('delivered');
        $count_canceled = $this->models('DashboardModel')->getSumOrder('canceled');

        $top_product_selling = $this->models('ProductModel')->sellingFilterProduct('all', '',10);
        $top_product_ranking = $this->models('ProductModel')->topProductRanking(10);

        $data = [
            'top_product_selling' => $top_product_selling,
            'top_product_ranking' => $top_product_ranking
        ];
        $current_sidebar = 'dashboard';
        
        $contentView = file_get_contents(_DIR_ROOT . '/app/views/admin/dashboard/index.php');
        eval('?>' . $contentView . '<?php');
    }

    public function product($search = ''){
        $keyword = urldecode($search);
        
        if($keyword == ''){
            $product = $this->models('ProductModel')->getProduct();
        } else {
            $product = $this->models('ProductModel')->searchProduct($keyword);
        }

        $current_sidebar = 'product';
        $msg = Session::flash('msg');
        
        $contentView = file_get_contents(_DIR_ROOT . '/app/views/admin/product/index.php');
        eval('?>' . $contentView . '<?php');
    }
    public function add_product(){
        $current_sidebar = 'product';
        $msg = Session::flash('msg');
        
        $contentView = file_get_contents(_DIR_ROOT . '/app/views/admin/product/add.php');
        eval('?>' . $contentView . '<?php');
    }
    
    public function order($search = ''){
        $keyword = urldecode($search);

        if($keyword == ''){
            $order = $this->models('OrderModel')->getOrder();
        } else {
            $order = $this->models('OrderModel')->getOrder($keyword);
        }
        $current_sidebar = 'order';
        $msg = Session::flash('msg');

        $contentView = file_get_contents(_DIR_ROOT . '/app/views/admin/order/index.php');
        eval('?>' . $contentView . '<?php');
    }

    public function order_detail($id){
        $current_sidebar = 'order';
        $msg = Session::flash('msg');

        $order_detail = $this->models('OrderModel')->getOrderDetail($id);
        $order_product = $this->models('ProductModel')->getProductOrder($id);
        $province_data = $this->models('AddressModel')->getProvince();
        $city_data = $this->models('AddressModel')->getCityInProvinceByName($order_detail['province_customer']);

        $contentView = file_get_contents(_DIR_ROOT . '/app/views/admin/order/detail.php');
        eval('?>' . $contentView . '<?php');
    }

    public function product_detail($id){
        $current_sidebar = 'product';
        $msg = Session::flash('msg');

        $product_detail = $this->models('ProductModel')->getDetail($id);
        $similar_product = $this->models('ProductModel')->similarProduct($product_detail['id_category']);
        $total_product_order = (int) $this->models('OrderModel')->totalProductOrder($id);

        $contentView = file_get_contents(_DIR_ROOT . '/app/views/admin/product/detail.php');
        eval('?>' . $contentView . '<?php');
    }
}
?>