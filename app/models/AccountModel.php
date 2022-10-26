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
}
?>