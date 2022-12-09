<?php

namespace App\core;

use Core\Session;
use Core\View;
use Core\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    
    public function boot(){
        $dataUser = [];
        $user = Session::data('user');
        if(!empty($user)){      
            $dataCart = $this->getUserCart($user);
            (!$dataCart) ? $dataCart = [] : $dataCart;

            $totalMoney = $this->totalMoneyCartUser($dataCart);
            $dataUser = [
                'user' => $user,
                'cart' => $dataCart,
                'total_money' => $totalMoney
            ];
        }
        
        View::share($dataUser);
    }

    private function getUserCart($user){
        $data = $this->db->table('tb_cart', 'c')->join('tb_product' ,'p', 'p.id_product = c.id_product')->where('c.username', '=', $user)->get();
        return $data;
    }
    private function totalMoneyCartUser($dataCart){
        $total = 0;
        if(!$dataCart){
            foreach($dataCart as $item){
                $price = (float)$item['price'];
                $discount = (float)$item['discount'];
                $amount = (int)$item['amount'];
                $discount_price = $price - ($price * $discount / 100);
                $total += $discount_price * $amount;
            }
        }
        return $total;
    }
}
?>