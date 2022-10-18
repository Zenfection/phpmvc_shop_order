<?php

class ProductModel extends Model {
    function __construct(){
        parent::__construct();
    }
    function tableFill(){
        return 'tb_product';
    }

    function fieldFill(){
        return '*';
    }
    
    public function getDetail($id){
        $id = (int) $id;
        $data = $this->db->table('tb_product')->where('id_product', '=', $id)->get();
        return $data;
    }
    public function similarProduct($id_category){
        $data = $this->db->table('tb_product')->where('id_category', '=', $id_category)->where('id_product', '!=', $id_category)->get();
        return $data;
    }
}
?>