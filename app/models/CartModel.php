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

    public function totalMoney($user){
        /*$price = (float)$row['price'];
                        $discount = (float)$row['discount'];
                        $amount = (int)$row['amount'];
                        $discount_price = $price - ($price * $discount / 100);
                        $total += $discount_price * $amount;*/
        $data = $this->db->table('tb_cart')->table('tb_product')->get();
        $total = 0;
        foreach($data as $item){
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
?>