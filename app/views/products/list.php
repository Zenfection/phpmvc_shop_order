<?php 
    $count = count($data);
    for($i = 0; $i < $count; $i++){
        $id = $data[$i]['id_product'];
        $name = $data[$i]['name'];
        $price = $data[$i]['price'];
        $discount = $data[$i]['discount'];
        $ranking = $data[$i]['ranking'];
        $image = $data[$i]['image'];
        ?>
        <div class="col-12 col-sm-6 col-lg-3 product-wrapper m-b-40 product">
    <div class="thumb">
        <a class="cursor-pointer" onclick="loadDetailProduct(<?php echo $id?>)">
            <img class="fit-image p-10" src="<?php echo _CDN_IMAGE_300 . '/products/' . $image ?>" alt="Product" />
        </a>
        <?php
        if ($discount > 0) {
            $discount_price = $price - ($price * $discount / 100);
            ?>
            <span class="badges">
                <span class="sale"><?php echo (int)$discount ?> %</span>
            </span>
            <?php
        }
        ?>
        <div class="action-wrapper" id="wrapper<?php echo $id ?>">
            <a class="action cursor-pointer" title="Thêm sản phẩm" onclick="addProductCart('<?php echo $id?>', 1)"><i class="fa-duotone fa-plus-large"></i></a>
            <a class="action wishlist" title="Wishlist"><i class="fa-duotone fa-heart"></i></a>
            <a class="nav-content cursor-pointer action cart" onclick="loadContent('viewcart')">
                <i class="fa-duotone fa-cart-circle-plus"></i>
            </a>
        </div>
    </div>
    <div class="content">
        <h5 class="title"><a class="product-title"><?php echo $name ?></a></h5>
        <span class="rating">
            <?php
            $temp = $ranking;
            for ($j = 0; $j < 5; $j++) {
                if ($temp > 2) {
                    echo "<i class='fa-solid fa-star' style='color: #ffad42'></i>";
                    $temp -= 2;
                } else if ($temp > 0) {
                    echo "<i class='fa-solid fa-star-half' style='color: #ffad42'></i>";
                    $temp = 0;
                }
            }
            ?>
        </span>
        <span class="price">
            <?php
            if ($discount > 0) {
            ?>
                <span class="new"><?php echo number_price($discount_price) ?></span>
                <span class="old"><?php echo number_price($price) ?></span>
            <?php
            } else {
            ?>
                <span class='new'><?php echo number_price($price) ?></span>
            <?php
            }
            ?>
        </span>
    </div>
</div>
<?php
    }
?>
