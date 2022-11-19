<?php 
    if (!empty($msg)) {
        $type_msg = $msg['type'];
        $icon_msg = $msg['icon'];
        $pos_msg = $msg['position'];
        $content_msg = $msg['content'];
        echo "<script>notify('$type_msg', '$icon_msg', '$pos_msg', '$content_msg')</script>";
    }
?>
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-xl-2">
                                <a onclick="loadContent('add-product')" class="cursor-pointer btn btn-primary mb-3 mb-lg-0"><i class='bx bxs-plus-square'></i>Thêm Sản Phẩm</a>
                            </div>
                            <div class="col-lg-9 col-xl-10">
                                <div class="float-lg-end">
                                    <div class="row row-cols-lg-auto g-2">
                                        <div class="col-12">
                                            <div class="position-relative">
                                                <input type="text" id="searchProduct" class="form-control ps-5" placeholder="Tìm Sản Phẩm..." value="<?php echo $keyword?>"> 
                                                <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid">
            <?php
            $speed = 100;
            foreach($product as $key => $value){
                $id = $value['id_product'];
                $name = $value['name'];
                $price = (float)$value['price'];
                $image = $value['image'];
                $description = $value['description'];
                $quantity = (int)$value['quantity'];
                $discount = (int)$value['discount'];
                $discount_price = $price - ($price * $discount / 100);
                $ranking = (float)$value['ranking'];
                
                $speed += 100;
                if($speed == 1000 + 200) $speed = 100; 
                ?>
                <div class="col" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="<?php echo $speed?>">
                    <div class="card">
                        <?php if($quantity == 0) 
                            echo "<div class='ribbon bg-danger'>Đã bán hết</div>";
                        ?>
                        <div class="cursor-pointer" onclick="loadProductDetail(<?php echo $id?>)">
                            <img src="<?php echo _CDN_IMAGE_300 . '/products/' . $image ?>" class="card-img-top p-20" style="padding: 1.5rem">
                        </div>
                        <?php
                        if ($discount > 0) {
                            echo "<div class='position-absolute top-0 end-0 m-3 product-discount text-danger bg-light.bg-gradient fw-bold'>
                            <span>-$discount%</span>
                            </div>";
                        }
                        ?>
                        <div class="card-body">
                            <h6 class="card-title cursor-pointer"><?php echo $name ?></h6>
                            <div class="clearfix">
                                <p class="mb-0 float-start">Còn <strong><?php echo $quantity ?></strong></p>
                                <p class="mb-0 float-end fw-bold">
                                    <?php
                                    if ($discount > 0) {
                                        echo "<span class='me-2 text-decoration-line-through text-secondary'>$price$</span>";
                                    }
                                    ?>
                                    <span class="text-primary"><?php echo $discount_price ?>$</span>
                                </p>
                            </div>
                            <div class="d-flex align-items-center mt-3 fs-6">
                                <div class="cursor-pointer">
                                    <?php
                                    $tempRank = $ranking;
                                    for ($i = 0; $i < 5; $i++) {
                                        if ($tempRank > 2) {
                                            echo "<i class='bx bxs-star text-warning'></i>";
                                            $tempRank -= 2;
                                        } else if ($tempRank > 0) {
                                            echo "<i class='bx bxs-star-half text-warning'></i>";
                                            $tempRank = 0;
                                        } else {
                                            echo "<i class='bx bxs-star text-secondary'></i>";
                                        }
                                    }
                                    ?>
                                </div>
                                <p class="mb-0 ms-auto"><?php echo $ranking / 2 ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <!--end row-->
    </div>
</div>
<!--end page wrapper -->

<script src="<?php echo _WEB_ROOT; ?>/assets/admin/js/custom/product.js"></script>