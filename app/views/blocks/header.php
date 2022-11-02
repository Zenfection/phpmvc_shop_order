<div class="header-bottom">
    <div class="header-sticky">
        <div class="container">
            <div class="row align-items-center position-relative">
                <!-- Header Logo Start -->
                <div class="col-lg-3 col-md-4 col-6" data-aos="fade-in" data-aos-duration="1000">
                    <div class="header-logo">
                        <a href="/"><img src="<?php echo _WEB_ROOT; ?>/assets/images/logo.png" alt="Site Logo" /></a>
                    </div>
                </div>
                <!-- Header Logo End -->

                <!-- Header Menu Start -->
                <div class="col-lg-5 d-none d-lg-block" data-aos="fade-in" data-aos-duration="1000">
                    <div class="main-menu">
                        <ul>
                            <!-- render session -->
                            <li><a id="home" class="cursor-pointer" onclick="loadContent('home')">Trang Chủ</a></li>
                            <li><a id="about" class="cursor-pointer" onclick="loadContent('about')">Giới Thiệu</a></li>
                            <li><a id="shop" class="cursor-pointer" onclick="loadContent('shop')">Shop</a></li>
                            <li><a id="contact" class="cursor-pointer" onclick="loadContent('contact')">Liên Hệ</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Header Menu End -->

                <!-- Header Action Start -->
                <div class="col-lg-4 col-md-8 col-6">
                    <div class="header-actions" id="header">
                        <!-- Header Action Start -->
                        <!-- Header Action Search Button Start -->
                        <div class="header-action-btn header-action-btn-search d-none d-md-flex">
                            <div class="action-execute">
                                <a class="action-search-open" href="javascript:void(0)"><i class="fa-duotone fa-magnifying-glass fa-xl"></i></a>
                                <a class="action-search-close" href="javascript:void(0)"><i class="fa-duotone fa-xmark fa-xl"></i></a>
                            </div>
                            <!-- Search Form and Button Start -->
                            <div class="header-search-form" id="searchProduct">
                                <input type="text" class="header-search-input" placeholder="Tìm kiếm" style="width: 200px !important">
                                <button class="header-search-button"><i class="fa-duotone fa-magnifying-glass"></i></button>
                            </div>
                            <!-- Search Form and Button End -->
                        </div>
                        <!-- Header Action Search Button End -->

                        <!-- account login -->
                        <?php
                        if (!empty($user)) {
                        ?>
                            <a id='account' class='nav-content cursor-pointer header-action-btn header-action-btn-wishlist' href="/account">
                                <i class='fa-duotone fa-user-gear fa-xl'></i>
                            </a>
                        <?php
                        } else {
                        ?>
                            <a id='logged' class='nav-content cursor-pointer header-action-btn header-action-btn-wishlist' href="/login">
                                <i class='fa-duotone fa-user fa-xl'></i>
                            </a>
                        <?php
                        }
                        ?>

                        <?php $this->render('blocks/cart', $data) ?>

                        <!-- Mobile Menu Hambarger Action Button Start -->
                        <a href="javascript:void(0)" class="header-action-btn header-action-btn-menu d-lg-none d-md-flex">
                            <i class="fa-duotone fa-bars fa-xl"></i>
                        </a>
                        <!-- Mobile Menu Hambarger Action Button End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
