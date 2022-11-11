<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="card">
            <div class="row g-0">
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

                $price = number_format($price, 0, ',', '.');
                $discount = (int) $discount;
                ?>
                <div class="col-md-4 border-end" data-aos="fade-right">
                    <img src="<?php echo _WEB_ROOT; ?>/assets/images/products/<?php echo $image ?>" class="img-fluid" style="padding: 5%" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title" data-aos="fade-down"><?php echo $name ?></h4>
                        <div class="d-flex gap-3 py-3" data-aos="fade-down">
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
                            <div class="text-success"><i class='bx bxs-cart-alt align-middle'></i> 13 đơn hàng</div>
                        </div>
                        <div class="mb-3">
                            <!-- add input price -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text price">Giá Tiền</span>
                                        <input type="text" class="form-control" value="<?php echo $price ?>">
                                        <span class="input-group-text">đ</span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Tồn kho</span>
                                        <input type="text" class="form-control" value="<?php echo $quantity ?>">
                                        <span class="input-group-text">cái</span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Giám giá</span>
                                        <input type="text" class="form-control" value="<?php echo $discount ?>">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- add textarea -->

                        <div class="col-md-12" data-aos="fade-up">
                            <textarea id="mytextarea" name="mytextarea"><?php echo $description ?></textarea>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 mx-auto">
                                <button class="btn btn-primary px-5 hover-style" type="button">
                                    <i class='bx bxs-edit'></i>
                                    Cập Nhật
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <h6 class="text-uppercase mb-0">Sản phẩm liên quan</h6>
        <hr />
        <div class="row row-cols-1 row-cols-lg-3 product-grid feature-slider" data-aos="fade-up">
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

                $discount = (int) $discount;
                if ($discount > 0) {
                    $discount_price = $price - ($price * $discount / 100);
                    $discount_price = number_format($discount_price, 0, ',', '.') . 'đ';
                }

                $price = number_format($price, 0, ',', '.') . 'đ';

                if ($id == $product_detail['id_product']) {
                    continue;
                }
            ?>
                <div class="col">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4 cursor-pointer" onclick="loadProductDetail(<?php echo $id ?>)">
                                <img src="<?php echo _WEB_ROOT; ?>/assets/images/products/<?php echo $image ?>" class="img-fluid" alt="..." style="padding: 5%">
                            </div>
                            <div class="position-absolute top-0 end-0 m-3 product-discount text-danger bg-light.bg-gradient fw-bold">
                                <span style="font-size: 1.2rem;">-<?php echo $discount?>%</span>
                            </div>

                            <div class="col-md-8">
                                <div class="card-body">
                                    <a class="card-title cursor-pointer fw-semibold" onclick="loadProductDetail(<?php echo $id ?>)"><?php echo $name ?></a>
                                    <!-- <h6 class="card-title cursor-pointer"><?php echo $name ?></h6> -->
                                    <div class="cursor-pointer my-2">
                                        <?php
                                        $tempRank = $ranking;
                                        for ($j = 0; $j < 5; $j++) {
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
                                    <div class="clearfix">
                                        <p class="mb-0 float-start fw-bold"><span class="me-2 text-decoration-line-through text-secondary"><?php echo $price ?></span><span><?php echo $discount_price ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </div>
</div>
<!--end page wrapper -->

<script src="<?php echo _WEB_ROOT; ?>/assets/admin/js/custom/product_detail.js"></script>