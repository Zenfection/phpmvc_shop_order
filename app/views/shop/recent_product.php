<?php
if (!empty($user)) {
?>
    <div class="widget-list">
        <h3 class="widget-title m-b-30">Sản phẩm đã xem</h3>
        <div class="sidebar-body product-list-wrapper m-b-n30">
            <?php
            foreach ($recent_product as $key => $value) {
                $id = $value['id_product'];
                $name = $value['name'];
                $price = (float)$value['price'];
                $image = $value['image'];
                $discount = (int)$value['discount'];
                $new_price = $price - ($price * $discount) / 100;
            ?>
                <div class="single-product-list m-b-30">
                    <!-- Product List Thumb Start -->
                    <div class="product">
                        <div class="thumb">
                            <a class="image" href="/product/detail/<?php echo $id ?>">
                                <img class="fit-image first-image p-10" src="<?php echo _WEB_ROOT; ?>/assets/images/products/<?php echo $image ?>" id="img-product<?php echo $id ?>">
                            </a>
                        </div>
                    </div>
                    <!-- Product List Thumb End -->
                    <!-- Product List Content Start -->
                    <div class="product-list-content">
                        <h6 class="product-name">
                            <a href="/product/detail/<?php echo $id ?>"><?php echo $name ?></a>
                        </h6>
                        <span class="price">
                            <span class="new"><i class="fa-duotone fa-dollar-sign"></i><?php echo $new_price ?></span>
                            <span class="old"><i class="fa-duotone fa-dollar-sign"></i><?php echo $price ?></span>
                        </span>
                    </div>
                    <!-- Product List Content End -->
                </div>
            <?php
            }
            ?>
        </div>
    </div>
<?php
}
?>