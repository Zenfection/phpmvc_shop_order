<?php
    if (!empty($data['msg'])) {
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
                    <?php 
                        HtmlHelper::formOpen('post', '/login/validate', 'loginForm', 'has-validation');
                        HtmlHelper::input(
                            '<div class="single-input-item m-b-10">
                            <label for="description" class="form-label">Tài Khoản</label>'.form_error('username', '<div class="alert-danger">', '</div>'),
                            'text',
                            'username',
                            'from-control',
                            'username', //? id
                            'Email / Username',
                            oldValue('username'),
                            '</div>'
                        );
            
                        HtmlHelper::input(
                            '<div class="single-input-item m-b-10">
                            <label for="description" class="form-label">Mật Khẩu</label>'
                            .form_error('password', '<div class="alert-danger">', '</div>'),
                            'password',
                            'password',
                            'from-control',
                            'password', //? id
                            'Nhập mật khẩu',
                            oldValue('password'),
                            '</div>'
                        );
                        HtmlHelper::button(
                            '<div class="single-input-item m-b-15">
                            <div class="login-reg-form-meta m-b-n15">',
                            'button',
                            'Xác nhận',
                            'btn btn btn-gray-deep btn-hover-primary m-b-15',
                            '</div></div>'
                        );
                        echo '<div class="register">
                            <a href="register" id="register">Tạo tài khoản</a>
                        </div>';
                        HtmlHelper::formClose();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Section End -->