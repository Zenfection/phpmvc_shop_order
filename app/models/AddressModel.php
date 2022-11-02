<?php

class AddressModel extends Model{
    private $__table = 'tb_product';

    function __construct(){
        parent::__construct();
    }

    function tableFill(){
        return 'tb_product';
    }

    function fieldFill(){
        return '*';
    }

    public function getProvince(){
        $data = $this->db->table('provinces')->get();
        return $data;
    }
    public function getCity(){
        $data = $this->db->table('districts')->get();
        return $data;
    }
    public function getCityInProvince($province_code){
        $data = $this->db->table('districts')->where('province_code', '=', $province_code)->get();
        return $data;
    }
    public function getWardInCity($city_code){
        $data = $this->db->table('wards')->where('district_code', '=', $city_code)->get();
        return $data;
    }
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
    private function getCodeProvince($province_name){
        $data = $this->db->table('provinces')->where('name', '=', $province_name)->get();
        return $data[0]['code'];
    }
    private function getCodeCity($city_name){
        $data = $this->db->table('districts')->where('name', '=', $city_name)->get();
        return $data[0]['code'];
    }
}
?>