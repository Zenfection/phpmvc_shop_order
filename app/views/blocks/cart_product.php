<div class="cart-product-inner p-b-20 m-b-20 border-bottom product-inner" id="product_id<?php echo $id ?>">
    <!-- Single Cart Product Start -->
    <div class="single-cart-product">
        <div class="cart-product-thumb">
            <a class="cursor-pointer" onclick="loadDetailProduct(<?php echo $id ?>)">
                <img src="<?php echo _CDN_IMAGE_100 . '/products/' . $image ?>" alt="Cart Product" class="rounded">
            </a>
        </div>
        <div class="cart-product-content">
            <h3 class="title">
                <a class="cursor-pointer" onclick="loadDetailProduct(<?php echo $id ?>)"></a>
            </h3>
            <div class="product-quty-price">
                <span class="cart-quantity" id="quantity<?php echo $id ?>">Số lượng: <strong> <?php echo $amount ?> </strong></span>
                <span class="price">
                    <?php
                    if ($discount > 0) {
                    ?>
                        <span class="new"><?php echo $discount_price ?></span>
                        <span class="old" style="text-decoration: line-through;color: #DC3545;opacity: 0.5;"><?php echo $price ?></span>
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
        <a class="remove-cart cursor-pointer" onclick="deleteProductCart('<?php echo $id?>')"><i class="fa-duotone fa-trash-can"></i></a>
    </div>
    <!-- Product Remove End -->

</div>