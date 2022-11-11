<?php

class Cart extends Controller {
    public $data;

    public function delete($id){
        $user = Session::data('user');
        $id = (int)$id;
        $data = $this->models('CartModel')->deteleProductCart($user, $id);
        return $data;
    }

    public function add($id, $qty){
        $user = Session::data('user');
        $id = (int)$id;
        $data = $this->models('CartModel')->addProductCart($user, $id, $qty);
        
        $dataShare = $this->getDataShare();

        //* Chia ra 2 trường hợp: 
            //? 1 là update (đã có chỉ cần thêm) 
            //? 2 là insert (chưa có phải thêm)

        if($data['status'] == 'update'){
            $total_money = $data['discount_price'] + $dataShare['total_money'];
            //number format
            $total_money = number_format($total_money, 0, ',', '.') . 'đ';
            $data = [
                'status' => 'update',
                'total_qty' => $data['total_qty'],
                'total_money' => $total_money
            ];
            echo json_encode($data);
        } else if($data['status'] == 'insert'){
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
        }
    }

    public function clear(){
        $user = Session::data('user');
        $data = $this->models('CartModel')->clearCart($user);
        return $data;
    }
}
