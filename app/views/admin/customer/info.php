<?php
$username = $user_data['username'];
$fullname = $user_data['fullname'];
$email = $user_data['email'];
$phone = $user_data['phone'];
$address = $user_data['address'];
$province = $user_data['province'];
$city = $user_data['city'];
$ward = $user_data['ward'];
?>
<div class="page-wrapper">
    <div class="page-content">
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card radius-10 w-100 overflow-hidden" data-aos="fade-right">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="<?php echo _WEB_ROOT; ?>/assets/admin/images/avatars/user.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                    <div class="mt-3" id="userThumbnail">
                                        <h4><?php echo $fullname ?></h4>
                                        <p class="text-secondary mb-1"><?php echo $email ?></p>
                                        <p class="text-secondary mb-1">
                                            <i class="fa-duotone fa-phone-volume me-1 fa-lg"></i>
                                            <?php echo $phone ?>
                                        </p>
                                        <p class="text-muted font-size-sm"><?php echo $address ?></p>
                                    </div>
                                </div>
                                <hr class="my-4">
                            </div>
                        </div>
                        <div class="card radius-10 w-100 overflow-hidden" data-aos="fade-right">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h5 class="mb-1">Tổng quan</h5>
                                    </div>
                                    <div class="font-22 ms-auto"><i class='fa-duotone fa-ellipsis'></i>
                                    </div>
                                </div>
                            </div>

                            <div class="px-4">
                                <div class="card mt-3 radius-10 border shadow-none">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <p class="mb-0 text-secondary">Tổng Đơn Hàng</p>
                                                <h4 class="mb-0"><?php echo $count_ordered ?></h4>
                                            </div>
                                            <div class="widgets-icons bg-light-primary text-primary ms-auto"><i class='fa-duotone fa-shopping-bag'></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card radius-10 border shadow-none">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <p class="mb-0 text-secondary">Tổng Tiền Đã Mua</p>
                                                <h4 class="mb-0"><?php echo number_price($total_money_order) ?></h4>
                                            </div>
                                            <div class="widgets-icons bg-light-warning text-warning ms-auto"><i class='fa-duotone fa-coins'></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card radius-10 border shadow-none">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <p class="mb-0 text-secondary">Tổng sản phẩm đã xem</p>
                                                <h4 class="mb-0"><?php echo $total_recent_product ?></h4>
                                            </div>
                                            <div class="widgets-icons bg-light-success text-success ms-auto"><i class='fa-duotone fa-eye'></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <form class="card" id="changeUserInfoForm" novalidate>
                            <div class="card-body" data-aos="fade-left">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="fullname" class="form-label">Họ Và Tên</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nhập tên khách hàng" value="<?php echo $fullname ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Nhập tên khách hàng" value="<?php echo $email ?>">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="phone" class="form-label">Số điện thoại</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập tên khách hàng" value="<?php echo $phone ?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
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
                                                    echo "<option value='" . $value['full_name'] . "'>" . $value['full_name'] . "</option>";
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
                                                    echo "<option value='" . $value['full_name'] . "'>" . $value['full_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <label for="address" class="form-label">Địa Chỉ Cụ Thể</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Nhập tên khách hàng" value="<?php echo $address ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-8 text-secondary">
                                        <input type="button" class="btn btn-primary px-4" value="Lưu Thay Đổi" onclick="changeUserInfo('<?php echo $username ?>')" />
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col">
                                <div class="card radius-10 mb-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h5 class="mb-1">Đơn Hàng Đã Đặt</h5>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table mb-0" id="list_order_user">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th><i class="fa-duotone fa-fingerprint me-1"></i>Mã Đơn#</th>
                                                        <th><i class="fa-duotone fa-box-taped me-1"></i>Trạng Thái</th>
                                                        <th><i class="fa-duotone fa-coins me-1"></i>Tổng Tiền</th>
                                                        <th><i class="fa-duotone fa-calendar me-1"></i>Ngày Đặt</th>
                                                        <th><i class="fa-duotone fa-eye me-1"></i>Chi Tiết</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($order as $key => $value) {
                                                        $id = $value['id_order'];
                                                        $status = $value['status'];
                                                        // pending, shipping, delivered, canceled
                                                        $total = (float)$value['total_money'];
                                                        $date = $value['order_date'];
                                                        $statusVie = ["Đang xử lý", "Đang giao hàng", "Đã giao hàng", "Đã hủy"];
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="ms-2">
                                                                        <h6 class="mb-0 font-14"><?php echo $id ?></h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if (($status == 'pending')) {
                                                                ?>
                                                                    <div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3">
                                                                        <i class="fa-duotone fa-box-taped me-1 fa-lg"></i><?php echo $statusVie[0] ?>
                                                                    </div>
                                                                <?php
                                                                } else if (($status == 'shipping')) {
                                                                ?>
                                                                    <div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3">
                                                                        <i class="fa-duotone fa-truck-fast me-1 fa-lg"></i><?php echo $statusVie[1] ?>
                                                                    </div>
                                                                <?php
                                                                } else if (($status == 'delivered')) {
                                                                ?>
                                                                    <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                                                        <i class="fa-duotone fa-person-carry-box me-1 fa-lg"></i><?php echo $statusVie[2] ?>
                                                                    </div>
                                                                <?php
                                                                } else if (($status == 'canceled')) {
                                                                ?>
                                                                    <div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                                                                        <i class="fa-duotone fa-ban me-1 fa-lg"></i><?php echo $statusVie[3] ?>
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php echo number_price($total) ?></td>
                                                            <td><?php echo $date ?></td>
                                                            <td>
                                                                <div class="d-flex font-18">
                                                                    <a href="javascript:;" class="ms-3 badge rounded-pill text-primary bg-light-primary" onclick="loadOrderDetail('<?php echo $id ?>')">Xem
                                                                        <i class='fa-duotone fa-eye fa-lg'></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo _WEB_ROOT; ?>/assets/admin/js/custom/user_info.js"></script>

<style>
    .nice-select-dropdown {
        width: 100% !important;
    }

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
        border-radius: 0.375rem !important;
    }

    .nice-select:focus {
        border-color: #80bdff !important;
        outline: 0 !important;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
    }
</style>