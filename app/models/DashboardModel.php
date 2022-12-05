<?php

class DashboardModel extends Model{
    private $__user = 'tb_user';
    private $__product = 'tb_product';
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

    /** @param TRẢ_VỀ_CÁC_THÔNG_TIN_DASHBOARD
     * 
     * * 1.  getSumOrder($status = 'all')       =>  tổng đơn hàng theo trạng thái
     * *     getSumMoneyOrder()                 =>  tổng số tiền hàng (//! chỉ tính delivered)
     * *     getSumProduct()                    =>  tổng số sản phẩm
     * *     getSumUser()                       =>  tổng số người dùng
    */

    //! 1 ---------------------------------------- //
    public function getSumOrder($status = 'all'){
        if($status == 'all'){
            $count = $this->db->table($this->__order)->count();
        } else {
            $count = $this->db->table($this->__order)->where('status', '=', $status)->count();
        }
        return $count;
    }
    public function getSumMoneyOrder(){
        //* chỉ lấy status = 'delivered' thôi
        $data = $this->db->table($this->__order)->where('status', '=', 'delivered')->sum('total_money');
        if($data == null){
            $data = 0;
        } else {
            return round($data, 2);
        }
    }
    public function getSumProduct(){
        $count = $this->db->table($this->__product)->count();
        return $count;
    }
    public function getSumCustomer(){
        $count = $this->db->table($this->__user)->count();
        return $count;
    }
}
?>