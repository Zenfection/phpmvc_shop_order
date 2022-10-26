<?php
$fullname = $data['fullname'];
$email = $data['email'];
$phone = $data['phone'];
$address = $data['address'];
if (!empty($data['getOrder'])) {
    $getOrder = $data['getOrder'];
}

if (!empty($data['msg'])) {
    $msg = $data['msg'];
    $check = strtolower($msg);
    // check từ khoá
    if (str_contains($check, 'thành công')) {
        echo "<script>notify('success', 'fa-duotone fa-user-check', 'bottom', '$msg');</script>";
    } else if (str_contains($check, 'lỗi')) {
        echo "<script>notify('error', 'fa-duotone fa-user-xmark', 'center', '$msg');</script>";
    } else if (str_contains($check, 'đã thay đổi')) {
        echo "<script>notify('info', 'fa-duotone fa-user-check', 'center', '$msg');</script>";
    } else if(str_contains($check, 'không có gì thay đổi')) {
        echo "<script>notify('error', 'fa-duotone fa-user-xmark', 'center', '$msg');;</script>";
    }
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
                                                                    <td><?php echo $total_money ?>$</td>
                                                                    <td><a class="btn btn btn-dark btn-hover-primary btn-sm rounded" href="/account/order/<?php echo $id_order?>">Xem</a></td>
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
                                            <form id="changeInfoForm" method="post" action="/account/validate_change_info">
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
                                                    <label for="display-name" class="required m-b-10">UserName</label>
                                                    <input readonly type='text' id='display-name' placeholder='<?php echo $user ?>' />
                                                </div>
                                                <div class="single-input-item m-b-15">
                                                    <label for="email" class="required m-b-5">Email</label>
                                                    <input type="email" name="email" id="email" placeholder="Nhập Email" value="<?php echo $email ?>" class="form-control" />
                                                </div>
                                                <div class="single-input-item m-b-15">
                                                    <label for="address" class="required m-b-5">Địa Chỉ</label>
                                                    <input type="text" name="address" placeholder="Nhập địa chỉ" value="<?php echo $address ?>" class="form-control" />
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
                                            <form method="post" action="/account/validate_change_password" id="changePassForm">
                                                <fieldset>
                                                    <div class="single-input-item m-b-15">
                                                        <label for="current_pwd" class="required m-b-10">Mật Khẩu Hiện tại</label>
                                                        <input type="password" name="current_pwd" placeholder="Nhập Mật Khẩu" class="form-control" />
                                                    </div>
                                                    <div class="row m-b-n15">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item m-b-15">
                                                                <label for="new_pwd" class="required m-b-10">Mật khẩu mới</label>
                                                                <input type="password" name="new_pwd" placeholder="Nhập Mật Khẩu" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item m-b-15">
                                                                <label for="confirm_pwd" class="required m-b-10">Xác Nhận Mật Khẩu</label>
                                                                <input type="password" name="confirm_pwd" placeholder="Nhập Mật Khẩu" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <div class="single-input-item single-item-button m-t-30">
                                                    <button type="submit" class="btn btn btn-primary btn-hover-dark rounded-0">Lưu Thay Đổi</button>
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

<!-- <script>
    $(document).ready(() => {
        $('#changeInfoForm').validate({
            rules: {
                fullname: {
                    required: true,
                    minlength: 5,
                    maxlength: 50
                },
                phone: {
                    required: true,
                    minlength: 10,
                    maxlength: 11
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                fullname: {
                    required: "Vui lòng nhập họ và tên",
                    minlength: "Họ và tên phải có ít nhất 5 ký tự",
                    maxlength: "Họ và tên phải có nhiều nhất 50 ký tự"
                },
                phone: {
                    required: "Vui lòng nhập số điện thoại",
                    minlength: "Số điện thoại phải có ít nhất 10 ký tự",
                    maxlength: "Số điện thoại phải có nhiều nhất 11 ký tự"
                },
                email: {
                    required: "Vui lòng nhập email",
                    email: "Email không hợp lệ"
                }
            },
            errorElement: 'div',
            errorPlacement: (error, element) => {
                error.addClass('invalid-feedback');
                if (element.prop('type') === 'checkbox') {
                    error.insertAfter(element.siblings('label'));
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: (element, errorClass, validClass) => {
                $(element).addClass('is-invalid').removeClass('is-valid').show();
            },
            unhighlight: (element, errorClass, validClass) => {
                $(element).addClass('is-valid').removeClass('is-invalid').show();
            }
        })
        $('#changePassForm').validate({
            rules: {
                current_pwd: {
                    required: true,
                    minlength: 6,
                    maxlength: 50
                },
                new_pwd: {
                    required: true,
                    minlength: 6,
                    maxlength: 50
                },
                confirm_pwd: {
                    required: true,
                    minlength: 6,
                    maxlength: 50,
                    equalTo: "#new_pwd"
                }
            },
            messages: {
                current_pwd: {
                    required: "Vui lòng nhập mật khẩu hiện tại",
                    minlength: "Mật khẩu phải có ít nhất 6 ký tự",
                    maxlength: "Mật khẩu phải có nhiều nhất 50 ký tự"
                },
                new_pwd: {
                    required: "Vui lòng nhập mật khẩu mới",
                    minlength: "Mật khẩu phải có ít nhất 6 ký tự",
                    maxlength: "Mật khẩu phải có nhiều nhất 50 ký tự"
                },
                confirm_pwd: {
                    required: "Vui lòng nhập lại mật khẩu mới",
                    minlength: "Mật khẩu phải có ít nhất 6 ký tự",
                    maxlength: "Mật khẩu phải có nhiều nhất 50 ký tự",
                    equalTo: "Mật khẩu không trùng khớp"
                }
            },
            errorElement: 'div',
            errorPlacement: (error, element) => {
                error.addClass('invalid-feedback');
                if (element.prop('type') === 'checkbox') {
                    error.insertAfter(element.siblings('label'));
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: (element, errorClass, validClass) => {
                $(element).addClass('is-invalid').removeClass('is-valid').show();
            },
            unhighlight: (element, errorClass, validClass) => {
                $(element).addClass('is-valid').removeClass('is-invalid').show();
            }
        })
    });
</script> -->