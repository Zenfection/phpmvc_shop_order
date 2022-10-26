<?php

class AccountModel extends Model{
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

    public function getAccount($username){
        $data = $this->db->table('tb_user')->where('username', '=', $username)->get();
        return $data;
    }

    public function getOrder($username){
        $data = $this->db->table('tb_order')->where('username', '=', $username)->orderBy('order_date', 'DESC')->get();
        return $data;
    }

    public function getDetailOrder($user, $id){
        $sql = "SELECT p.id_product, p.name, p.price, p.image, od.amount, o.total_money, o.order_date, o.status
                FROM `tb_user` as u, `tb_order` as o, `tb_order_details` as od, `tb_product` as p
                WHERE u.username = o.username
                AND o.id_order = od.id_order
                AND od.id_product = p.id_product
                AND u.username = '$user'
                AND o.id_order = '$id'";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function cancelOrder($user, $id){
        $data = $this->db->table('tb_order')->where('id_order', '=', $id)->where('username', '=',$user)->update(['status' => 'canceled']);
        return $data;
    }
}
?>