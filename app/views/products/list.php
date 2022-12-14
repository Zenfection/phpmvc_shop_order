<?php
$count = count($data);
for ($i = 0; $i < $count; $i++) {
    $id = $data[$i]['id_product'];
    $name = $data[$i]['name'];
    $price = $data[$i]['price'];
    $discount = $data[$i]['discount'];
    $ranking = $data[$i]['ranking'];
    $image = $data[$i]['image'];
?>
    <div class="col-12 col-sm-6 col-lg-3 product-wrapper m-b-40 product">
        <div class="thumb">
            <a href="javascript:;" onclick="loadDetailProduct(<?php echo $id ?>)">
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
                <a href="javascript:;" class="action" title="Thêm sản phẩm" onclick="addProductCart('<?php echo $id ?>', 1)"><i class="fa-duotone fa-plus-large"></i></a>
                <a href="javascript:;" class="action wishlist" title="Wishlist"><i class="fa-duotone fa-heart"></i></a>
                <a href="javascript:;" class="action cart" onclick="loadContent('viewcart')">
                    <i class="fa-duotone fa-cart-circle-plus"></i>
                </a>
            </div>
        </div>
        <div class="content">
            <h5 class="title"><a class="product-title"><?php echo $name ?></a></h5>
            <span class="rating">
                <?php rating($ranking, 'fa-solid fa-star text-warning', 'fa-duotone fa-star-half-stroke text-warning', 'fa-solid fa-star text-secondary') ?>
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