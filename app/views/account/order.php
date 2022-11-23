<?php
$statusVie = ["Đang xử lý", "Đang giao hàng", "Đã giao hàng", "Đã hủy"];
if (!empty($msg)) {
    $type_msg = $msg['type'];
    $icon_msg = $msg['icon'];
    $pos_msg = $msg['position'];
    $content_msg = $msg['content'];
    echo "<script>notify('$type_msg', '$icon_msg', '$pos_msg', '$content_msg')</script>";
}
?>

<div id="content">
    <!-- Shopping Cart Section Start -->
    <div class="section section-margin">
        <div class="container">
            <div class="row" data-aos="fade-down">
                <div class="col-12">
                    <!-- Cart Table Start -->
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered">
                            <h3 class="text-center">Chi tiết đơn hàng <?php echo $id_order ?></h3>
                            <!-- Table Head Start -->
                            <thead>
                                <tr>
                                    <th scope="col" class="pro-thumbnail">Ảnh</th>
                                    <th scope="col" class="pro-title">Sản Phẩm</th>
                                    <th scope="col" class="pro-price">Giá</th>
                                    <th scope="col" class="pro-subtotal">Tổng tiền</th>
                                </tr>
                            </thead>
                            <!-- Table Head End -->

                            <!-- Table Body Start -->
                            <tbody>
                                <?php
                                foreach ($order_detail as $key => $value) {
                                    $id = $value['id_product'];
                                    $name = $value['name'];
                                    $price = (float)$value['price'];
                                    $image = $value['image'];
                                    $amount = (int)$value['amount'];
                                    $order_date = $value['order_date'];
                                    $status = $value['status'];
                                    $total_money = (float)$value['total_money'];
                                    $disocunt = $value['discount'];

                                    if($disocunt > 0){
                                        $price = $price - ($price * $disocunt / 100);
                                    }
                                    $total_price = $price * $amount;
                                ?>
                                    <tr>
                                        <td class="pro-thumbnail">
                                            <a class="cursor-pointer" onclick="loadDetailProduct(<?php echo $id?>)">
                                                <img class="fit-image rounded" src="<?php echo _CDN_IMAGE_150 . '/products/' . $image ?>" alt="Product<?php echo $id_product ?>" style="width:70%" />
                                            </a>
                                        </td>
                                        <td class="pro-title">
                                            <a class="cursor-pointer" onclick="loadDetailProduct(<?php echo $id?>)"><?php echo $name ?></a>
                                        </td>
                                        <td class="pro-price">
                                            <span><?php echo number_price($price) ?> x <?php echo $amount ?></span>
                                        </td>
                                        <td class="pro-subtotal"><span><?php echo number_price($total_price) ?></span></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            <!-- Table Body End -->

                        </table>
                    </div>
                    <!-- Cart Table End -->

                </div>
            </div>

            <div class="row m-t-50" data-aos="fade-up">
                <div class="col-lg-6 me-0 ms-auto">

                    <!-- Cart Calculation Area Start -->
                    <div class="cart-calculator-wrapper">

                        <div class="cart-calculate-items">
                            <h3 class="title text-center">Thông tin đơn hàng</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td>Ngày đặt hàng</td>
                                        <td><?php echo $order_date ?></td>
                                    </tr>
                                    <tr>
                                        <td>Trạng thái</td>
                                        <td><?php
                                            if ($status == 'pending') {
                                                echo $statusVie[0];
                                            } else if ($status == 'shipping') {
                                                echo $statusVie[1] . ' (không thể huỷ hàng)';
                                            } else if ($status == 'delivered') {
                                                echo $statusVie[2] . ' (không thể huỷ hàng)';
                                            } else if ($status == 'canceled') {
                                                echo $statusVie[3] . ' (không thể huỷ hàng)';
                                            }
                                            ?></td>
                                    </tr>
                                    <tr class="total">
                                        <td>Tổng tiền</td>
                                        <td class="total-amount"><?php echo number_price($total_money) ?></td>
                                    </tr>
                                </table>
                            </div>
                            <!-- Responsive Table End -->

                        </div>
                        <?php if ($status == 'pending') {
                        ?>
                            <a href="/account/cancel_order/<?php echo $id_order ?>" class="btn btn btn-gray-deep btn-hover-primary m-t-30">Huỷ Hàng</a>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- Cart Calculation Area End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Shopping Cart Section End -->
</div>