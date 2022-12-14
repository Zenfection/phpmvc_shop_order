<!-- Header Action Button Start -->
<div class="header-action-btn header-action-btn-cart d-none d-sm-flex">
    <a class="cart-visible" href="javascript:void(0)">
        <i class="fa-duotone fa-bag-shopping fa-xl"></i>
        <?php
        if (!empty($user)) {
            $countCart = count($cart);
            echo "<span class='header-action-num' id='count-cart'>" . $countCart . "</span>";
        }
        ?>
    </a>

    <!-- Header Cart Content Start -->
    <div class="header-cart-content animate__animated">

        <!-- Cart Procut Wrapper Start  -->
        <div class="cart-product-wrapper">
            <?php
            if (!empty($user)) {
                foreach ($cart as $key => $value) {
                    $id = $value['id_product'];
                    $name = $value['name'];
                    $amount = $value['amount'];
                    $image = $value['image'];
                    $price = $value['price'];
                    $discount = $value['discount'];
                    $discount_price = $price - ($price * $discount / 100);

                    $cart_product = [
                        'id' => $id,
                        'name' => $name,
                        'amount' => $amount,
                        'image' => $image,
                        'price' => number_price($price),
                        'discount' => $discount,
                        'discount_price' => number_price($discount_price),
                    ];
            ?>
                    <!-- Cart Product/Price Start -->
                    <?php $this->render('blocks/cart_product', $cart_product)?>
                    <!-- Cart Product/Price End -->
            <?php
                }
            }
            ?>
        </div>
        <!-- Cart Procut Wrapper -->

        <!-- Cart Product Total Start -->
        <div class="cart-product-total p-b-20 m-b-20 border-bottom">
            <span class="value">Tổng tiền</span>
            <?php
            if(!empty($user)){
                //number format
                echo "<span class='value' id='totalmoney'>" . number_price($total_money) . "</span>";
            } else {
                echo "<span class='value' id='totalmoney'>0 </span>";
            }
            ?>
        </div>
        <!-- Cart Product Total End -->

        <!-- Cart Product Button Start -->
        <div class="cart-product-btn m-t-20">
            <a href="javascript:;" class="btn btn-outline-light btn-hover-primary w-100" onclick="loadContent('viewcart')">Giỏ Hàng</a>
            <a href="javascript:;" class="btn btn-outline-light btn-hover-primary w-100 m-t-20" onclick="loadContent('checkout')">Thanh Toán</a>
        </div>
        <!-- Cart Product Button End -->
    </div>
    <!-- Header Cart Content End -->
</div>

<!-- Mobile -->
<div class="header-action-btn header-action-btn-cart d-flex d-sm-none">
    <a href="javascript:;" class="nav-content" onclick="loadContent('viewcart')">
        <i class="fa-duotone fa-bag-shopping fa-xl"></i>
        <?php
        if (!empty($user)) {
            echo "<span class='header-action-num'>" . $countCart . "</span>";
        }
        ?>
    </a>
</div>