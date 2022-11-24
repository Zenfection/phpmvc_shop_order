<?php
if ((int)$total_product_order > 0) {
    $noti_total_order = 'Số lượng đã bán: ' . $total_product_order;
} else {
    $noti_total_order = 'Sản phẩm chưa có người mua';
}
?>
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="card">
            <div class="row g-0">
                <?php
                $id = $product_detail['id_product'];
                $image = $product_detail['image'];
                $name = $product_detail['name'];
                $price = (int)$product_detail['price'];
                $discount = (int)$product_detail['discount'];
                $ranking = $product_detail['ranking'];
                $description = $product_detail['description'];
                $quantity = $product_detail['quantity'];
                $id_category = $product_detail['id_category'];

                ?>
                <div class="col-md-4 border-end" data-aos="fade-right">
                    <img src="<?php echo _CDN_IMAGE_500 . '/products/' . $image ?>" class="img-fluid" style="padding: 5%" alt="...">
                </div>
                <div class="col-md-8 card">
                    <form class="card-body" id="editProductForm" novalidate>
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>" require>
                        </div>
                        <div class="d-flex gap-3 py-3" data-aos="fade-down">
                            <div class="cursor-pointer">
                            <?php rating($ranking, 'fa-solid fa-star text-warning fa-xl', 'fa-duotone fa-star-half-stroke text-warning fa-xl', 'fa-solid fa-star text-secondary fa-xl') ?>
                            </div>
                            <div class="text-success"><i class='bx bxs-cart-alt align-middle font-24'></i><?php echo $noti_total_order; ?></div>
                        </div>
                        <div class="mb-3">
                            <!-- add input price -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text price">Giá Tiền</span>
                                        <input type="text" class="form-control" id="price" name="price" value="<?php echo number_format($price, 0, ',', '.') ?>">
                                        <span class="input-group-text">đ</span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Tồn kho</span>
                                        <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $quantity ?>">
                                        <span class="input-group-text">cái</span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Giám giá</span>
                                        <input type="text" class="form-control" id="discount" name="discount" value="<?php echo $discount ?>">
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
                                <button class="btn btn-primary px-5 hover-style" id="submitEditProduct" type="button" onclick="editProduct(<?php echo $id_product ?>)">
                                    <i class='bx bxs-edit'></i>
                                    Cập Nhật
                                </button>
                            </div>
                        </div>
                    </form>
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
                }

                if ($id == $product_detail['id_product']) {
                    continue;
                }
            ?>
                <div class="col">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4 cursor-pointer" onclick="loadProductDetail(<?php echo $id ?>)">
                                <img src="<?php echo _CDN_IMAGE_150 . '/products/' . $image ?>" class="img-fluid" alt="..." style="padding: 5%">
                            </div>
                            <div class="position-absolute top-0 end-0 m-3 product-discount text-danger bg-light.bg-gradient fw-bold">
                                <span style="font-size: 1.2rem;">-<?php echo $discount ?>%</span>
                            </div>

                            <div class="col-md-8">
                                <div class="card-body">
                                    <a class="card-title cursor-pointer fw-semibold" onclick="loadProductDetail(<?php echo $id ?>)"><?php echo $name ?></a>
                                    <!-- <h6 class="card-title cursor-pointer"><?php echo $name ?></h6> -->
                                    <div class="cursor-pointer my-2">
                                        <?php rating($ranking, 'fa-solid fa-star text-warning', 'fa-duotone fa-star-half-stroke text-warning', 'fa-solid fa-star text-secondary') ?>
                                    </div>
                                    <div class="clearfix">
                                        <p class="mb-0 float-start fw-bold"><span class="me-2 text-decoration-line-through text-secondary"><?php echo number_price($price) ?></span><span><?php echo number_price($discount_price) ?></span></p>
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