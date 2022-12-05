<?php
if (!empty($msg)) {
    $type_msg = $msg['type'];
    $icon_msg = $msg['icon'];
    $pos_msg = $msg['position'];
    $content_msg = $msg['content'];
    echo "<script>notify('$type_msg', '$icon_msg', '$pos_msg', '$content_msg')</script>";
}
?>
<!-- My Account Section Start -->
<div class="section section-margin">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" data-aos="fade-in" data-aos-duration="1000">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <div class="row">
                        <!-- My Account Tab Menu Start -->
                        <div class="col-lg-3 col-md-4">
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a href="#dashboard" class="active" data-bs-toggle="tab"><i class="fa-duotone fa-grid-horizontal"></i>
                                    Dashboard</a>
                                <a href="#orders" data-bs-toggle="tab"><i class="fa-duotone fa-cart-flatbed-boxes"></i> Đơn Hàng</a>
                                <a href="#payment-method" data-bs-toggle="tab"><i class="fa-duotone fa-credit-card"></i> Thanh Toán</a>
                                <a href="#account-info" data-bs-toggle="tab"><i class="fa-duotone fa-user-pen"></i> Chi Tiết</a>
                                <a href="#address-edit" data-bs-toggle="tab"><i class="fa-duotone fa-key-skeleton"></i> Mật Khẩu</a>
                                <a href="/account/logout"><i class="fa-duotone fa-arrow-right-from-bracket"></i> Đăng Xuất</a>
                            </div>
                        </div>
                        <!-- My Account Tab Menu End -->

                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="myaccountContent">

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3 class="title">Dashboard</h3>
                                        <div class="welcome">
                                            <?php
                                            echo "<p>Xin chào <strong>$fullname</strong></p>";
                                            ?>
                                        </div>

                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="orders" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3 class="title">
                                            Đơn Hàng
                                        </h3>
                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Mã Đơn</th>
                                                        <th>Ngày Đặt Hàng</th>
                                                        <th>Trạng Thái</th>
                                                        <th>Tổng Tiền</th>
                                                        <th>Chi Tiết</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (!empty($getOrder)) {
                                                        $count = count($getOrder);
                                                        if ($count == 0) {
                                                            echo "<p class='saved-message'>Hiện bạn chưa đặt đơn hàng nào !!!</p>";
                                                        } else {
                                                            for ($i = 0; $i < $count; $i++) {
                                                                $id_order = $getOrder[$i]['id_order'];
                                                                $order_date = $getOrder[$i]['order_date'];
                                                                $status = $getOrder[$i]['status'];
                                                                $total_money = $getOrder[$i]['total_money'];
                                                    ?>
                                                                <tr id="id_order<?php echo $id_order ?>">
                                                                    <td><?php echo $id_order ?></td>
                                                                    <td><?php echo $order_date ?></td>
                                                                    <td><?php echo $status ?></td>
                                                                    <td><?php echo number_price($total_money) ?></td>
                                                                    <td><a class="btn btn btn-dark btn-hover-primary btn-sm rounded" href="/account/order/<?php echo $id_order ?>">Xem</a></td>
                                                                </tr>
                                                    <?php
                                                            }
                                                        }
                                                    };
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3 class="title">Phương thức thanh toán</h3>
                                        <p class="saved-message">Hiện chưa phát triển tính năng này !!!</p>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="account-info" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3 class="title"> Chi Tiết Tài Khoản</h3>
                                        <div class="account-details-form">
                                            <form id="changeInfoForm" novalidate>
                                                <div class="single-input-item m-b-15">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item m-b-15">
                                                                <label for="full-name" class="required m-b-10">Họ và Tên</label>
                                                                <input type="text" id="fullname" name="fullname" placeholder="Nhập họ và tên" value="<?php echo $fullname ?>" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item m-b-15">
                                                                <label for="last-name" class="required m-b-10">Số điện thoại</label>
                                                                <input type="text" id="phone" name="phone" placeholder="Chưa có số điện thoại" value="<?php echo $phone ?>" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="single-input-item m-b-15">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item m-b-15">
                                                                <label for="display-name" class="required m-b-10">UserName</label>
                                                                <input readonly class="form-control" type='text' id='display-name' placeholder='<?php echo $user ?>' />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item m-b-15">
                                                                <label for="email" class="required m-b-10">Email</label>
                                                                <input type="email" class="form-control" name="email" id="email" placeholder="Nhập Email" value="<?php echo $email ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="single-input-item m-b-15">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="checkout-form-list">
                                                                <label for="province" class="form-label">Tỉnh Thành</label>
                                                                <select class="nice-select" id="province" name="province" onchange="loadCity()">
                                                                    <?php
                                                                    if ($province != "") {
                                                                        echo "<option value='" . $province . "' selected>" . $province . "</option>";
                                                                    }
                                                                    foreach ($province_data as $key => $value) {
                                                                        if ($value['name'] != $province) {
                                                                            echo "<option value='" . $value['name'] . "'>" . $value['name'] . "</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="checkout-form-list">
                                                                <label for="city" class="form-label">Thành phố/Quận/Huyện</label>
                                                                <select class="nice-select" id="city" name="city" onchange="loadWard()">
                                                                    <?php
                                                                    if ($city != "") {
                                                                        echo "<option value='" . $city . "' selected>" . $city . "</option>";
                                                                    }
                                                                    foreach ($city_data as $key => $value) {
                                                                        if ($value['full_name'] != $city) {
                                                                            echo "<option value='" . $value['name'] . "'>" . $value['full_name'] . "</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="checkout-form-list">
                                                                <label for="ward" class="form-label">Phường/Xã</label>
                                                                <select class="nice-select" id="ward" name="ward">
                                                                    <?php
                                                                    if ($ward != "") {
                                                                        echo "<option value='" . $ward . "' selected>" . $ward . "</option>";
                                                                    }
                                                                    foreach ($ward_data as $key => $value) {
                                                                        if ($value['name'] != $city) {
                                                                            echo "<option value='" . $value['name'] . "'>" . $value['full_name'] . "</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="single-input-item m-b-15">
                                                    <label for="address" class="required m-b-5">Địa Chỉ</label>
                                                    <input type="text" name="address" id="address" placeholder="Nhập địa chỉ" value="<?php echo $address ?>" class="form-control" />
                                                </div>
                                                <div class="single-input-item single-item-button m-t-30">
                                                    <button type="button" class="btn btn btn-primary btn-hover-dark rounded-0">Lưu Thay Đổi</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3 class="title"> Thay đổi mật khẩu</h3>
                                        <div class="account-details-form">
                                            <form id="changePassForm" novalidate>
                                                <fieldset>
                                                    <div class="single-input-item m-b-15">
                                                        <label for="current_pwd" class="required m-b-10">Mật Khẩu Hiện tại</label>
                                                        <input type="password" name="current_pwd" id="current_pwd" placeholder="Nhập Mật Khẩu" class="form-control" />
                                                    </div>
                                                    <div class="row m-b-n15">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item m-b-15">
                                                                <label for="new_pwd" class="required m-b-10">Mật khẩu mới</label>
                                                                <input type="password" name="new_pwd" id="new_pwd" placeholder="Nhập Mật Khẩu" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item m-b-15">
                                                                <label for="confirm_pwd" class="required m-b-10">Xác Nhận Mật Khẩu</label>
                                                                <input type="password" name="confirm_pwd" id="confirm_pwd" placeholder="Nhập Mật Khẩu" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <div class="single-input-item single-item-button m-t-30">
                                                    <button type="button" class="btn btn btn-primary btn-hover-dark rounded-0">Lưu Thay Đổi</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                            </div>
                        </div>
                        <!-- My Account Tab Content End -->
                    </div>
                </div>
                <!-- My Account Page End -->
            </div>
        </div>
    </div>
</div>
<!-- My Account Section End -->

<script src="<?php echo _WEB_ROOT; ?>/assets/js/custom/account.js"></script>

<style>
    select.nice-select {
        display: none !important;
    }

    .nice-select {
        display: block !important;
        width: 100% !important;
        padding: 0.375rem 2.25rem 0.375rem 0.75rem !important;
        font-size: 1rem !important;
        font-weight: 400 !important;
        line-height: 1.5 !important;
        color: #212529 !important;
        border: 1px solid #ced4da !important;
        background-color: #fff !important;
    }

    .nice-select:focus {
        border-color: #80bdff !important;
        outline: 0 !important;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
    }
</style>