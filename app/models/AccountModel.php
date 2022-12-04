<?php

class AccountModel extends Model{
    private $__user = 'tb_user';
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

/** @param TRẢ_VỀ_CÁC_DANH_SÁCH_SẢN_PHẨM
*
* //* 1. getAccount($username)                      =>  trả về thông tin tài khoản
* *      getAllUser()                               =>  trả về tất cả thông tin tài khoản
* *      countOrderAllUser()                        =>  trả về số lượng đơn hàng của tài khoản
* *      countOrderUser($username)                  =>  trả về số lượng đơn hàng của tài khoản
* *      sumMoneyOrder($username)                   =>  trả về tổng tiền đơn hàng của tài khoản
*       ? $username: tên tài khoản
*
* //* 2. getOrder($username)                        => trả về danh sách đơn hàng
*   *    getDetailOrder($user, $id)                 => trả về chi tiết đơn hàng
*   *    cancelOrder($user, $id)                    => hủy đơn hàng
*       ? $username: tên tài khoản
*       ? $id: id của đơn hàng
* 
* //* 3. changeInfo($user, $data)                   => thay đổi thông tin tài khoản
*   *    changePassword($user, $pass, $data)        => thay đổi mật khẩu
*
* //* 4. addUser($data)                            => thêm tài khoản    
*/

    //! 1 ---------------------------------------- //
    public function getAccount($user){
        $data = $this->db->table($this->__user)->where('username', '=', $user)->first();
        return $data;
    }
    public function getAllUser(){
        $data = $this->db->table($this->__user)->get();
        return $data;
    }
    public function countOrderAllUser(){
        $sql = "SELECT u.username, count(o.id_order) as count
                FROM `tb_user` as u, `tb_order` as o
                WHERE u.username = o.username
                GROUP BY u.username";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function countOrderUser($username){  
        $data = $this->db->table($this->__order)->where('username', '=', $username)->count();
        return $data;
    }
    public function sumMoneyOrder($username){
        $data = $this->db->table($this->__order)->where('username', '=', $username)->sum('total_money');
        return $data;
    }

    //! 2 ---------------------------------------- //
    public function getOrder($user){
        $data = $this->db->table($this->__order)->where('username', '=', $user)->orderBy('order_date', 'DESC')->get();
        return $data;
    }
    public function getDetailOrder($user, $id){
        $sql = "SELECT p.id_product, p.name, p.price, p.image, od.amount, o.total_money, o.order_date, o.status
        FROM `tb_user` as u, `tb_order` as o, `tb_order_details` as od, `tb_product` as p
        WHERE u.username = o.username
        AND o.id_order = od.id_order
        AND od.id_product = p.id_product
        AND u.username = :username
        AND o.id_order = :id_order";
        
        $this->dataVar['username'] = $user;
        $this->dataVar['id_order'] = $id;
        $result = $this->db->query($sql, $this->dataVar)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function cancelOrder($user, $id){
        $data = $this->db->table($this->__order)->where('id_order', '=', $id)->where('username', '=',$user)->update(['status' => 'canceled']);
        return $data;
    }

    //! 3 ---------------------------------------- //
    public function changeInfo($user, $data){
        $data = $this->db->table($this->__user)->where('username', '=', $user)->update($data);
        return $data;
    }
    public function changePassword($user,$pass, $data){
        $data = $this->db->table($this->__user)->where('username', '=', $user)->where('password', '=', $pass)->update($data);
        return $data;
    }

    //! 4 ---------------------------------------- //
    public function addUser($data){
        $data = $this->db->table($this->__user)->insert($data);
        return $data;
    }
}
?>