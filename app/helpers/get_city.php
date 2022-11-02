<?php

// ajax change province to district
class get_city {
    function __construct(){
        $this->db = new Database();
    }

    function getDistrict(){
        if(isset($_POST['province_id'])){
            $province_id = $_POST['province_id'];
            $district = $this->db->table('districts')->where('province_id', $province_id)->get();
            echo json_encode($district);
        }
    }
}
if(isset($_POST['province'])){
    echo 123;
    $province = $_POST['province'];
    $db = new Database();
    $district = $db->table('districts')->where('province_id','=', $province)->get();
    // $province_id = $_POST['province'];
    // $district = $this->db->table('districts')->where('province_id', $province_id)->get();
    // echo json_encode($district);
}
?>