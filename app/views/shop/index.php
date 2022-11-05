<!-- Shop Section Start -->
<div class="section section-margin">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9 col-12" id="shop-content" data-aos="fade-in" data-aos-duration="500">
                <!--shop toolbar start-->
                <div class="shop_toolbar_wrapper flex-column flex-md-row p-2 m-b-40 border">
                    <!-- Shop Top Bar Left start -->
                    <div class="shop-top-bar-left">
                        <div class="shop_toolbar_btn">
                            <button data-role="grid_3" type="button" class="btn-grid-3 active" title="Grid">
                                <i class="fa-duotone fa-grid-dividers"></i>
                            </button>
                            <button data-role="grid_list" type="button" class="btn-list" title="List">
                                <i class="fa-duotone fa-align-justify"></i>
                            </button>
                        </div>
                        <div class="shop-top-show">
                            <?php
                            $total = count($product);
                            echo "<span>Tổng cộng có $total sản phẩm</span>";
                            ?>
                        </div>
                    </div>
                    <!-- Shopt Top Bar Right Start -->
                    <div class="shop-top-bar-right">
                        <h4 class="title m-r-10">Sắp Xếp: </h4>
                        <div class="shop-short-by">
                            <select class="nice-select" aria-label=".form-select-sm example" onchange="filterShop('<?php echo $current_category?>', 'check', 1, '<?php echo $keyword?>')">
                                <option <?php if ($current_sortby == 'default') echo 'selected' ?> value="default" data-display="Select">Mặc Định</option>
                                <option <?php if ($current_sortby == 'selling') echo 'selected' ?> value="selling">Bán chạy</option>
                                <option <?php if ($current_sortby == 'price_asc') echo 'selected' ?> value="price_asc">Giá tăng dần</option>
                                <option <?php if ($current_sortby == 'price_desc') echo 'selected' ?> value="price_desc">Giá giảm dần</option>
                                <option <?php if ($current_sortby == 'best_discount') echo 'selected' ?> value="best_discount">Giảm giá nhiều</option>
                            </select>
                        </div>
                    </div>
                    <!-- Shopt Top Bar Right End -->
                    <!-- Shop Top Bar Left end -->
                </div>
                <!--shop toolbar end-->

                <!-- Shop Wrapper Start -->
                <div id="product-content">
                    <?php
                    // merge $total into $data array
                    $data = array_merge($data, ['total' => $total]);
                    $this->render('shop/product_content', $data)
                    ?>
                </div>
                <!-- Shop Wrapper End -->

                <!--shop toolbar end-->
            </div>
            <div class="col-lg-3 col-12">
                <!-- Sidebar Widget Start -->
                <aside class="sidebar_widget m-t-50 mt-lg-0">
                    <div class="widget_inner">
                        <div class="widget-list m-b-50">
                            <div class="search-box">
                                <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" aria-label="Nhập tên sản phẩm" id="searchFilterProduct" style="font-size: 14px;" value="<?php echo $keyword ?>">
                                <button class="search-icon" type="button">
                                    <i class="fa-duotone fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                        <div class="widget-list m-b-50">
                            <h3 class="widget-title m-b-30">Danh Mục</h3>
                            <div class="sidebar-body justify-content-start">
                                <ul class="sidebar-list product-tab-nav">
                                    <li>
                                        <a onclick="filterShop('all', '<?php echo $current_sortby ?>', 1,'<?php echo $keyword ?>')" class="cursor-pointer <?php if ($current_category == 'all') echo 'active' ?>" id="all">
                                            <i class="fa-duotone fa-border-all fa-xl"></i> Tất cả sản phẩm</a>
                                    </li>
                                    <?php
                                    foreach ($category as $key => $value) {
                                        $categoryFilter = $value['id_category'];
                                        $nameCategory = $value['title'];
                                    ?>
                                        <li>
                                            <a onclick="filterShop('<?php echo $categoryFilter ?>','<?php echo $current_sortby ?>',1,'<?php echo $keyword ?>')" class="cursor-pointer <?php echo ($current_category == $categoryFilter) ? 'active' : '' ?>" id="<?php echo $categoryFilter ?>">
                                                <?php
                                                if ($categoryFilter == 'cake')
                                                    echo '<i class="fa-duotone fa-cake-slice fa-xl"></i>';
                                                else if ($categoryFilter == 'candy')
                                                    echo '<i class="fa-duotone fa-lollipop fa-xl"></i>';
                                                else if ($categoryFilter == 'fastfood')
                                                    echo '<i class="fa-duotone fa-burger-fries fa-xl"></i>';
                                                else if ($categoryFilter == 'fruit')
                                                    echo '<i class="fa-duotone fa-cherries fa-xl"></i>';
                                                else if ($categoryFilter == 'icecream')
                                                    echo '<i class="fa-duotone fa-ice-cream fa-xl"></i>';

                                                echo $nameCategory . " ($count_category[$categoryFilter])"
                                                ?>
                                            </a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!-- Recent Product User -->
                        <?php $this->render('shop/recent_product', $data) ?>
                    </div>
                </aside>
                <!-- Sidebar Widget End -->
            </div>
        </div>
    </div>
</div>
<!-- Shop Section End -->

<script src="<?php echo _WEB_ROOT; ?>/assets/js/custom/shop.js"></script>