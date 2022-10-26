<?php
class CartModel extends Model{
    private $__cart = 'tb_cart';

    function __construct(){
        parent::__construct();
    }

    function tableFill(){
        return 'tb_product';
    }

    function fieldFill(){
        return '*';
    }

    public function getCartUser($user){
        $data = $this->db->table('tb_cart')->where('username','=', $user)->get();
        return $data;
    }

    public function deteleProductCart($user, $id){
        $data = $this->db->table('tb_cart')->where('username', '=', $user)->where('id_product', '=', $id)->delete();
        return $data;
    }
    public function addProductCart($user, $id, $qty){
        $checkExist = $this->db->table('tb_cart')->where('username', '=', $user)->where('id_product', '=', $id)->get();

        if(!empty($checkExist)){
            $qty = $checkExist[0]['amount'] + $qty;
            $data = [
                'amount' => $qty
            ];
            $data = $this->db->table('tb_cart')->where('username', '=', $user)->where('id_product', '=', $id)->update($data);
        } else {
            $data = [
                'username' => $user,
                'id_product' => $id,
                'amount' => $qty
            ];
            $data = $this->db->table('tb_cart')->insert($data);
        }
        return $data;
    }
    public function clearCart($user){
        $data = $this->db->table('tb_cart')->where('username', '=', $user)->delete();
        return $data;
    }
}
?>