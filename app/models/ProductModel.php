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

    public function getProductCategory($category, $keyword = ''){
        if($keyword == ''){
            $sql = "SELECT * FROM `tb_category` as c, `tb_product` as p
                    WHERE c.id_category = p.id_category
                    AND c.id_category = '$category'";
        } else {
            $sql = "SELECT * FROM 
                        (SELECT p.* FROM `tb_category` as c, `tb_product` as p
                        WHERE c.id_category = p.id_category
                        AND c.id_category = '$category') as temp
                    WHERE LOWER(temp.name)
                    COLLATE UTF8_GENERAL_CI
                    LIKE CONCAT('%', LOWER(CONVERT('$keyword', BINARY)), '%')";
        }
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

    public function searchProduct($keyword){
        $sql = "SELECT * FROM `tb_product` 
                WHERE LOWER(name) 
                COLLATE UTF8_GENERAL_CI 
                LIKE CONCAT('%', LOWER(CONVERT('$keyword', BINARY)), '%')";
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

    public function sellingFilterProduct($category, $keyword = ''){
        if($keyword == ''){
            if($category == 'all'){
                $sql = "SELECT p.*, COUNT(od.amount) as total_amount
                        FROM `tb_order_details` as od, `tb_product` as p
                        WHERE od.id_product = p.id_product
                        GROUP BY p.id_product
                        ORDER BY total_amount DESC";
            } else {
                $sql = "SELECT p.*, COUNT(od.amount) as total_amount
                        FROM `tb_order_details` as od, `tb_product` as p
                        WHERE od.id_product = p.id_product
                        AND id_category = '$category'
                        GROUP BY p.id_product
                        ORDER BY total_amount DESC";
            }
        } else {
            if($category == 'all'){
                $sql = "SELECT * FROM 
                            (SELECT p.*, COUNT(od.amount) as total_amount
                            FROM `tb_order_details` as od, `tb_product` as p
                            WHERE od.id_product = p.id_product
                            GROUP BY p.id_product
                            ORDER BY total_amount DESC) as temp 
                        WHERE LOWER(temp.name) 
                        COLLATE UTF8_GENERAL_CI 
                        LIKE CONCAT('%', LOWER(CONVERT('$keyword', BINARY)), '%');";
            } else {
                $sql = "SELECT * FROM 
                            (SELECT p.*, COUNT(od.amount) as total_amount
                            FROM `tb_order_details` as od, `tb_product` as p
                            WHERE od.id_product = p.id_product
                            AND p.id_category = '$category') as temp 
                        WHERE LOWER(temp.name) 
                        COLLATE UTF8_GENERAL_CI 
                        LIKE CONCAT('%', LOWER(CONVERT('$keyword', BINARY)), '%')";
            }
        }
        
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function priceFilterProduct($category, $sort, $keyword = ''){
        if($keyword == ''){
            if($category == 'all'){
                $sql = "SELECT *,
                case when (discount > 0) then price - (price * discount / 100) else price end 
                as discount_price
                FROM `tb_product`
                ORDER BY discount_price $sort;";
            } else {
                $sql = "SELECT *,
                case when (discount > 0) then price - (price * discount / 100) else price end 
                as discount_price
                FROM `tb_product`
                WHERE id_category = '$category'
                ORDER BY discount_price $sort;";
            }
        } else {
            if($category == 'all'){
                $sql = "SELECT * FROM 
                            (SELECT *,
                            case when (discount > 0) then price - (price * discount / 100) else price end 
                            as discount_price
                            FROM `tb_product`) as temp
                        WHERE LOWER(temp.name) 
                        COLLATE UTF8_GENERAL_CI 
                        LIKE CONCAT('%', LOWER(CONVERT('$keyword', BINARY)), '%')
                        ORDER BY temp.discount_price $sort";
            } else {
                $sql = "SELECT * FROM 
                            (SELECT *,
                            case when (discount > 0) then price - (price * discount / 100) else price end 
                            as discount_price
                            FROM `tb_product`
                            WHERE id_category = '$category') as temp
                        WHERE LOWER(temp.name) 
                        COLLATE UTF8_GENERAL_CI 
                        LIKE CONCAT('%', LOWER(CONVERT('$keyword', BINARY)), '%')
                        ORDER BY temp.discount_price $sort;";
            }
        }
    
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function discountFilterProduct($category, $keyword = ''){
        if($keyword == ''){
            if($category == 'all'){
                $sql = "SELECT * FROM `tb_product` ORDER BY discount DESC";
            } else {
                $sql = "SELECT * FROM `tb_product` WHERE id_category = '$category' ORDER BY discount DESC";
            }
        } else {
            if($category == 'all'){
                $sql = "SELECT * FROM `tb_product`
                        WHERE LOWER(name) 
                        COLLATE UTF8_GENERAL_CI 
                        LIKE CONCAT('%', LOWER(CONVERT('$keyword', BINARY)), '%')
                        ORDER BY discount DESC";
            } else {
                $sql = "SELECT * FROM 
                        WHERE id_category = '$category'
                        AND LOWER(name) 
                        COLLATE UTF8_GENERAL_CI 
                        LIKE CONCAT('%', LOWER(CONVERT('$keyword', BINARY)), '%')
                        ORDER BY discount DESC";
            } 
        }
        
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
?>