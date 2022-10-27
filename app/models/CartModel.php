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
    public function totalMoneyCartUser($user){
        $sql = "SELECT * FROM `tb_cart` as c, `tb_product` as p
                WHERE c.id_product = p.id_product
                AND c.username = '$user'";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $total = 0;
        foreach($data as $item){
            $price = (float)$item['price'];
            $discount = (float)$item['discount'];
            $amount = (int)$item['amount'];
            $discount_price = $price - ($price * $discount / 100);
            $total += $discount_price * $amount;
        }
        return $total;
    }
}
?>