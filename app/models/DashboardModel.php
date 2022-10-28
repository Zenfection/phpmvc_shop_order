<?php

class DashboardModel extends Model{
    function __construct(){
        parent::__construct();
    }

    function tableFill(){
        return 'tb_product';
    }

    function fieldFill(){
        return '*';
    }

    // Tổng đơn hàng, tổng số tiền hàng, tổng số sản phẩm, tổng số khách hàng
    public function getSumOrder($status = 'all'){
        if($status == 'all'){
            $count = $this->db->table('tb_order')->count();
        } else {
            $count = $this->db->table('tb_order')->where('status', '=', $status)->count();
        }
        return $count;
    }
    public function getSumMoneyOrder(){
        //* chỉ lấy status = 'delivered' thôi
        $sql = "SELECT ROUND(SUM(total_money),2) as totalMoney FROM `tb_order` WHERE status = 'delivered'";
        $result = $this->db->query($sql)->fetch();
        if($result['totalMoney'] == null){
            return 0;
        } else {
            return $result['totalMoney'];
        }
    }
    public function getSumProduct(){
        $count = $this->db->table('tb_product')->count();
        return $count;
    }
    public function getSumCustomer(){
        $count = $this->db->table('tb_user')->count();
        return $count;
    }
}
?>