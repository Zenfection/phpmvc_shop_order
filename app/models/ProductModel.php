<?php

namespace App\models;

use Core\Model;
use Core\Memcached;
use PDO;

class ProductModel extends Model {
    private $__product = 'tb_product';
    private $__category = 'tb_category';
    private $__review_product = 'tb_recent_product';
    private $__order_details = 'tb_order_details';
    
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
*  * 1. topProductRanking($limit)          => top sản phẩm bán chạy
*  *    topProductDiscount($limit)         => top sản phẩm giảm giá
*  *    topProductSeller($limit)           => top sản phẩm bán chạy
*      ? $limit: số lượng sản phẩm cần lấy
*
*  * 2. getProduct()                       => lấy tất cả sản phẩm
*  *    getCategory()                      => lấy tất cả danh mục
*  *    getDetail($id)                     => lấy sản phẩm theo id
*  *    insertProduct($data)               => thêm sản phẩm            //! True & False
*  *    updateProduct($id, $data)          => cập nhật sản phẩm        //! True & False
*  *    deleteProduct($id)                 => xóa sản phẩm             //! True & False
*      ? $data: mảng dữ liệu cần thêm, sửa, xóa
*      ? $id: id sản phẩm cần sửa, xóa
*
*  * 3. similarProduct($id_category)       => lấy sản phẩm tương tự
*  *    getProductOrder($id_order)         => lấy sản phẩm theo id_order
*      ? $id_category: id danh mục sản phẩm
*      ? $id_order: id đơn hàng
*
*  * 4. recentViewProduct($user, $limit)   => lấy sản phẩm đã xem gần đây
*  *    countRecentViewProduct($user)      => đếm sản phẩm đã xem gần đây
*  *    addRecent($user, $id_product)      => thêm sản phẩm đã xem     //! True & False
*      ? $user: id người dùng
*      ? $id_product: id sản phẩm
*      ? $limit: số lượng sản phẩm cần lấy
*
*  * 5. searchProduct($keyword)                                         => tìm kiếm sản phẩm
*  *    getProductCategory($category, $keyword = '')                    => lấy sản phẩm theo danh mục
*  *    sellingFilterProduct($category, $keyword = '', $limit = 'all')  => lọc sản phẩm theo bán chạy
*  *    priceFilterProduct($category, $sort, $keyword = '')             => lọc sản phẩm theo giá
*  *    discountFilterProduct($category, $keyword = '', $limit = 'all') => lọc sản phẩm theo giảm giá
*      ? $category: id danh mục sản phẩm
*      ? $keyword: từ khóa tìm kiếm
*      ? $sort: sắp xếp theo giá
*      ? $limit: số lượng sản phẩm cần lấy
*
*/
    
    //! 1 ---------------------------------------- //
    public function topProductRanking($limit){
        $data = $this->mc->get('topProductRanking');
        if(!$data){
            $data = $this->db->table($this->__product)->orderBy('ranking', 'DESC')->limit($limit)->get();
            $this->mc->set('topProductRanking', $data, 3600);
        }
        return $data;
    }
    public function topProductDiscount($limit){
        $data = $this->mc->get('topProductDiscount');
        if(!$data){
            $data = $this->db->table($this->__product)->orderBy('discount', 'DESC')->limit($limit)->get();
            $this->mc->set('topProductDiscount', $data, 3600);
        }
        return $data;
    }
    public function topProductSeller($limit){
        $data = $this->mc->get('topProductSeller');
        if(!$data){
            $data = $this->db->table($this->__product.' as p')->select('p.*, COUNT(od.amount) as total_amount')->join($this->__order_details, 'od', 'p.id_product = od.id_product')->groupBy('p.id_product')->orderBy('total_amount', 'DESC')->limit($limit)->get();
            $this->mc->set('topProductSeller', $data, 3600);
        }
        return $data;
    }

    //! 2 ---------------------------------------- //
    public function getProduct(){
        $data = $this->mc->get('getProduct');
        if(!$data){
            $data = $this->db->table($this->__product)->get();
            $this->mc->set('getProduct', $data, 3600);
        }
        return $data;
    }
    public function getCategory(){
        $data = $this->mc->get('getCategory');
        if(!$data){
            $data = $this->db->table($this->__category)->get();
            $this->mc->set('getCategory', $data, 3600);
        }
        return $data;
    }
    public function getDetail($id){
        $data = $this->mc->get('getDetail'.$id);
        if(!$data){
            $data = $this->db->table($this->__product)->where('id_product', '=', $id)->first();
            $this->mc->set('getDetail'.$id, $data, 3600);
        }
        return $data;
    }
    public function insertProduct($data){
        $data = $this->db->table($this->__product)->insert($data);
        $this->mc->delete('getProduct');
        return $data;
    }  
    public function updateProduct($id, $data){
        $data = $this->db->table($this->__product)->where('id_product','=', $id)->update($data);
        $this->mc->delete('getDetail'.$id);
        return $data;
    }
    public function deleteProduct($id){
        $data = $this->db->table($this->__product)->where('id_product', '=', $id)->delete();
        $this->mc->delete('getProduct');
        return $data;
    }

