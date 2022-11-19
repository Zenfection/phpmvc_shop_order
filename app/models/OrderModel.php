<?php

class OrderModel extends Model{
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

    public function getOrder($keyword = ''){
        if($keyword == ''){
            $sql = "SELECT * FROM `tb_order`";
        }else {
            $sql = "SELECT * FROM `tb_order` 
            WHERE LOWER(id_order) 
            COLLATE UTF8_GENERAL_CI 
            LIKE CONCAT('%', LOWER(CONVERT('$keyword', BINARY)), '%')";
        }

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getOrderDetail($id){
        $data = $this->db->table('tb_order')->where('id_order', '=', $id)->first();
        return $data;
    }

    public function getOrderStatus($user, $status){
        $data = $this->db->table('tb_order')->where('username', '=', $user)->where('status', '=', $status)->get();
        return $data;
    }

    public function totalProductOrder($id_product){
        $sql = "SELECT SUM(amount) as total  
                FROM `tb_order_details` 
                WHERE id_product = $id_product";
        $data = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $data['total'];
    }
}
?>