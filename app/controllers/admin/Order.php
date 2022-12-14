<?php
namespace App\controllers\admin;

use Core\Controller;
use Core\Session;
class Order extends Controller
{
    /**
     * @param TRANG_QUẢN_LÍ_ĐƠN_HÀNG
     * 
     * ! PAGE: 
     *   * detail($id)                      => Trang chi tiết đơn hàng //? $id của sản phẩm
     * 
     * 
     * ! POST: 
     *   * 1.edit($id)                      =>  sửa sản phẩm
     *     ? success:   thành công
     *     ? error:     thất bại
     *     ? no_change: không có gì thay đổi
     */

    //! PAGE -------------------------------------
    public function detail($id)
    {
        $this->data['page_title'] = 'Chi tiết đơn hàng';
        $this->data['content'] = 'admin/order/detail';

        $this->data['sub_content']['current_sidebar'] = 'order';
        $this->data['sub_content']['msg'] = Session::flash('msg');

        $dataOrder = $this->models('OrderModel')->getOrderDetail($id);
        $dataProduct = $this->models('ProductModel')->getProductOrder($id);
        $dataProvince = $this->models('AddressModel')->getProvince();
        $dataCity = $this->models('AddressModel')->getCityInProvinceByName($dataOrder['province_customer']);
        $dataWard = $this->models('AddressModel')->getWardInCityByName($dataOrder['city_customer']);

        $this->data['sub_content']['order_detail'] = $dataOrder;
        $this->data['sub_content']['order_product'] = $dataProduct;
        $this->data['sub_content']['province_data'] = $dataProvince;
        $this->data['sub_content']['city_data'] = $dataCity;
        $this->data['sub_content']['ward_data'] = $dataWard;

        $this->render('layouts/admin_layout', $this->data);
    }

    //! POST -------------------------------------
    public function edit($id)
    {
        if (isset($_POST['name_customer'], $_POST['phone_customer'], $_POST['email_customer'], $_POST['province_customer'], $_POST['city_customer'], $_POST['ward_customer'], $_POST['address_customer'], $_POST['status'])) {
            $name_customer = $_POST['name_customer'];
            $phone_customer = $_POST['phone_customer'];
            $email_customer = $_POST['email_customer'];
            $province_customer = $_POST['province_customer'];
            $city_customer = $_POST['city_customer'];
            $ward_customer = $_POST['ward_customer'];
            $address_customer = $_POST['address_customer'];
            $status = $_POST['status'];

            $newData = [
                'name_customer' => $name_customer,
                'phone_customer' => $phone_customer,
                'email_customer' => $email_customer,
                'province_customer' => $province_customer,
                'city_customer' => $city_customer,
                'ward_customer' => $ward_customer,
                'address_customer' => $address_customer,
                'status' => $status
            ];

            $temp = $this->models('OrderModel')->getOrderDetail($id);
            $oldData = [
                'name_customer' => $temp['name_customer'],
                'phone_customer' => $temp['phone_customer'],
                'email_customer' => $temp['email_customer'],
                'province_customer' => $temp['province_customer'],
                'city_customer' => $temp['city_customer'],
                'ward_customer' => $temp['ward_customer'],
                'address_customer' => $temp['address_customer'],
                'status' => $temp['status']
            ];

            $data = $this->checkDiff($oldData, $newData);
            if (!$data) {
                $this->fetchNoChange('Không có gì thay đổi');
            } else {
                $update = $this->models('OrderModel')->updateOrder($id, $data);
                if ($update) {
                    $this->fetchSuccess('Thay đổi thông tin thành công');
                } else {
                    $this->fetchError('Thay đổi thông tin đơn thất bại');
                }
            }
        } else {
            $this->fetchServerError('Server không nhận được dữ liệu');
        }
    }
}
