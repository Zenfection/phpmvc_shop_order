<?php
if (!empty($msg)) {
    $type_msg = $msg['type'];
    $icon_msg = $msg['icon'];
    $pos_msg = $msg['position'];
    $content_msg = $msg['content'];
    echo "<script>notify('$type_msg', '$icon_msg', '$pos_msg', '$content_msg')</script>";
}
?>
<!-- Login Section Start -->
<div class="section section-margin login" data-aos="fade-right">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-8 m-auto">
                <div class="login-wrapper">
                    <!-- Login Title & Content -->
                    <div class="section-content text-center m-b-30">
                        <h2 class="title m-b-10">Đăng nhập</h2>
                    </div>
                    <!-- Form Action  -->
                    <form method="post" action="/login/validate" id="loginForm" class="has-validate">
                        <div class="single-input-item m-b-10">
                            <label for="description" class="form-label">Tài Khoản</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="<?php echo oldValue('username')?>">
                        </div>
                        
                        <div class="single-input-item m-b-10">
                            <label for="description" class="form-label">Mật khẩu</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu..." value="<?php echo oldValue('password')?>">
                        </div>
                        <div class="single-input-item m-b-15">
                            <div class="login-reg-form-meta m-b-n15">
                                <button class="btn btn btn-gray-deep btn-hover-primary m-b-15" type="button" onclick="loginAccount()">Xác nhận</button>
                            </div>
                        </div>
                    </form>
                    <?php echo form_error('username', 
                        '<div class="alert alert-danger d-flex align-items-center">
                        <i class="fa-duotone fa-xmark fa-2xl bi flex-shrink-0 me-2"></i>', '</div>')?>
                    <?php echo form_error('password', 
                        '<div class="alert alert-danger d-flex align-items-center">
                        <i class="fa-duotone fa-xmark fa-2xl bi flex-shrink-0 me-2"></i>', 
                        '</div>')?>
                    
                    <div class="register">
                        <a class="cursor-pointer" id="register" onclick="loadContent('register')">Tạo tài khoản</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Section End -->