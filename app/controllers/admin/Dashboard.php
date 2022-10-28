<?php

class Dashboard extends Controller {
    public function index() {
        // Tổng đơn hàng, tổng số tiền hàng, tổng số sản phẩm, tổng số khách hàng
        $countOrder = $this->models('DashboardModel')->getSumOrder();
        $countMoneyOrder = $this->models('DashboardModel')->getSumMoneyOrder();
        $countProduct = $this->models('DashboardModel')->getSumProduct();
        $countCustomer = $this->models('DashboardModel')->getSumCustomer();
        $countPending = $this->models('DashboardModel')->getSumOrder('pending');
        $countShipping = $this->models('DashboardModel')->getSumOrder('shipping');
        $countDelivered = $this->models('DashboardModel')->getSumOrder('delivered');
        $countCanceled = $this->models('DashboardModel')->getSumOrder('canceled');

        $topProductSelling = $this->models('ProductModel')->sellingFilterProduct('all', '',10);
        $topProductRanking = $this->models('ProductModel')->topProductRanking(10);

        $this->data['page_title'] = 'Dashboard';
        $this->data['content'] = 'admin/dashboard/index';
        $this->data['sub_content']['current_sidebar'] = 'dashboard';
        $this->data['sub_content']['count_order'] = $countOrder;
        $this->data['sub_content']['total_money_order'] = $countMoneyOrder;
        $this->data['sub_content']['count_product'] = $countProduct;
        $this->data['sub_content']['count_customer'] = $countCustomer;
        $this->data['sub_content']['count_pending'] = $countPending;
        $this->data['sub_content']['count_shipping'] = $countShipping;
        $this->data['sub_content']['count_delivered'] = $countDelivered;
        $this->data['sub_content']['count_canceled'] = $countCanceled;

        $this->data['sub_content']['top_product_selling'] = $topProductSelling;
        $this->data['sub_content']['top_product_ranking'] = $topProductRanking;

        $this->render('layouts/admin_layout', $this->data);
    }

    public function product($search = ''){
        $keyword = urldecode($search);

        $this->data['page_title'] = 'Quản lý sản phẩm';
        $this->data['content'] = 'admin/product/index';
        
        if($keyword == ''){
            $dataProduct = $this->models('ProductModel')->getProduct();
        } else {
            $dataProduct = $this->models('ProductModel')->searchProduct($keyword);
        }
        if($keyword != ''){
            $this->data['sub_content']['keyword'] = $keyword;
        }
        $this->data['sub_content']['current_sidebar'] = 'product';
        $this->data['sub_content']['msg'] = Session::flash('msg');
        $this->data['sub_content']['product'] = $dataProduct;
        
        $this->render('layouts/admin_layout', $this->data);
    }
}
?>