<?php 

class Order extends Controller {
    public function detail($id){
        $this->data['page_title'] = 'Chi tiết đơn hàng';
        $this->data['content'] = 'admin/order/detail';

        $this->data['sub_content']['current_sidebar'] = 'order';
        $this->data['sub_content']['msg'] = Session::flash('msg');

        $dataOrder = $this->models('OrderModel')->getOrderDetail($id);
        $dataProduct = $this->models('ProductModel')->getProductOrder($id);
        $dataProvince = $this->models('AddressModel')->getProvince();
        $dataCity = $this->models('AddressModel')->getCityInProvinceByName($dataOrder['province_customer']);

        $this->data['sub_content']['order_detail'] = $dataOrder;
        $this->data['sub_content']['order_product'] = $dataProduct;
        $this->data['sub_content']['province_data'] = $dataProvince;
        $this->data['sub_content']['city_data'] = $dataCity;

        $this->render('layouts/admin_layout', $this->data);
    }
}
?>