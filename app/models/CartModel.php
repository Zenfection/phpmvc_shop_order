<?php
class CartModel extends Model
{
    private $__cart = 'tb_cart';

    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return 'tb_product';
    }

    function fieldFill()
    {
        return '*';
    }

    public function getCartUser($user)
    {
        $data = $this->db->table('tb_cart')->where('username', '=', $user)->get();
        return $data;
    }

    public function deteleProductCart($user, $id)
    {
        $data = $this->db->table('tb_cart')->where('username', '=', $user)->where('id_product', '=', $id)->delete();
        return $data;
    }
    public function addProductCart($user, $id, $qty)
    {
        $checkExist = $this->db->table('tb_cart')->where('username', '=', $user)->where('id_product', '=', $id)->first();
        $productInfo = $this->db->table('tb_product')->where('id_product', '=', $id)->first();

        if (!empty($checkExist)) {
            $qty = $checkExist['amount'] + $qty;
            $data = [
                'amount' => $qty,
            ];
            $update = $this->db->table('tb_cart')->where('username', '=', $user)->where('id_product', '=', $id)->update($data);

            $discount_price = $productInfo['price'] - ($productInfo['price'] * $productInfo['discount'] / 100);
            return [
                'status' => 'update',
                'total_qty' => $qty,
                'discount_price' => $discount_price
            ];
        } else {
            $data = [
                'username' => $user,
                'id_product' => $id,
                'amount' => $qty
            ];
            $data = $this->db->table('tb_cart')->insert($data);

            $price = $productInfo['price'];
            $discount = $productInfo['discount'];
            $discount_price = $price - ($price * $discount / 100);

            return [
                'status' => 'insert',
                'name' => $productInfo['name'],
                'amount' => $qty,
                'image' => $productInfo['image'],
                'price' => $price,
                'discount' => $discount,
                'discount_price' => $discount_price,
            ];
        }
    }
    public function clearCart($user)
    {
        $data = $this->db->table('tb_cart')->where('username', '=', $user)->delete();
        return $data;
    }
    public function countCart($user)
    {
        $data = $this->db->table('tb_cart')->where('username', '=', $user)->count();
        return $data;
    }
    public function totalMoneyCartUser($user)
    {
        $sql = "SELECT * FROM `tb_cart` as c, `tb_product` as p
                WHERE c.id_product = p.id_product
                AND c.username = '$user'";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $total = 0;
        foreach ($data as $item) {
            $price = (float)$item['price'];
            $discount = (float)$item['discount'];
            $amount = (int)$item['amount'];
            $discount_price = $price - ($price * $discount / 100);
            $total += $discount_price * $amount;
        }
        return $total;
    }
    public function getProductDetailCart($id){
        $sql = "SELECT * FROM `tb_cart` as c, `tb_product` as p
                WHERE c.id_product = p.id_product
                AND c.id_product = '$id'";
        $data = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}
