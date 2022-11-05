<?php
    if (!empty($data['msg'])) {
        $type_msg = $msg['type'];
        $icon_msg = $msg['icon'];
        $pos_msg = $msg['position'];
        $content_msg = $msg['content'];
        echo "<script>notify('$type_msg', '$icon_msg', '$pos_msg', '$content_msg');</script>";
    }
?>
<!-- start hero -->
<section class="hero-1 bg-white position-relative d-flex align-items-center justify-content-center overflow-hidden">
    <div class="shapes">
        <div class="shape-1"><img src="<?php echo _WEB_ROOT; ?>/assets/images/shapes/shape-1.svg" alt="shape"></div>
        <div class="shape-2"><img src="<?php echo _WEB_ROOT; ?>/assets/images/shapes/shape-2.svg" alt="shape"></div>
        <div class="shape-3"><img src="<?php echo _WEB_ROOT; ?>/assets/images/shapes/shape-3.svg" alt="shape"></div>
        <div class="shape-4"><img src="<?php echo _WEB_ROOT; ?>/assets/images/shapes/shape-4.svg" alt="shape"></div>
        <div class="shape-5"><img src="<?php echo _WEB_ROOT; ?>/assets/images/shapes/shape-5.svg" alt="shape"></div>
        <div class="shape-6"><img src="<?php echo _WEB_ROOT; ?>/assets/images/shapes/shape-6.svg" alt="shape"></div>
        <div class="shape-7"><img src="<?php echo _WEB_ROOT; ?>/assets/images/shapes/shape-7.svg" alt="shape"></div>
        <div class="shape-8"><img src="<?php echo _WEB_ROOT; ?>/assets/images/shapes/shape-8.svg" alt="shape"></div>
    </div>

    <div class="container">
        <div class="row align-items-center text-center text-lg-start">
            <div class="col-lg-6 mt-4 pt-2" data-aos="fade-in">
                <h6 class="text-primary mb-3 fw-hero">Được phát triển bởi
                    <a href="https://facebook.com/zenfection" target="_blank">
                        <u><i class="fa-duotone fa-at"></i>Zenfection</u>
                    </a>
                </h6>
                <h1 class="ml11 mb-2">
                    <span class="text-wrapper">
                        <span class="line line1"></span>
                        <span class="letters pb-0 fw-hero">Zen Shop Order</span>
                    </span>
                </h1>
                <h5 class="my-4 fw-hero"><i class="fa-duotone fa-phone-volume"></i> Liên hệ với tôi nếu bạn có ý tưởng</h5>

                <p class="text-muted mb-2 fw-hero">Sản phẩm được phát triển cả nhân nên có rất nhiều lỗi <br> nếu bạn phát hiện hãy liên hệ với tôi bên trên.</p>
                <?php
                if (!empty($user)) {
                ?>
                    <a class="cursor-pointer btn btn-primary mt-4" onclick="loadContent('shop')">Mua Hàng
                        <i class="fa-duotone fa-cart-shopping-fast fa-xl"></i>
                    </a>
                <?php
                } else {
                ?>
                    <a class="cursor-pointer btn btn-primary mt-4" onclick="loadContent('login')">Đăng Nhập
                        <i class="fa-duotone fa-arrow-right-to-bracket fa-xl"></i>
                    </a>
                <?php
                }
                ?>
            </div>
            <div class="col-lg-6 mt-lg-4 pt-2 mt-5 d-lg-flex d-none" data-aos="fade-left">
                <img class="fit-image" src="https://raw.githubusercontent.com/Zenfection/phpmvc_shop_order/main/assets/images/home.png" alt="home Image">
            </div>
        </div>
    </div>
    <!-- end container -->
</section>
<!-- end hero -->

