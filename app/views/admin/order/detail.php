<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Chi Tiết Đơn <?php echo $order_detail['id_order']; ?></h5>
                <hr />
                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-4 d-flex" data-aos="zoom-in-right">
                            <div class="card radius-10 w-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6 class="font-weight-bold mb-0">Sản phẩm trong đơn hàng</h6>
                                        </div>
                                        <div class="dropdown ms-auto">
                                            <div class="cursor-pointer text-dark font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class="fa-duotone fa-ellipsis"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="best-selling-products p-3 mb-3">
                                    <?php
                                    foreach ($order_product as $key => $value) {
                                        $id = $value['id_product'];
                                        $name = $value['name'];
                                        $price = (float)$value['price'];
                                        $image = $value['image'];
                                        $description = $value['description'];
                                        $amount = (int)$value['amount'];
                                        $discount = (int)$value['discount'];
                                        $discount_price = $price - ($price * $discount / 100);
                                        $ranking = (float)$value['ranking'];
                                        $total = $amount * $discount_price;
                                    ?>
                                        <div class="d-flex align-items-center p-2">
                                            <div class="product-img">
                                                <img src="<?php echo _CDN_IMAGE_50 . '/products/' . $image ?>" class="p-1" />
                                            </div>
                                            <div class="ps-3">
                                                <h6 class="mb-0 font-weight-bold"><?php echo $name ?></h6>
                                                <p class="mb-0 text-secondary"><?php echo number_price($discount_price) ?> / Mua <?php echo $amount ?> cái</p>
                                            </div>
                                            <p class="ms-auto mb-0 text-purple"><?php echo number_price($total) ?></p>
                                            <hr>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <hr />

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 d-flex" data-aos="zoom-in-left">
                            <form id="editOrderForm" novalidate>
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <?php
                                        $countProduct = count($order_product);

                                        $name = $order_detail['name_customer'];
                                        $email = $order_detail['email_customer'];
                                        $phone = $order_detail['phone_customer'];
                                        $address = $order_detail['address_customer'];
                                        $province = $order_detail['province_customer'];
                                        $city = $order_detail['city_customer'];
                                        $ward = $order_detail['ward_customer'];
                                        $status = $order_detail['status'];
                                        $totalMoney = $order_detail['total_money'];
                                        $statusEng = ["pending", "shipping", "delivered", "canceled"];
                                        $statusVie = ["Đang xử lý", "Đang giao hàng", "Đã giao hàng", "Đã hủy"];
                                        ?>
                                        <div class="col-md-4">
                                            <label for="name_customer" class="form-label">Tên Khách Hàng</label>
                                            <input type="text" class="form-control" id="name_customer" name="name_customer" placeholder="Nhập tên khách hàng" value="<?php echo $name ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email_customer" class="form-label">Email Khách Hàng</label>
                                            <input type="text" class="form-control" id="email_customer" name="email_customer" placeholder="Nhập Email" value="<?php echo $email ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="phone_customer" class="form-label">SĐT Khách Hàng</label>
                                            <input type="text" class="form-control" id="phone_customer" name="phone_customer" placeholder="Nhập SĐT" value="<?php echo $phone ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="province" class="form-label">Tỉnh Thành</label>
                                            <select class="nice-select" id="province" name="province" onchange="loadCity()">
                                                <?php
                                                echo "<option value='" . $province . "' selected>" . $province . "</option>";
                                                foreach ($province_data as $key => $value) {
                                                    if ($value['name'] != $province) {
                                                        echo "<option value='" . $value['name'] . "'>" . $value['name'] . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="city" class="form-label">Thành phố/Quận/Huyện</label>
                                            <select class="nice-select" id="city" name="city" onchange="loadWard()">
                                                <?php
                                                echo "<option value='" . $city . "' selected>" . $city . "</option>";
                                                foreach ($city_data as $key => $value) {
                                                    if ($value['full_name'] != $city) {
                                                        echo "<option value='" . $value['name'] . "'>" . $value['full_name'] . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="ward" class="form-label">Phường/Xã</label>
                                            <select class="nice-select" id="ward" name="ward">
                                                <?php
                                                echo "<option value='" . $ward . "' selected>" . $ward . "</option>";
                                                foreach ($ward_data as $key => $value) {
                                                    if ($value['name'] != $city) {
                                                        echo "<option value='" . $value['name'] . "'>" . $value['full_name'] . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="address" class="form-label">Địa Chỉ Giao Hàng</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Nhập Địa Chỉ Giao Hàng" value="<?php echo $address ?>">
                                        </div>
                                        <div class="col-12">
                                            <label for="status" class="form-label">Cập Nhật Trạng Thái</label>
                                            <select class="nice-select" id="status" name="status">
                                                <?php
                                                for ($i = 0; $i < count($statusEng); $i++) {
                                                    if ($status == $statusEng[$i]) {
                                                        echo "<option value='" . $statusEng[$i] . "' selected>" . $statusVie[$i] . "</option>";
                                                        continue;
                                                    }
                                                    echo "<option value='" . $statusEng[$i] . "'>" . $statusVie[$i] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <div class="card radius-10">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <p class="mb-0 text-secondary">Tổng Sản Phẩm</p>
                                                            <h4 class="my-1"><?php echo $countProduct ?> món hàng</h4>
                                                        </div>
                                                        <div class="widgets-icons bg-light-warning text-warning ms-auto"><i class="fa-duotone fa-bag-shopping"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="card radius-10">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <p class="mb-0 text-secondary">Tổng Tiền</p>
                                                            <h4 class="my-1"><?php echo number_price($totalMoney) ?></h4>
                                                        </div>
                                                        <div class="widgets-icons bg-light-success text-success ms-auto"><i class="fa-duotone fa-coins"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="button" class="btn btn-primary" onclick="editOrder('<?php echo $order_detail['id_order'];?>')">Lưu Thay Đổi</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->

<script src="<?php echo _WEB_ROOT; ?>/assets/admin/js/custom/order_detail.js"></script>

<style>
    .nice-select-dropdown{
        width: 100% !important;
    }
    select.nice-select{
        display: none !important;
    }
    .nice-select{
        display: block !important;
        width: 100% !important;
        padding: 0.375rem 2.25rem 0.375rem 0.75rem !important;
        font-size: 1rem !important;
        font-weight: 400 !important;
        line-height: 1.5 !important;
        color: #212529 !important;
        border: 1px solid #ced4da !important;
        background-color: #fff !important;
        border-radius: 0.375rem !important;
    }
    .nice-select:focus{
        border-color: #80bdff !important;
        outline: 0 !important;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
    }
</style>