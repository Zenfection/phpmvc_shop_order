<?php

class OrderModel extends Model{
    private $__order = 'tb_order';

    function __construct(){
        parent::__construct();
    }

    function tableFill(){
        return 'tb_product';
    }

    function fieldFill(){
        return '*';
    }

    /** @param TRẢ_VỀ_CÁC_DANH_SÁCH_ORDER
     * 
     *  * 1. getOrder(keyword = '')                 =>  trả về danh sách order
     *  *    getOrderDetail($id)                    =>  trả về order theo id
     *  *    getOrderStatus($id_user)               =>  trả về order theo id_user
     *  *    getOrderUser($user)                    =>  trả về order theo user
     *          ? keyword: từ khoá tìm kiếm
     *          ? $id: id của order
     *          ? $id_user: id của user
     *      
     *  * 2. totalProductOrder($id_product)         =>  trả về danh sách order theo keyword
     *          ? $id_product: id của sản phẩm
     * 
     *  * 3. updateOrder($id_order)                 => cập nhật order
     * 
    */

    //! 1 ---------------------------------------- //
    public function getOrder($keyword = ''){
        if($keyword == ''){
            $sql = "SELECT * FROM `tb_order`";
        }else {
            $sql = "SELECT * FROM `tb_order` 
            WHERE LOWER(id_order) 
            COLLATE UTF8_GENERAL_CI 
            LIKE CONCAT('%', LOWER(CONVERT('$keyword', BINARY)), '%')";
        }

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function getOrderDetail($id_order){
        $data = $this->db->table($this->__order)->where('id_order', '=', $id_order)->first();
        return $data;
    }
    public function getOrderStatus($user, $status){
        $data = $this->db->table($this->__order)->where('username', '=', $user)->where('status', '=', $status)->get();
        return $data;
    }
    public function getOrderUser($user){
        $data = $this->db->table($this->__order)->where('username', '=', $user)->get();
        return $data;
    }
    //! 2 ---------------------------------------- //
    public function totalProductOrder($id_product){
        $sql = "SELECT SUM(amount) as total  
                FROM `tb_order_details` 
                WHERE id_product = $id_product";
        $data = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $data['total'];
    }

    //! 3 ---------------------------------------- //
    public function updateOrder($id_order, $data){
        $data = $this->db->table($this->__order)->where('id_order', '=', $id_order)->update($data);
        return $data;
    }
}
?>