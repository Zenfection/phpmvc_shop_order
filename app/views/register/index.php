<?php
if (!empty($msg)) {
    $type_msg = $msg['type'];
    $icon_msg = $msg['icon'];
    $pos_msg = $msg['position'];
    $content_msg = $msg['content'];
    echo "<script>notify('$type_msg', '$icon_msg', '$pos_msg', '$content_msg')</script>";
}
?>
<!-- Register Section Start -->
<div data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
    <div class="section section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-8 m-auto">
                    <div class="login-wrapper">

                        <!-- Register Title & Content Start -->
                        <div class="section-content text-center m-b-30">
                            <h2 class="title m-b-10">Tạo tài khoản</h2>
                        </div>
                        <!-- Register Title & Content End -->

                        <!-- Form Action Start -->
                        <?php
                        HtmlHelper::formOpen('post', '/register/validate', 'registerForm', '');
                        HtmlHelper::input(
                            '<div class="single-input-item m-b-10">' . form_error('fullname', '<div class="alert-danger">', '</div>'),
                            'text',
                            'fullname',
                            'from-control',
                            'fullname', //? id  
                            'Họ và tên',
                            oldValue('fullname'),
                            '</div>'
                        );
                        HtmlHelper::input(
                            '<div class="single-input-item m-b-10">' . form_error('email', '<div class="alert-danger">', '</div>'),
                            'email',
                            'email',
                            'from-control',
                            'email', //? id
                            'Email',
                            oldValue('email'),
                            '</div>'
                        );
                        HtmlHelper::input(
                            '<div class="single-input-item m-b-10">' . form_error('username', '<div class="alert-danger">', '</div>'),
                            'text',
                            'username',
                            'from-control',
                            'username', //? id
                            'Tên đăng nhập',
                            oldValue('username'),
                            '</div>'
                        );
                        HtmlHelper::input(
                            '<div class="single-input-item m-b-10">' . form_error('password', '<div class="alert-danger">', '</div>'),
                            'password',
                            'password',
                            'from-control',
                            'password', //? id
                            'Mật khẩu',
                            '', //? oldValue
                            '</div>'
                        );
                        HtmlHelper::button(
                            '<div class="single-input-item single-input-item m-b-15">
                            <div class="login-reg-form-meta m-b-n15">',
                            'button',
                            'Đăng ký',
                            'btn btn btn-gray-deep btn-hover-primary m-b-15',
                            '</div></div>'
                        );
                        ?>
                        <div>
                            <a class="cursor-pointer hover-text-primary" onclick="loadContent('login')">Đăng Nhập</a>
                        </div>
                        <?php HtmlHelper::formClose();?>
                        <!-- Form Action End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>