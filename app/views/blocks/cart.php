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
    <div class="header-cart-content">

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

            ?>
                    <!-- Cart Product/Price Start -->
                    <div class="cart-product-inner p-b-20 m-b-20 border-bottom product-inner" id="product_id<?php echo $id?>">
                        <!-- Single Cart Product Start -->
                        <div class="single-cart-product">
                            <div class="cart-product-thumb">
                                <a class="cursor-pointer" onclick="loadDetailProduct(<?php echo $id?>)">
                                    <img src="<?php echo _WEB_ROOT; ?>/assets/images/products/<?php echo $image ?>" alt="Cart Product" class="rounded">
                                </a>
                            </div>
                            <div class="cart-product-content">
                                <h3 class="title">
                                    <a class="cursor-pointer" onclick="loadDetailProduct(<?php echo $id?>)"></a>
                        </h3>
                                <div class="product-quty-price">
                                    <span class="cart-quantity" id="quantity<?php echo $id ?>">Số lượng: <strong> <?php echo $amount ?> </strong></span>
                                    <span class="price">
                                        <?php
                                        if ($discount > 0) {
                                        ?>
                                            <span class="new">$<?php echo $discount_price ?></span>
                                            <span class="old" style="text-decoration: line-through;color: #DC3545;opacity: 0.5;">$<?php echo $price ?></span>
                                        <?php
                                        } else {
                                        ?>
                                            <span class='new'>$<?php echo $price ?></span>
                                        <?php
                                        }
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Single Cart Product End -->

                        <!-- Product Remove Start -->
                        <div class="cart-product-remove">
                            <a class="remove-cart" id="product<?php echo $id ?>"><i class="fa-duotone fa-trash-can"></i></a>
                        </div>
                        <!-- Product Remove End -->

                    </div>
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
                echo "<span class='value' id='totalmoney'>" . $total_money . "$</span>";
            } else {
                echo "<span class='value' id='totalmoney'>0 $</span>";
            }
            ?>
        </div>
        <!-- Cart Product Total End -->

        <!-- Cart Product Button Start -->
        <div class="cart-product-btn m-t-20">
            <a id="viewcart" class="btn btn-outline-light btn-hover-primary w-100" href="/viewcart">Giỏ Hàng</a>
            <a class="btn btn-outline-light btn-hover-primary w-100 m-t-20" href="/checkout">Thanh Toán</a>
        </div>
        <!-- Cart Product Button End -->
    </div>
    <!-- Header Cart Content End -->
</div>

<!-- Mobile -->
<div class="header-action-btn header-action-btn-cart d-flex d-sm-none">
    <a id="viewcart" class="nav-content cursor-pointer">
        <i class="fa-duotone fa-bag-shopping fa-xl"></i>
        <?php
        if (!empty($user)) {
            echo "<span class='header-action-num'>" . $countCart . "</span>";
        }
        ?>
    </a>
</div>