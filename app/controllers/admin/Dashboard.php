<?php
namespace App\controllers\admin;

use Core\Controller;    
use Core\Session;

class Dashboard extends Controller {
    /**
     * @param TRANG_DASHBOARD
     * ! PAGE
     * * 1. index()                         => Trang dashboard
     * 
     * * 2. product($search = '')           => Trang quản lý sản phẩm
     * ?        $id của sản phẩm
     * 
     * * 3. order($search = '')             => Trang quản lý đơn hàng
     * ?        $search: từ khoá tìm kiếm
     * 
     * * 4. customer($search = '')          => Trang quản lý khách hàng
     * ?        $search: từ khoá tìm kiếm
    */

    //! 1 ---------------------------------------- //
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


    //! 2 ---------------------------------------- //
    public function product($search = ''){
        $keyword = urldecode($search);

        $this->data['page_title'] = 'Quản lý sản phẩm';
        $this->data['content'] = 'admin/product/index';
        
        if($keyword == ''){
            $dataProduct = $this->models('ProductModel')->getProduct();
        } else {
            $dataProduct = $this->models('ProductModel')->searchProduct($keyword);
            $this->data['sub_content']['keyword'] = $keyword;
        }

        $dataProduct = array_reverse($dataProduct);
        $this->data['sub_content']['current_sidebar'] = 'product';
        $this->data['sub_content']['msg'] = Session::flash('msg');
        $this->data['sub_content']['product'] = $dataProduct;
        
        $this->render('layouts/admin_layout', $this->data);
    }

    //! 3 ---------------------------------------- //
    public function order($search = ''){
        $keyword = urldecode($search);

        $this->data['page_title'] = 'Quản lý đơn hàng';
        $this->data['content'] = 'admin/order/index';

        if($keyword == ''){
            $dataOrder = $this->models('OrderModel')->getOrder();
        } else {
            $dataOrder = $this->models('OrderModel')->getOrder($keyword);
            $this->data['sub_content']['keyword'] = $keyword;
        }

        $this->data['sub_content']['current_sidebar'] = 'order';
        $this->data['sub_content']['msg'] = Session::flash('msg');
        $this->data['sub_content']['order'] = $dataOrder;

        $this->render('layouts/admin_layout', $this->data);
    }

    //! 4 ---------------------------------------- //
    public function customer($search = ''){
        $keyword = urldecode($search);

        $this->data['page_title'] = 'Quản lý khách hàng';
        $this->data['content'] = 'admin/customer/index';

        $userData = $this->models('AccountModel')->getAllUser();
        $countOrderUser = $this->models('AccountModel')->countOrderAllUser();

        $this->data['sub_content']['customer'] = $userData;
        $this->data['sub_content']['count_order_user'] = $countOrderUser;
        
        $this->data['sub_content']['current_sidebar'] = 'customer';
        $this->data['sub_content']['msg'] = Session::flash('msg');
        // $this->data['sub_content']['customer'] = $dataCustomer;

        $this->render('layouts/admin_layout', $this->data);
    }
}
?>