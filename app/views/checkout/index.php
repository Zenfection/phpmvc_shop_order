<?php
    if (!empty($msg)) {
        $type_msg = $msg['type'];
        $icon_msg = $msg['icon'];
        $pos_msg = $msg['position'];
        $content_msg = $msg['content'];
        echo "<script>notify('$type_msg', '$icon_msg', '$pos_msg', '$content_msg')</script>";
    }
?>
<!-- Checkout Section Start -->
<div class="section section-margin">
    <div class="container">
        <div class="row m-b-n20">
            <div class="col-lg-6 col-12 m-b-20" data-aos="fade-right">

                <!-- Checkbox Form Start -->
                <div class="checkbox-form">
                    <!-- Checkbox Form Title Start -->
                    <h3 class="title">Hoá Đơn Chi Tiết</h3>
                    <!-- Checkbox Form Title End -->
                    <form action="/checkout/validate" method="POST" id="checkoutForm">
                        <div class="row">
                            <!-- First Name Input Start -->
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label for="fullname">Họ và tên <span class="required">*</span></label>
                                    <input name="fullname" id="fullname" placeholder="Nhập họ và tên" type="text" value="<?php echo $fullname ?>" class="form-control">
                                </div>
                            </div>
                            <!-- First Name Input End -->

                            <!-- Last Name Input Start -->
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label for="phone">Điện Thoại <span class="required">*</span></label>
                                    <input name="phone" id="phone" placeholder="Nhập số điện thoại" type="text" value="<?php echo $phone ?>" class="form-control">
                                </div>
                            </div>
                            <!-- Last Name Input End -->

                            <!-- Address Input Start -->
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label for="address">Địa chỉ <span class="required">*</span></label>
                                    <input name="address" id="address" placeholder="Nhập địa chỉ giao hàng" type="text" value="<?php echo $address ?>" class="form-control">
                                </div>
                            </div>
                            <!-- Address Input End -->

                            <!-- State or Country Input Start -->
                            <div class="col-md-4">
                                <div class="checkout-form-list">
                                    <label for="province">Tỉnh <span class="required">*</span></label>
                                    <select class="nice-select" id="province" name="province" onchange="loadCity()">
                                                <?php
                                                foreach ($province_data as $key => $value) {
                                                    if ($value['name'] != $city) {
                                                        echo "<option value='" . $value['name'] . "'>" . $value['name'] . "</option>";
                                                    }
                                                }
                                                ?>
                                    </select>
                                </div>
                            </div>
                            <!-- State or Country Input End -->

                            <!-- Town or City Name Input Start -->
                            <div class="col-md-4">
                                <div class="checkout-form-list">
                                    <label for="city">Thành Phố 
                                        <span class="required">*</span>
                                    </label>
                                    <select class="nice-select" id="city" name="city" onchange="loadWard()">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="checkout-form-list">
                                    <label for="ward">Phường Xã 
                                        <span class="required">*</span>
                                    </label>
                                    <select class="nice-select" name="ward" id="ward">

                                    </select>
                                </div>
                            </div>
                            <!-- Town or City Name Input End -->

                            <!-- Email Address Input Start -->
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label for="email">Email <span class="required">*</span></label>
                                    <input name="email" id="email" placeholder="Nhập email nhận thông báo" type="email" value="<?php echo $email ?>" class="form-control">
                                </div>
                            </div>
                            <!-- Email Address Input End -->

                        </div>
                        <!-- Different Address End -->
                        <div class="order-button-payment">
                            <button class="btn btn-primary btn-hover-dark rounded-0 w-100" type="button">Đặt Hàng</button>
                        </div>
                </div>
                </form>
                <!-- Checkbox Form End -->
            </div>

            <div class="col-lg-6 col-12 m-b-20" data-aos="fade-left">
                <!-- Your Order Area Start -->
                <div class="your-order-area border">
                    <!-- Title Start -->
                    <h3 class="title">Đơn hàng của bạn</h3>
                    <!-- Title End -->

                    <!-- Your Order Table Start -->
                    <div class="your-order-table table-responsive">
                        <table class="table">
                            <!-- Table Head Start -->
                            <thead>
                                <tr class="cart-product-head">
                                    <th class="cart-product-name text-start">Sản phẩm</th>
                                    <th class="cart-product-total text-end">Tổng tiền</th>
                                </tr>
                            </thead>
                            <!-- Table Head End -->

                            <!-- Table Body Start -->
                            <tbody>
                                <?php
                                $totalMoney = $total_money;
                                foreach($cart as $key => $value){
                                    $name = $value['name'];
                                    $price = (float)$value['price'];
                                    $amount = (int)$value['amount'];
                                    $discout_price = $price * (100 - (int)$value['discount']) / 100;

                                    ?>
                                    <tr class="cart_item">
                                        <td class="cart-product-name text-start ps-0"> <?php echo $name ?>
                                            <strong class="product-quantity"> × <?php echo $amount ?></strong>
                                        </td>
                                        <td class="cart-product-total text-end pe-0">
                                            <span class="amount"><?php echo number_price($total) ?></span>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                            <!-- Table Body End -->

                            <!-- Table Footer Start -->
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <th class="text-start ps-0">Tổng đơn hàng</th>
                                    <td class="text-end pe-0"><strong><span class="amount"><?php echo number_price($totalMoney) ?></span></strong></td>
                                </tr>
                            </tfoot>
                            <!-- Table Footer End -->

                        </table>
                    </div>
                    <!-- Your Order Table End -->

                    <!-- Payment Accordion Order Button Start -->
                    <div class="payment-accordion-order-button">
                        <div class="payment-accordion">
                            <div class="single-payment">
                                <h5 class="panel-title m-b-15">
                                    <a class="collapse-off" data-bs-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                        Thanh toán
                                    </a>
                                </h5>
                                <div class="collapse show" id="collapseExample">
                                    <div class="card card-body rounded-0">
                                        <p>Chức năng thanh toán online hiện chưa phát triển, bạn chỉ có thể sử dụng thanh toán COD</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Payment Accordion Order Button End -->
                </div>
                <!-- Your Order Area End -->
            </div>
        </div>
    </div>
</div>
<!-- Checkout Section End -->

<script src="<?php echo _WEB_ROOT; ?>/assets/js/custom/checkout.js"></script>

<style>
    
    select.nice-select{
        display: none !important;
    }
    .nice-select{
        display: block !important;
        width: 100% !important;
        padding: 0.375rem 2.25rem 0.375rem 0.75rem !important;
        font-size: 1rem !important;
        font-weight: 400 !important;
        line-height: 1.5 !important;
        color: #212529 !important;
        border: 1px solid #ced4da !important;
        background-color: #fff !important;
        border-radius: 0.375rem !important;
    }
    .nice-select:focus{
        border-color: #80bdff !important;
        outline: 0 !important;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
    }
</style>