<!-- start solution -->
<section class="service-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-12 mb-4">
                <h4 class="fw-semibold mb-3 fw-hero">Chức Năng Nổi Bật</h4>
                <h5 class="text-muted fw-normal fw-hero">Liệt kê các nổi bật trong trang web </h5>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-lg-12">
                <div class="feature-slider">
                    <div>
                        <div class="mt-4 pt-2">
                            <div class="solution border rounded position-relative px-4 py-5 ">
                                <div class="sw-1 mb-4 sol-icon">
                                    <i class="fa-duotone fa-rabbit-running fa-3x"></i>
                                </div>
                                <h5 class="lh-base fs-16 mb-2">Tốc độ ưu việt</h5>
                                <a class="text-muted">Không cần phải <span class="fw-semibold fs-15 text-dark">refresh</span> lại trang khi sử dụng</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mt-4 pt-2">
                            <div class="solution border rounded position-relative px-4 py-5">
                                <div class="sw-1 mb-4 sol-icon">
                                    <i class="fa-duotone fa-users-viewfinder fa-3x"></i>
                                </div>
                                <h5 class="lh-base fs-16 mb-2">Sử dụng đơn giản</h5>
                                <a class="text-muted">Thiết kế sử dụng dựa trên<span class="fw-semibold fs-15 text-dark"> trải nghiệm thực tế</span></a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mt-4 pt-2">
                            <div class="solution border rounded position-relative px-4 py-5">
                                <div class="sw-1 mb-4 sol-icon">
                                    <i class="fa-duotone fa-binary-lock fa-3x"></i>
                                </div>
                                <h5 class="lh-base fs-16 mb-2">Mã hóa mật khẩu</h5>
                                <a class="text-muted">Sử dụng <span class="fw-semibold fs-15 text-dark"> SHA516</span> để mã hóa mật khẩu của người dùng</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mt-4 pt-2">
                            <div class="solution border rounded position-relative px-4 py-5">
                                <div class="sw-1 mb-4 sol-icon">
                                    <i class="fa-duotone fa-fork-knife fa-3x"></i>
                                </div>
                                <h5 class="lh-base fs-16 mb-2">Hàng hóa đa dạng</h5>
                                <a class="text-muted">Mua bán nhiều sản phẩm và có thể<span class="fw-semibold fs-15 text-dark"> thêm mới</span></a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mt-4 pt-2">
                            <div class="solution border rounded position-relative px-4 py-5">
                                <div class="sw-1 mb-4 sol-icon">
                                    <i class="fa-duotone fa-filters fa-3x"></i>
                                </div>
                                <h5 class="lh-base fs-16 mb-2">Bộ lọc thông minh</h5>
                                <a class="text-muted">Bộ lọc sản phẩm do chính <span class="fw-semibold fs-15 text-dark"> Zen</span> phát triển</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mt-4 pt-2">
                            <div class="solution border rounded position-relative px-4 py-5">
                                <div class="sw-1 mb-4 sol-icon">
                                    <i class="fa-duotone fa-box-circle-check fa-3x"></i>
                                </div>
                                <h5 class="lh-base fs-16 mb-2">Xem lại đơn hàng</h5>
                                <a class="text-muted">Theo dõi <span class="fw-semibold fs-15 text-dark"> đơn hàng</span> cá nhân vừa đặt dễ dàng</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mt-4 pt-2">
                            <div class="solution border rounded position-relative px-4 py-5">
                                <div class="sw-1 mb-4 sol-icon">
                                    <i class="fa-duotone fa-basket-shopping fa-3x"></i>
                                </div>
                                <h5 class="lh-base fs-16 mb-2">Giỏ hàng thông minh</h5>
                                <a class="text-muted"><span class="fw-semibold fs-15 text-dark">Thêm, sửa, xóa</span> sản phẩm với hiệu suất nhanh chóng</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mt-4 pt-2">
                            <div class="solution border rounded position-relative px-4 py-5">
                                <div class="sw-1 mb-4 sol-icon">
                                    <i class="fa-duotone fa-eye-low-vision fa-3x"></i>
                                </div>
                                <h5 class="lh-base fs-16 mb-2">Không lấy dữ diệu</h5>
                                <a class="text-muted">Cam kết không lấy bất cứ<span class="fw-semibold fs-15 text-dark"> dữ liệu</span> của người dùng</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end solution -->

<!-- Category Section Start -->
<div class="section section-margin">
    <div class="container">
        <h2>Loại Đồ Ăn</h2>
        <!-- Banners Start -->
        <div class="row row-cols-md-3 row-cols-sm-2 row-cols-1 m-b-n30">
            <?php
            $countCategory = count($category);
            foreach($category as $key => $value){
                if($value['active'] != 1){
                    continue;
                }
                $id = $value['id_category'];
                $title = $value['title'];
                $image = $value['image'];
                ?>
                <div class="col m-b-30" data-aos="fade-in">
                    <a class="cursor-pointer banner hover-style" onclick="loadContent('shop/<?php echo $id?>')">
                        <img class="fit-image p-10" src="<?php echo _WEB_ROOT; ?>/assets/images/category/<?php echo $image?>" alt="Banner Image">
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
        <!-- Banners End -->
    </div>
</div>
<!-- Category Section End -->

<!-- Product Section Start -->
<div class="section position-relative">
    <div class="container">
        <!-- Section Title & Tab Start -->
        <div class="row">
            <!-- Tab Start -->
            <div class="col-12">
                <ul class="product-tab-nav nav justify-content-center m-b-n15 p-b-40 title-border-bottom">
                    <li class="nav-item m-b-15"><a class="nav-link active" data-bs-toggle="tab" href="#top-product-ranking">Đánh giá cao</a></li>
                    <li class="nav-item m-b-15"><a class="nav-link" data-bs-toggle="tab" href="#top-product-discount">Giảm giá nhiều</a></li>
                    <li class="nav-item m-b-15"><a class="nav-link" data-bs-toggle="tab" href="#top-product-seller">Sản phẩm mua nhiều</a></li>
                </ul>
            </div>
            <!-- Tab End -->
        </div>
        <!-- Section Title & Tab End -->

        <!-- Products Tab Start -->
        <div class="row">
            <div class="col-12">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="top-product-ranking">
                        <div class="row m-b-n40">
                            <?php
                            $this->render('products/list', $top_product_ranking, false);
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="top-product-discount">
                        <div class="row m-b-n40">
                            <?php
                            $this->render('products/list', $top_product_discount, false);
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="top-product-seller">
                        <div class="row m-b-n40">
                            <?php
                            $this->render('products/list', $top_product_seller, false);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Products Tab End -->
    </div>
</div>
<!-- Product Section End -->


<script src="<?php echo _WEB_ROOT; ?>/assets/js/custom/home.js"></script>