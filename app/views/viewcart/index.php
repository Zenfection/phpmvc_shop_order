<!-- Shopping Cart Section Start -->
<div class="section section-margin">
    <div class="container">

        <div class="row" data-aos="fade-down">
            <div class="col-12">

                <!-- Cart Table Start -->
                <div class="cart-table table-responsive">
                    <table class="table table-bordered">

                        <!-- Table Head Start -->
                        <thead>
                            <tr>
                                <th class="pro-thumbnail">Ảnh</th>
                                <th class="pro-title">Sản Phẩm</th>
                                <th class="pro-price">Giá Tiền</th>
                                <th class="pro-quantity">Số Lượng</th>
                                <th class="pro-subtotal">Tổng Tiền</th>
                                <th class="pro-remove">Xoá</th>
                            </tr>
                        </thead>
                        <!-- Table Head End -->

                        <!-- Table Body Start -->
                        <tbody id="table-cart">
                            <?php
                            $count = count($cart);
                            $totalMoney = $total_money;
                            foreach ($cart as $key => $value) {
                                $id = $value['id_product'];
                                $name = $value['name'];
                                $quantity = $value['amount'];
                                $image = $value['image'];
                                $discount = $value['discount'];
                                if ($discount > 0) {
                                    $price = $value['price'] - ($value['price'] * $discount / 100);
                                } else {
                                    $price = $value['price'];
                                }
                                $total_price = $price * $quantity;
                            ?>
                                <tr id="view_cart_product<?php echo $id ?>">
                                    <td class="pro-thumbnail">
                                        <img class="fit-image rounded" src="<?php echo _CDN_IMAGE_300 . '/products/' . $image ?>" alt="Product" />
                                    </td>
                                    <td class="pro-title">
                                        <a><?php echo $name ?></a>
                                    </td>
                                    <td class="pro-price"><span><?php echo number_price($price) ?>s</span></td>
                                    <td class="pro-quantity">
                                        <div class="quantity">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="<?php echo $quantity ?>" type="text">
                                                <div class="dec qtybutton" id="decQtyProduct">-</div>
                                                <div class="inc qtybutton" id="incQtyProduct">+</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pro-subtotal">
                                        <span><?php echo number_price($total_price) ?></span>
                                    </td>
                                    <td class="pro-remove" id="product<?php echo $id ?>" onclick="deleteProductCart('<?php echo $id ?>')">
                                        <a>
                                            <i class="fa-duotone fa-trash-xmark fa-2xl"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        <!-- Table Body End -->

                    </table>
                </div>
                <!-- Cart Table End -->

                <!-- Cart Button Start -->
                <div class="cart-button-section m-b-n20">

                    <!-- Cart Button left Side Start -->
                    <div class="cart-btn-lef-side m-b-20">
                        <a class="btn btn btn-gray-deep btn-hover-primary" href="/shop/cateogry">Tiếp tục mua</a>
                    </div>
                    <!-- Cart Button left Side End -->

                    <!-- Cart Button Right Side Start -->
                    <div class="cart-btn-right-right m-b-20 cursor-pointer" onclick="clearProductCart()">
                        <a class="btn btn btn-gray-deep btn-hover-primary">Xoá Hết Giỏ Hàng</a>
                    </div>
                    <!-- Cart Button Right Side End -->

                </div>
                <!-- Cart Button End -->

            </div>
        </div>

        <div class="row m-t-50" data-aos="fade-up">
            <div class="col-lg-6 me-0 ms-auto">

                <!-- Cart Calculation Area Start -->
                <div class="cart-calculator-wrapper">

                    <!-- Cart Calculate Items Start -->
                    <div class="cart-calculate-items">

                        <!-- Cart Calculate Items Title Start -->
                        <h3 class="title">Tổng Giỏ Hàng</h3>
                        <!-- Cart Calculate Items Title End -->

                        <!-- Responsive Table Start -->
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>Tổng Tiền</td>
                                    <td id="total-money"><?php echo number_price($totalMoney) ?></td>
                                </tr>
                                <tr>
                                    <td>Phí Ship</td>
                                    <td>0đ</td>
                                </tr>
                                <tr class="total">
                                    <td>Tổng</td>
                                    <td id="total-bill"><?php echo number_price($totalMoney) ?></td>
                                </tr>
                            </table>
                        </div>
                        <!-- Responsive Table End -->
                    </div>
                    <!-- Cart Calculate Items End -->

                    <!-- Cart Checktout Button Start -->
                    <a class="btn btn btn-gray-deep btn-hover-primary m-t-30" href="/checkout">Tiến Hành Thanh Toán</a>
                    <!-- Cart Checktout Button End -->
                </div>
                <!-- Cart Calculation Area End -->
            </div>
        </div>
    </div>
</div>
<!-- Shopping Cart Section End -->