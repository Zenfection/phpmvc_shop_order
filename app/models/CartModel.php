<?php
class CartModel extends Model
{
    private $__cart = 'tb_cart';
    private $__product = 'tb_product';

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
    
    /** @param XỬ_LÝ_VỀ_TRANG_CART
     *
     * //* 1. getCartUser($user)                    => lấy thông tin giỏ hàng của user
     *   * 2. countCart($user)                      => đếm số lượng sản phẩm trong giỏ hàng
     *   ?      - $user: tên user
     * //* 3. deleteProductCart($user, $id)         => xóa sản phẩm khỏi giỏ hàng
     *   *    updateProductCart($user, $id, $amount)   => cập nhật số lượng sản phẩm trong giỏ hàng
     *   *    addProductCart($user, $id, $qty)      => thêm sản phẩm vào giỏ hàng
     *   *    clearCart($user)                      => xoá toàn bộ giỏ hàng
     *   ?      - $user: tên user
     *   ?      - $id: id sản phẩm
     * 
     * //* 4. countAmountProductCart($user, $id)   => đếm số lượng sản phẩm trong giỏ hàng
     *   *    totalMoneyCartUser($user)            => tính tổng tiền giỏ hàng của user
     *   *    getProductDetailCart($id)            => lấy thông tin chi tiết sản phẩm trong giỏ hàng
     * 
     */

    //! 1 ---------------------------------------- //
    public function getCartUser($user)
    {
        $data = $this->db->table($this->__cart)->where('username', '=', $user)->get();
        return $data;
    }
    public function countCart($user)
    {
        $data = $this->db->table($this->__cart)->where('username', '=', $user)->count();
        return $data;
    }

    //! 2 ---------------------------------------- //
    public function deleteProductCart($user, $id)
    {
        $data = $this->db->table($this->__cart)->where('username', '=', $user)->where('id_product', '=', $id)->delete();
        return $data;
    }
    public function updateProductCart($user, $id, $amount)
    {
        $data = $this->db->table($this->__cart)->where('username', '=', $user)->where('id_product', '=', $id)->update(['amount' => $amount]);
        return $data;
    }
    public function addProductCart($user, $id, $qty)
    {
        $checkExist = $this->db->table($this->__cart)->where('username', '=', $user)->where('id_product', '=', $id)->first();
        $productInfo = $this->db->table('tb_product')->where('id_product', '=', $id)->first();

        if (!empty($checkExist)) {
            $qty = $checkExist['amount'] + $qty;
            $data = [
                'amount' => $qty,
            ];
            $update = $this->db->table($this->__cart)->where('username', '=', $user)->where('id_product', '=', $id)->update($data);

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
            $data = $this->db->table($this->__cart)->insert($data);

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
        $data = $this->db->table($this->__cart)->where('username', '=', $user)->delete();
        return $data;
    }
    
    //! 3 ---------------------------------------- //
    public function countAmountProductCart($user, $id)
    {
        $data = $this->db->table($this->__cart)->where('username', '=', $user)->where('id_product', '=', $id)->first();
        return $data['amount'];
    }
    public function totalMoneyCartUser($user)
    {
        $data = $this->db->table($this->__cart, 'c')->join($this->__product, 'p', 'c.id_product = p.id_product')->where('c.username', '=', $user)->get();

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
    public function getProductDetailCart($id)
    {
        $data = $this->db->table($this->__product, 'p')->join($this->__cart, 'c', 'p.id_product = c.id_product')->where('p.id_product', '=', $id)->first();
        return $data;
    }
}
