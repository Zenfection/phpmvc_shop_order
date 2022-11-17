<?php

class Api extends Controller
{

    //* TỔNG HỢP GET */
    public function top_discount($amount = 8)
    {
        $topProductDiscount = $this->models('ProductModel')->topProductDiscount($amount);
        $response = new Response();
        $response->json(['status' => 'success', 'data' => $topProductDiscount]);
    }

    public function top_ranking($amount = 8)
    {
        $topProductRanking = $this->models('ProductModel')->topProductRanking($amount);
        $response = new Response();
        $response->json(['status' => 'success', 'data' => $topProductRanking]);
    }

    public function category_product($category)
    {
        $categoryProduct = $this->models('ProductModel')->getProductCategory($category);
        $response = new Response();
        $response->json(['status' => 'success', 'data' => $categoryProduct]);
    }


    //* TỔNG HỢP POST*/
    public function login()
    {
        $response = new Response();
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $db = new Database();
            $data = $db->table('tb_user')->where('username', '=', $username)->where('password', '=', $password)->first();
            if ($data) {
                $response->json(['status' => 'success', 'data' => $data]);
            } else {
                $response->json(['status' => 'failed', 'message' => 'Tài khoản hoặc mật khẩu không chính xác']);
            }
        } else {
            $response->json(['status' => 'error', 'message' => 'API không nhận được password']);
        }
    }
    public function get_user_info()
    {
        $response = new Response();
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            unset($_POST['password']);
            $db = new Database();
            $data = $db->table('tb_user')->where('username', '=', $username)->where('password', '=', $password)->first();
            if ($data) {
                $response->json(['status' => 'success', 'data' => $data]);
            } else {
                $response->json(['status' => 'failed', 'message' => 'Tài khoản không tồn tại']);
            }
        } else {
            $response->json(['status' => 'error', 'message' => 'API không nhận được password']);
        }
    }

    public function get_cart_product()
    {
        $response = new Response();
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            unset($_POST['password']);
            $sql = "SELECT p.*, c.amount FROM tb_cart as c, tb_product as p , tb_user as u 
                    WHERE c.id_product = p.id_product
                    AND u.username = c.username
                    AND u.username = '$username'
                    AND u.password = '$password'";
            $db = new Database();
            $data = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            if ($data) {
                $response->json(['status' => 'success', 'data' => $data]);
            } else {
                $response->json(['status' => 'failed', 'message' => 'Tài khoản không tồn tại']);
            }
        } else {
            $response->json(['status' => 'error', 'message' => 'API không nhận được password']);
        }
    }

    public function add_product_cart()
    {
        $response = new Response();
        if(!$this->check_user($_POST['username'], $_POST['password'])){
            $response->json(['status' => 'failed', 'message' => 'Tài khoản không tồn tại']);
            return;
        }
        if (isset($_POST['id']) && isset($_POST['qty'])) {
            $username = $_POST['username'];
            $id = (int)$_POST['id'];
            $qty = (int)$_POST['qty'];

            $product_info = $this->models('ProductModel')->getDetail($id);
            $product_detail_cart = $this->models('CartModel')->getProductDetailCart($id);
            $total_qty = (int)$product_detail_cart['amount'] + (int)$qty;

            if ((int)$total_qty > $product_info['quantity']) {
                $response->json(['status' => 'failed', 'message' => 'Số lượng hàng trong kho không đủ']);
                return;
            }

            $data = $this->models('CartModel')->addProductCart($username, $id, $qty);
            if ($data['status'] == 'update') {
                $data = [
                    'status' => 'success',
                    'type' => 'update',
                    'message' => 'Thêm 1 sản phẩm vào giỏ hàng'
                ];
                $response->json($data);
            } else if ($data['status'] == 'insert') {
                $data = [
                    'status' => 'success',
                    'type' => 'insert',
                    'message' => 'Thêm 1 sản phẩm vào giỏ hàng'
                ];
                $response->json($data);
            } else {
                $response->json(['status' => 'failed', 'message' => 'Thêm sản phẩm vào giỏ hàng thất bại']);
            }
        } else {
            $response->json(['status' => 'error', 'message' => 'API không nhận thông tin']);
        }
    }
    public function delete_product_cart()
    {
        $response = new Response();
        if(!$this->check_user($_POST['username'], $_POST['password'])){
            $response->json(['status' => 'failed', 'message' => 'Tài khoản không tồn tại']);
            return;
        }
        if(isset($_POST['id']) && isset($_POST['qty'])){
            $username = $_POST['username'];
            $id = (int)$_POST['id'];
            $qty = (int)$_POST['qty'];

            $count_cart = $this->models('CartModel')->countAmountProductCart($username, $id);
            if($count_cart <= $qty){
                $data = $this->models('CartModel')->deleteProductCart($username, $id);
                if($data){
                    $response->json(['status' => 'success', 'message' => 'Đã bớt ' + $qty + ' sản phẩm khỏi giỏ hàng']);
                } else {
                    $response->json(['status' => 'failed', 'message' => 'Bớt sản phẩm thất bại']);
                }
            } else {
                $amount = $count_cart - $qty;
                $data = $this->models('CartModel')->updateProductCart($username, $id, $amount);
                if($data){
                    $response->json(['status' => 'success', 'message' => 'Đã xoá sản phẩm ra giỏ hàng']);
                } else {
                    $response->json(['status' => 'failed', 'message' => 'Xoá sản phẩm ra giỏi hàng thất bại']);
                }
            }

        } else{
            $response->json(['status' => 'error', 'message' => 'API không nhận được thông tin']);
        }
    }

    public function get_order_status()
    {
        $response = new Response();
        if(!$this->check_user($_POST['username'], $_POST['password'])){
            $response->json(['status' => 'failed', 'message' => 'Tài khoản không tồn tại']);
            return;
        }
        
        if(isset($_POST['status'])){

            $status = $_POST['status'];

            $db = new Database();
            $sql = "SELECT o.*, p.image FROM `tb_order` as o, `tb_product` as p, `tb_order_details` as d
            WHERE o.id_order = d.id_order
            AND d.id_product = p.id_product
            AND o.status = '$status'
            GROUP BY id_order";

            $data = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            if($data){
                $response->json(['status' => 'success', 'data' => $data]);
            } else {
                $response->json(['status' => 'failed', 'message' => 'Không có đơn hàng nào']);
            }
        } else{
            $response->json(['status' => 'error', 'message' => 'API không nhận được thông tin']);
        }
    }

    public function get_order_product()
    {
        $response = new Response();
        if(!$this->check_user($_POST['username'], $_POST['password'])){
            $response->json(['status' => 'failed', 'message' => 'Tài khoản không tồn tại']);
            return;
        }
        if(isset($_POST['id_order'])){
            $id_order = $_POST['id_order'];
            if($id_order == ''){
                $response->json(['status' => 'failed', 'message' => 'Không có đơn hàng nào']);
                return;
            }

            $db = new Database();
            $sql = "SELECT p.*, od.amount FROM `tb_order` as o, `tb_order_details` as od, `tb_product` as p
                    WHERE od.id_order = o.id_order
                    AND od.id_product = p.id_product
                    AND o.id_order = '$id_order';";

            $data = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            if($data){
                $response->json(['status' => 'success', 'data' => $data]);
            } else {
                $response->json(['status' => 'failed', 'message' => 'Không có sản phẩm nào']);
            }
        } else {
            $response->json(['status' => 'error', 'message' => 'API không nhận được thông tin']);
        }
    }

    public function checkout($user)
    {
        $response = new Response();
        
        $db = new Database();
        $sql = "SELECT * FROM `tb_user` WHERE username = '$user'";
        $user_info = $db->query($sql)->fetch(PDO::FETCH_ASSOC);
        $count_cart = $this->models('CartModel')->countCart($user);
        if ($count_cart == 0) {
            $data = [
                'status' => 'error',
                'data' => 'Giỏ hàng trống'
            ];
            $response->json($data);
            return;
        }

        $fullname = $user_info['fullname'];
        $phone = $user_info['phone'];
        $address = $user_info['address'];
        $email = $user_info['email'];
        $province = 'Cần Thơ';
        $city = 'Quận Ninh Kiều';
        $ward = 'Phường Hưng Lợi';


        $order_date = date('Y-m-d');
        $status = 'pending';
        $totalMoney = $this->models('CartModel')->totalMoneyCartUser($user);

        // Tạo id order
        $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        $id_order = strtoupper(substr(str_shuffle($str), 0, 10));

        $data = [
            'id_order' => $id_order,
            'username' => $user,
            'name_customer' => $fullname,
            'phone_customer' => $phone,
            'address_customer' => $address,
            'email_customer' => $email,
            'city_customer' => $city,
            'ward_customer' => $ward,
            'province_customer' => $province,
            'status' => $status,
            'order_date' => $order_date,
            'total_money' => $totalMoney
        ];
        $result = $this->db->table('tb_order')->insert($data);
        if (!$result) {
            $response->json(['status' => 'error', 'data' => 'Đặt hàng thất bại']);
        } else {
            //* thêm vào bảng tb_order_detail
            $cartProduct = $this->models('CartModel')->getCartUser($user);
            foreach ($cartProduct as $item) {
                $dataCart = [
                    'id_order' => $id_order,
                    'id_product' => (int)$item['id_product'],
                    'amount' => (int)$item['amount'],
                ];
                $this->db->table('tb_order_details')->insert($dataCart);
                if (!$result) {
                    $response->json(['status' => 'error', 'data' => 'Đặt hàng thất bại']);
                }
            }
            //* xoá giỏ hàng
            $this->models('CartModel')->clearCart($user);
            $response->json(['status' => 'success', 'data' => $id_order]);
        }
    }

    public function change_user_info($user, $fullname, $email, $address, $phone)
    {
        $fullname = urldecode($fullname);
        $email = urldecode($email);
        $address = urldecode($address);
        $phone = urldecode($phone);

        $data = [
            'fullname' => $fullname,
            'email' => $email,
            'address' => $address,
            'phone' => $phone
        ];
        $result = $this->db->table('tb_user')->where('username', '=', $user)->update($data);
        $response = new Response();
        if ($result) {
            $response->json(['status' => 'success', 'data' => 'Cập nhật thông tin thành công']);
        } else {
            $response->json(['status' => 'error', 'data' => 'Cập nhật thông tin thất bại']);
        }
    }

    //* FUNCTION */
    private function check_user($username, $password)
    {
        $db = new Database();
        $data = $db->table('tb_user')->where('username', '=', $username)->where('password', '=', $password)->first();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }
}
