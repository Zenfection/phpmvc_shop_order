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
        return $data;
    }

    public function clear(){
        $user = Session::data('user');
        $data = $this->models('CartModel')->clearCart($user);
        return $data;
    }
}
?>