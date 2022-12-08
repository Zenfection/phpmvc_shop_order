<?php 

namespace App\controllers;

use Core\Controller;

class Address extends Controller{
    public function get_city($province){
        $province = urldecode($province);
        $dataCity = $this->models('AddressModel')->getCityInProvinceByName($province);
        // echo "<option value=''>Chọn quận/huyện</option>";
        foreach ($dataCity as $key => $value) {
            echo "<option value='" . $value['name'] . "'>" . $value['full_name'] . "</option>";
        }
        
    }

    public function get_ward($city){
        $city = urldecode($city);
        $dataWard = $this->models('AddressModel')->getWardInCityByName($city);
        
        // echo "<option value=''>Chọn phường/xã</option>";
        foreach($dataWard as $key => $value){
            echo "<option value='" . $value['code'] . "'>" . $value['full_name'] . "</option>";
        }
    }
}
?>