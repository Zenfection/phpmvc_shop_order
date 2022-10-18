<?php
/**
 * Kế thừa từ class Model
 * 
 */
class HomeModel extends Model{
    private $__table = 'tb_product';

    function __construct(){
        parent::__construct();
    }

    function tableFill(){
        return 'tb_product';
    }

    function fieldFill(){
        return '*';
    }

    //* top sản phẩm có đánh giá cao
    public function topProductRanking($id){
        $data = $this->db->table($this->__table)->orderBy('ranking', 'DESC')->limit($id)->get();
        return $data;
    }
    //* top sản phẩm có giảm giá nhiều
    public function topProductDiscount($id){
        $data = $this->db->table($this->__table)->orderBy('discount', 'DESC')->limit($id)->get();
        return $data;
    }
    //* top sản phẩm bán chạy
    public function topProductSeller($id){
        $sql = "SELECT p.*, COUNT(od.amount) as total_amount
                FROM `tb_order_details` as od, `tb_product` as p
                WHERE od.id_product = p.id_product
                GROUP BY p.id_product
                ORDER BY total_amount DESC
                LIMIT $id";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }


    public function getProduct(){
        $data = $this->db->table($this->__table)->get();
        return $data;
    }
    public function insertProduct($data){
        $this->db->table($this->__table)->insert($data);
    }   
    public function deleteProductID($id){
        $this->db->table($this->__table)->where('id_product', '=', $id)->delete();
    }
    public function test(){
        $data = $this->db->table($this->__table)->count();
        return $data;
    }

}
?>