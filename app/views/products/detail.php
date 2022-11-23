<!-- Single Product Section Start -->
<div id="content">
    <div class="section section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 offset-lg-0 col-md-8 offset-md-2">
                    <!-- Product Details Image Start -->
                    <div class="product-details-img" data-aos="fade-right" data-aos-duration="500">
                        <!-- Single Product Image Start -->
                        <div class="single-product-img swiper-container product-gallery-top">
                            <div class="swiper-wrapper popup-gallery">
                                <?php
                                $id = $product_detail['id_product'];
                                $image = $product_detail['image'];
                                $name = $product_detail['name'];
                                $price = $product_detail['price'];
                                $discount = $product_detail['discount'];
                                $ranking = $product_detail['ranking'];
                                $description = $product_detail['description'];
                                $quantity = $product_detail['quantity'];
                                $id_category = $product_detail['id_category'];

                                ?>

                                <img class='w-100' src="<?php echo _CDN_IMAGE_500 . '/products/' . $image ?>" alt='Product' style="padding-right: 25%;">
                            </div>
                        </div>
                        <!-- Single Product Image End -->

                        <!-- Single Product Thumb Start -->
                        <div class="single-product-thumb swiper-container product-gallery-thumbs">
                            <!-- Next Previous Button Start -->
                            <div class="swiper-button-next swiper-nav-button"><i class="fa-duotone fa-angle-right fa-xl"></i></div>
                            <div class="swiper-button-prev swiper-nav-button"><i class="fa-duotone fa-angle-left fa-xl"></i></div>
                            <!-- Next Previous Button End -->
                        </div>
                        <!-- Single Product Thumb End -->

                    </div>
                    <!-- Product Details Image End -->

                </div>
                <div class="col-lg-7">

                    <!-- Product Summery Start -->
                    <div class="product-summery position-relative" data-aos="fade-left" data-aos-duration="500">

                        <!-- Product Head Start -->
                        <div class="product-head m-b-15">
                            <?php
                            echo "<h2 class='product-title'>$name</h2>";
                            ?>
                        </div>
                        <!-- Product Head End -->

                        <!-- Rating Start -->
                        <span class="rating justify-content-start m-b-10">
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
                        <!-- Rating End -->

                        <!-- Price Box Start -->
                        <span class="price-box m-b-10">
                            <?php
                            if ($discount > 0) {
                                $discount_price = $price - ($price * $discount / 100);
                            ?>
                                <span class="regular-price"><?php echo number_price($discount_price) ?></span>
                                <span class="old-price"><?php echo number_price($price) ?></span>
                            <?php
                            } else {
                            ?>
                                <span class='regular-price'><?php echo number_price($price) ?></span>
                            <?php
                            }
                            ?>
                        </span>
                        <!-- Price Box End -->

                        <!-- Product Inventory Start -->
                        <div class="product-inventroy m-b-15">
                            <?php
                            echo "<span class='inventroy-title'> <strong>Có sẵn:</strong></span>";
                            echo "<span class='inventory-varient'> $quantity trong kho</span>";
                            ?>
                        </div>
                        <!-- Product Inventory End -->

                        <!-- Description Start -->
                        <?php
                        echo "<p class='desc-content m-b-25'>$description.</p>";
                        ?>
                        <!-- Description End -->

                        <!-- Quantity Start -->
                        <div class="quantity d-flex align-items-center m-b-25">
                            <span class="m-r-10"><strong>Số lượng: </strong></span>
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" value="1" type="text" id="qty">
                                <div class="dec qtybutton">-</div>
                                <div class="inc qtybutton">+</div>
                            </div>
                        </div>
                        <!-- Quantity End -->

                        <!-- Cart Button Start -->
                        <div class="cart-btn action-btn m-b-30">
                            <div class="action-cart-btn-wrapper d-flex">
                                <div class="add-to-cart cursor-pointer" onclick="addProductCart('<?php echo $id?>', 'qty')">
                                    <a class="btn btn-primary btn-hover-dark rounded" style="width: 110%">Thêm Vào Giỏ</a>
                                </div>
                                <!-- <a href="#" title="Wishlist" class="heart"><i class="fa-duotone fa-heart fa-xl"></i></a> -->
                            </div>
                        </div>
                        <!-- Cart Button End -->

                        <!-- Social Shear Start -->
                        <div class="social-share">
                            <div class="widget-social justify-content-start m-b-30">
                                <a title="Facebook" href="#"><i class="fa-brands fa-facebook-f" style="padding-top: 7px;"></i></a>
                                <a title="Pinterest" href="#"><i class="fa-brands fa-pinterest-p" style="padding-top: 7px;"></i></a>
                                <a title="Twitter" href="#"><i class="fa-brands fa-twitter" style="padding-top: 7px;"></i></a>
                                <a title="Instagram" href="#"><i class="fa-brands fa-instagram" style="padding-top: 7px;"></i></a>
                            </div>
                        </div>
                        <!-- Social Shear End -->

                        <!-- Payment Option Start -->
                        <div class="payment-option m-t-20 d-flex">
                            <span><strong>Thanh Toán: </strong></span>
                            <a href="#">
                                <img class="fit-image m-l-5" src="<?php echo _GIT_SOURCE; ?>/assets/images/payment/payment_large.png" alt="Payment Option Image">
                            </a>
                        </div>
                        <!-- Payment Option End -->

                    </div>
                    <!-- Product Summery End -->

                </div>

            </div>
        </div>
    </div>
    <!-- Single Product Section End -->

    <!-- Single Product Tab Start -->
    <div class="section section-padding bg-name-bright">
        <div class="container">
            <div class="row">

                <!-- Single Product Tab Start -->
                <div class="col-lg-12 single-product-tab" data-aos="fade-up" data-aos-duration="500">
                    <ul class="nav nav-tabs m-b-n15" id="myTab" role="tablist">
                        <li class="nav-item m-b-15">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#connect-1" role="tab" aria-selected="true">Mô Tả</a>
                        </li>
                        <li class="nav-item m-b-15">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#connect-2" role="tab" aria-selected="false">Đánh Giá</a>
                        </li>
                        <li class="nav-item m-b-15">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#connect-3" role="tab" aria-selected="false">Chính sách vận chuyển</a>
                        </li>
                    </ul>

                    <div class="tab-content mb-text" id="myTabContent">
                        <div class="tab-pane fade show active" id="connect-1" role="tabpanel" aria-labelledby="home-tab">
                            <div class="desc-content">
                                <p class="m-b-15">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt vel hic iusto repellat odio. Rem distinctio, consectetur officia vitae ut quae sint velit, deserunt nesciunt cumque, repellat id iste earum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae atque voluptatibus sit molestiae cum laborum neque, facilis explicabo eum aliquam est similique inventore minus commodi sed, autem optio vero officiis? Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad facere sunt aspernatur repellat earum maiores magni, autem obcaecati minus necessitatibus quis consequuntur pariatur. Sed neque impedit at similique. Dolorem, perspiciatis.</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="connect-2" role="tabpanel" aria-labelledby="profile-tab">
                            <h4 class="title m-b-20">Tính năng chưa phát triển</h4>
                        </div>
                        <div class="tab-pane fade" id="connect-3" role="tabpanel" aria-labelledby="contact-tab">
                            <!-- Shipping Policy Start -->
                            <div class="shipping-policy m-t-40 m-b-n15">
                                <h4 class="title m-b-20">Shipping policy for our store</h4>
                                <p class="m-b-15">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate</p>
                                <ul class="policy-list m-b-15">
                                    <li>1-2 business days (Typically by end of day)</li>
                                    <li><a href="#">30 days money back guaranty</a></li>
                                    <li>24/7 live support</li>
                                    <li>odio dignissim qui blandit praesent</li>
                                    <li>luptatum zzril delenit augue duis dolore</li>
                                    <li>te feugait nulla facilisi.</li>
                                </ul>
                                <p class="m-b-15">Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum</p>
                                <p class="m-b-15">claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per</p>
                                <p class="m-b-15">seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
                            </div>
                            <!-- Shipping Policy End -->
                        </div>
                    </div>

                </div>
                <!-- Single Product Tab End -->

            </div>
        </div>
    </div>
    <!-- Single Product Tab End -->

    <!-- Product Section Start -->
    <div class="service-section section section-margin">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h3 class="title">Sản phẩm tương tự</h3>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-lg-12">
                    <div class="feature-slider">
                        <?php
                        $count = count($similar_product);
                        for ($i = 0; $i < $count; $i++) {
                            $row = $similar_product[$i];
                            $id = $row['id_product'];
                            $name = $row['name'];
                            $price = $row['price'];
                            $discount = $row['discount'];
                            $ranking = $row['ranking'];
                            $image = $row['image'];

                            if ($id == $product_detail['id_product']) {
                                continue;
                            }
                        ?>
                            <div class="mt-4 pt-2">
                                <div class="solution border rounded position-relative px-4 py-5 ">
                                    <div class="product-wrapper">
                                        <div class="product">
                                            <!-- Thumb Start  -->
                                            <div class="thumb product-inner" id="product<?php echo $id ?>">
                                                <a class="image cursor-pointer" onclick="loadDetailProduct(<?php echo $id ?>)">
                                                    <img class="fit-image rounded" src="<?php echo _CDN_IMAGE_250 . '/products/' . $image ?>" />
                                                </a>
                                                <?php
                                                if ($discount > 0) {
                                                    $discount_price = $price - ($price * $discount / 100);
                                                ?>
                                                    <span class="badges">
                                                        <span class='sale'>-<?php echo (int)$discount ?>%</span>
                                                    </span>
                                                <?php
                                                }
                                                ?>
                                                <div class="action-wrapper" id="wrapper<?php echo $id ?>">
                                                    <a class="action cursor-pointer" title="Thêm sản phẩm"><i class="fa-duotone fa-plus-large" onclick="addProductCart('<?php echo $id?>', 1)"></i></a>
                                                    <a class="action wishlist" title="Wishlist"><i class="fa-duotone fa-heart"></i></a>
                                                    <a class="nav-content cursor-pointer action cart" id="viewcart" title="Cart"><i class="fa-duotone fa-cart-circle-plus"></i></a>
                                                </div>
                                            </div>
                                            <!-- Thumb End  -->

                                            <!-- Content Start  -->
                                            <div class="content">
                                                <h5 class="title"><?php echo $name ?></a></h5>
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
                                            <!-- Content End  -->
                                        </div>
                                    </div>
                                    <!-- Product End -->
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Section End -->

<script src="<?php echo _WEB_ROOT; ?>/assets/js/custom/product_detail.js"></script>