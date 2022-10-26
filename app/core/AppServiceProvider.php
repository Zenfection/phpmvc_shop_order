<?php

class AppServiceProvider extends ServiceProvider {
    
    public function boot(){
        $dataUser = [];
        $user = Session::data('user');
        
        if(!empty($user)){
            $dataCart = $this->getUserCart($user);
            $totalMoney = $this->totalMoneyCartUser($user);
            $dataUser = [
                'user' => $user,
                'cart' => $dataCart,
                'total_money' => $totalMoney
            ];
        }
        View::share($dataUser);
    }

    private function getUserCart($user){
        $sql = "SELECT * FROM `tb_cart` as c, `tb_product` as p
                WHERE c.id_product = p.id_product
                AND c.username = '$user'";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    private function totalMoneyCartUser($user){
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