    //! 3 ---------------------------------------- //
    public function similarProduct($id_category){
        $data = $this->mc->get('similarProduct'.$id_category);
        if(!$data){
            $data = $this->db->table($this->__product)->where('id_category', '=', $id_category)->get();
            $this->mc->set('similarProduct'.$id_category, $data, 3600);
        }
        return $data;
    }
    public function getProductOrder($id_order){
        $data = $this->mc->get('getProductOrder'.$id_order);
        if(!$data){
            $data = $this->db->table($this->__product . ' as p')->join($this->__order_details, 'od', 'p.id_product = od.id_product')->where('od.id_order', '=', $id_order)->get();
            $this->mc->set('getProductOrder'.$id_order, $data, 3600);
        }
        return $data;
    }

    //! 4 ---------------------------------------- //
    public function recentViewProduct($user, $limit){
        $data = $this->db->table($this->__product . ' as p')->join($this->__review_product, 'r', 'p.id_product = r.id_product')->where('r.username', '=', $user)->limit($limit)->get();
        return $data;
    }
    public function countRecentViewProduct($user){
        $data = $this->db->table($this->__review_product)->where('username', '=', $user)->count();
        return $data;
    }
    public function addRecent($user, $id){
        $checkExist = $this->db->table($this->__review_product)->where('username', '=', $user)->where('id_product', '=', $id)->get();
        $data = [
            'username' => $user,
            'id_product' => $id
        ];
        if(!empty($checkExist)){
            $this->db->table($this->__review_product)->where('id_product', '=', $id)->delete();
        }
        $result = $this->db->table($this->__review_product)->insert($data);
        return $result;
    }

    //! 5 ---------------------------------------- //
    public function searchProduct($keyword){
        $data = $this->db->table($this->__product)->where('LOWER(name)', '', '')->search($keyword);
        return $data;
    }
    public function getProductCategory($category, $keyword = ''){
        if($keyword == ''){
            $data = $this->db->table($this->__product, 'p')->select('p.*')->join($this->__category, 'c', 'p.id_category = c.id_category')->where('c.id_category', '=', $category)->get();
        } else {
            $sql = "SELECT * FROM 
                        (SELECT p.* FROM `tb_category` as c, `tb_product` as p
                        WHERE c.id_category = p.id_category
                        AND c.id_category = '$category') as temp
                    WHERE LOWER(temp.name)
                    COLLATE UTF8_GENERAL_CI
                    LIKE CONCAT('%', LOWER(CONVERT('$keyword', BINARY)), '%')";
            $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    public function sellingFilterProduct($category, $keyword = '', $limit = 'all'){
        if($limit == 'all'){
            $limit = $this->db->table($this->__product)->count();
        }

        if($keyword == ''){
            if($category == 'all'){
                $sql = "SELECT p.*, COUNT(od.amount) as total_amount
                        FROM `tb_order_details` as od, `tb_product` as p
                        WHERE od.id_product = p.id_product
                        GROUP BY p.id_product
                        ORDER BY total_amount DESC
                        LIMIT $limit";
            } else {
                $sql = "SELECT p.*, COUNT(od.amount) as total_amount
                        FROM `tb_order_details` as od, `tb_product` as p
                        WHERE od.id_product = p.id_product
                        AND id_category = '$category'
                        GROUP BY p.id_product
                        ORDER BY total_amount DESC
                        LIMIT $limit";
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
                        LIKE CONCAT('%', LOWER(CONVERT('$keyword', BINARY)), '%');
                        LIMIT $limit";
            } else {
                $sql = "SELECT * FROM 
                            (SELECT p.*, COUNT(od.amount) as total_amount
                            FROM `tb_order_details` as od, `tb_product` as p
                            WHERE od.id_product = p.id_product
                            AND p.id_category = '$category') as temp 
                        WHERE LOWER(temp.name) 
                        COLLATE UTF8_GENERAL_CI 
                        LIKE CONCAT('%', LOWER(CONVERT('$keyword', BINARY)), '%')
                        LIMIT $limit";
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