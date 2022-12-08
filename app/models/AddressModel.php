<?php

namespace App\models;
use Core\Model;

class AddressModel extends Model{
    private $__province = 'provinces';
    private $__district = 'districts';
    private $__ward = 'wards';


    function __construct(){
        parent::__construct();
    }

    function tableFill(){
        return 'tb_product';
    }

    function fieldFill(){
        return '*';
    }

    /** @param TRẢ_VỀ_CÁC_DANH_SÁCH_ĐỊA_CHỈ
     * 
     *  * 1. getProvince()                              =>  trả về danh sách tỉnh/thành phố
     *  *    getCity()                                  =>  trả về danh sách quận/huyện 
     *      ? $province: id của tỉnh/thành phố
     *      ? $district: id của quận/huyện
     *  * 2. getCityInProvince($province_code)          =>  trả về danh sách quận/huyện
     *  *    getWardInCity($city_code)                  =>  trả về danh sách phường/xã
     *
     *  * 3. getCityInProvinceByName($province_name)    =>  trả về danh sách quận/huyện
     *  *    getWardInCityByName($city_name)            =>  trả về danh sách phường/xã 
     * 
     *  !FUNCTION
     *  * 1. getProvinceCode($province_name)            =>  trả về mã tỉnh/thành phố
     *  * 2. getCityCode($city_name)                    =>  trả về mã quận/huyện
    */

    //! 1 ---------------------------------------- //
    public function getProvince(){
        $data = $this->db->table($this->__province)->get();
        return $data;
    }
    public function getCity(){
        $data = $this->db->table($this->__district)->get();
        return $data;
    }

    //! 2 ---------------------------------------- //
    public function getCityInProvince($province_code){
        $data = $this->db->table($this->__district)->where('province_code', '=', $province_code)->get();
        return $data;
    }
    public function getWardInCity($city_code){
        $data = $this->db->table($this->__ward)->where('district_code', '=', $city_code)->get();
        return $data;
    }

    //! 3 ---------------------------------------- //
    public function getCityInProvinceByName($province_name){
        $province_code = $this->getCodeProvince($province_name);
        $data = $this->getCityInProvince($province_code);
        return $data;
    }
    public function getWardInCityByName($city_name){
        $city_code = $this->getCodeCity($city_name);
        $data = $this->getWardInCity($city_code);
        return $data;
    }

    //! FUNCTION ---------------------------------------- //
    private function getCodeProvince($province_name){
        $data = $this->db->table($this->__province)->where('name', '=', $province_name)->first();
        return $data['code'];
    }
    private function getCodeCity($city_name){
        $data = $this->db->table($this->__district)->where('full_name', '=', $city_name)->first();
        return $data['code'];
    }
}
?>