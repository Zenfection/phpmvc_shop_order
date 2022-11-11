<?php 
    $countSelling = count($top_product_selling);
    $countReview = count($top_product_ranking);
?>
<div class="row row-cols-1 row-cols-lg-2">
    <div class="col d-flex" data-aos="fade-up-right">
        <div class="card radius-10 w-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="font-weight-bold mb-0">Top <?php echo $countSelling; ?> sản phẩm bán chạy nhất</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <div class="cursor-pointer text-dark font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="best-selling-products p-3 mb-3">
                <?php
                foreach($top_product_selling as $key => $value){
                    $id = $value['id_product'];
                    $name = $value['name'];
                    $description = $value['description'];
                    $price = (float)$value['price'];
                    $discount = (int)$value['discount'];
                    $image = $value['image'];
                    $total_amount = (int)$value['total_amount'];
                    $discount_price = $price - ($price * $discount / 100);
                ?>
                    <div class="d-flex align-items-center p-2">
                        <div class="product-img cursor-pointer" onclick="loadProductDetail(<?php echo $id?>)">
                            <img src="/assets/images/products/<?php echo $image ?>" class="p-1" />
                        </div>
                        <div class="ps-3">
                            <h6 class="mb-0 font-weight-bold cursor-pointer" onclick="loadProductDetail(<?php echo $id?>)"><?php echo $name ?></h6>
                            <p class="mb-0 text-secondary"><?php echo $discount_price ?>$ / mua <?php echo $total_amount ?> cái</p>
                        </div>
                        <p class="ms-auto mb-0 text-purple" style="font-weight: bold;"><?php echo $discount_price * $total_amount ?>$</p>
                    </div>
                <?php
                }
                echo ($countSelling == 10) ? '<hr>': '';
                ?>
            </div>
        </div>
    </div>
    <div class="col d-flex" data-aos="fade-up-left">
        <div class="card radius-10 w-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="font-weight-bold mb-0">Top <?php echo $countReview;?> sản phẩn đánh giá cao nhất</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <div class="cursor-pointer text-dark font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="recent-reviews p-3 mb-3">
                <?php
                foreach($top_product_ranking as $key => $value){
                    $id = $value['id_product'];
                    $name = $value['name'];
                    $image = $value['image'];
                    $ranking = (int)$value['ranking'];
                    ?>
                    <div class="d-flex align-items-center p-2">
                        <div class="product-img cursor-pointer" onclick="loadProductDetail(<?php echo $id?>)">
                            <img src="/assets/images/products/<?php echo $image ?>" class="p-1" alt="" />
                        </div>
                        <div class="ps-3">
                            <h6 class="mb-0 font-weight-bold cursor-pointer" onclick="loadProductDetail(<?php echo $id?>)"><?php echo $name ?></h6>
                        </div>
                        <p class="ms-auto mb-0">
                            <?php
                            $temp = $ranking;
                            for ($j = 1; $j <= 5; $j++) {
                                if ($temp > 2) {
                                    echo "<i class='bx bxs-star text-warning mr-1'></i>";
                                    $temp -= 2;
                                } else if ($temp > 1) {
                                    echo "<i class='bx bxs-star-half text-warning mr-1'></i>";
                                    $temp = 0;
                                    break;
                                }
                            }
                            ?>
                        </p>
                    </div>
                    <?php 
                }
                echo ($countSelling == 10) ? '<hr>': '';
                ?>
            </div>
        </div>
    </div>
</div>