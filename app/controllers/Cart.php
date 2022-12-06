<?php

class Cart extends Controller
{
    public $data;

    public function add_product()
    {
        if (isset($_POST['id'], $_POST['qty'])) {
            $id = (int)$_POST['id'];
            $qty = (int)$_POST['qty'];
            $product_info = $this->models('ProductModel')->getDetail($id);
            $product_detail_cart = $this->models('CartModel')->getProductDetailCart($id);
            $total_qty = $product_detail_cart['amount'] + $qty;

            if ($product_info['quantity'] < (int)$total_qty) {
                $this->fetchNoChange('Số lượng sản phẩm không đủ');
                return;
            }

            $dataShare = $this->getDataShare();
            $user = Session::data('user');
            $data = $this->models('CartModel')->addProductCart($user, $id, $qty);

            //* Chia ra 2 trường hợp: 
            //? 1 là update (đã có chỉ cần thêm) 
            //? 2 là insert (chưa có phải thêm)

            if ($data['status'] == 'update') {
                $total_money = $data['discount_price'] + $dataShare['total_money'];
                //number format
                $total_money = number_format($total_money, 0, ',', '.') . 'đ';
                $data = [
                    'status' => 'update',
                    'total_qty' => $data['total_qty'],
                    'total_money' => $total_money
                ];
                echo json_encode($data);
            } else if ($data['status'] == 'insert') {
                $name = $data['name'];
                $amount = $data['amount'];
                $image = $data['image'];
                $price = $data['price'];
                $discount = $data['discount'];
                $discount_price = $data['discount_price'];
                $total_money = $dataShare['total_money'] + $discount_price;

                //number format
                $price = number_format($price, 0, ',', '.') . 'đ';
                $discount_price = number_format($discount_price, 0, ',', '.') . 'đ';
                $total_money = number_format($total_money, 0, ',', '.') . 'đ';

                $contentView = file_get_contents(_DIR_ROOT . '/app/views/blocks/cart_product.php');
                eval('?>' . $contentView . '<?php');
            } else {
                $this->fetchError('Thêm sản phẩm vào giỏ hàng thất bại');
            }
        } else {
            $this->fetchServerError('Server không nhận được dữ liệu');
        }
    }

    public function delete_product()
    {
        //* Nếu không có qty thì xoá sản phẩm khỏi cart
        //* Nếu có qty thì cập nhật lại số lượng sản phẩm trong cart
        if (isset($_POST['id'])) {
            $id = (int)$_POST['id'];
            $user = Session::data('user');
            $total_money = $this->models('CartModel')->totalMoneyCartUser($user); // tổng tiền trước khi xoá
            $count_cart = $this->models('CartModel')->countCart($user); // số lượng sản phẩm trước khi xoá
            $amount_product_card = $this->models('CartModel')->countAmountProductCart($user, $id); // số lượng sản phẩm trong cart

            if (isset($_POST['qty'])) {
                $qty = (int)$_POST['qty'];
            }

            if (isset($qty) && $qty <= (int)$amount_product_card) {
                $amount = $amount_product_card - $qty;
                $data = $this->models('CartModel')->updateProductCart($user, $id, $amount);
            } else {
                $data = $this->models('CartModel')->deleteProductCart($user, $id);
            }
            if ($data) {
                $product_info = $this->models('ProductModel')->getDetail($id);
                $price = $product_info['price'];
                $discount = $product_info['discount'];
                $discount_price = $price - ($price * $discount / 100); // giá tiền sản phẩm


                //! Chia ra 2 trường hợp update và delete
                if (isset($qty)) {
                    $total_money = $total_money - ($discount_price * $qty);
                    $data = [
                        'status' => 'update',
                        'total_money' => number_format($total_money, 0, ',', '.') . 'đ',
                        'total_qty' => $amount_product_card - $qty
                    ];
                } else {
                    $total_money = $total_money - $discount_price * $amount_product_card;
                    $data = [
                        'status' => 'delete',
                        'total_money' => number_format($total_money, 0, ',', '.') . 'đ',
                        'total_qty' => $count_cart - 1
                    ];
                }
                echo json_encode($data);
            } else {
                $this->fetchError('Xoá sản phẩm thất bại');
            }
        } else {
            $this->fetchServerError('Server không nhận được dữ liệu');
        }
    }

    public function clear()
    {
        $user = Session::data('user');
        $data = $this->models('CartModel')->clearCart($user);

        $data = [
            'status' => 'clear',
        ];
        echo json_encode($data);
    }
}
