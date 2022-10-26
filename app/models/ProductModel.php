<?php

class ProductModel extends Model {
    private $__product = 'tb_product';
    private $__category = 'tb_category';
    
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
        $data = $this->db->table($this->__product)->orderBy('ranking', 'DESC')->limit($id)->get();
        return $data;
    }
    //* top sản phẩm có giảm giá nhiều
    public function topProductDiscount($id){
        $data = $this->db->table($this->__product)->orderBy('discount', 'DESC')->limit($id)->get();
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
        $data = $this->db->table($this->__product)->get();
        return $data;
    }
    public function insertProduct($data){
        $this->db->table($this->__product)->insert($data);
    }  

    public function getProductCategory($category){
        $sql = "SELECT * FROM `tb_category` as c, `tb_product` as p
                WHERE c.id_category = p.id_category
                AND c.id_category = '$category'";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function recentViewProduct($user, $limit){
        $sql = "SELECT * 
                FROM `tb_recent_product` as r, `tb_product` as p
                WHERE r.id_product = p.id_product 
                AND r.username = '$user' ORDER BY r.id_recent DESC LIMIT $limit";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }
    
    public function addRecent($user, $id){
        $checkExist = $this->db->table('tb_recent_product')->where('username', '=', $user)->where('id_product', '=', $id)->get();
        $data = [
            'username' => $user,
            'id_product' => $id
        ];
        if(!empty($checkExist)){
            $this->db->table('tb_recent_product')->where('id_product', '=', $id)->delete();
        }
        $result = $this->db->table('tb_recent_product')->insert($data);
        return $result;
    }

    public function getDetail($id){
        $id = (int) $id;
        $data = $this->db->table('tb_product')->where('id_product', '=', $id)->get();
        return $data;
    }

    public function similarProduct($id_category){
        $data = $this->db->table('tb_product')->where('id_category', '=', $id_category)->where('id_product', '!=', $id_category)->get();
        return $data;
    }

    public function deteleProduct($user, $id){
        $data = $this->db->table('tb_cart')->where('username', '=', $user)->where('id_product', '=', $id)->delete();
        return $data;
    }
    public function addProduct($user, $id, $qty){
        $checkExist = $this->db->table('tb_cart')->where('username', '=', $user)->where('id_product', '=', $id)->get();

        if(!empty($checkExist)){
            $qty = $checkExist[0]['amount'] + $qty;
            $data = [
                'amount' => $qty
            ];
            $data = $this->db->table('tb_cart')->where('username', '=', $user)->where('id_product', '=', $id)->update($data);
        } else {
            $data = [
                'username' => $user,
                'id_product' => $id,
                'amount' => $qty
            ];
            $data = $this->db->table('tb_cart')->insert($data);
        }
        return $data;
    }
}
?>