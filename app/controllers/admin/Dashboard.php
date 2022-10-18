<?php

class Dashboard {
    public function index() {
        echo 'Trang chủ admin';
    }

    public function detail($id = 0){
        echo "Thông tin chi tiết : " . $id;
    }
}
?>