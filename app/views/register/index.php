<?php
    if (!empty($data['msg'])) {
        $type_msg = $msg['type'];
        $icon_msg = $msg['icon'];
        $pos_msg = $msg['position'];
        $content_msg = $msg['content'];
        echo "<script>notify('$type_msg', '$icon_msg', '$pos_msg', '$content_msg')</script>";
    }
?>
<!-- Register Section Start -->
<div  data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
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
                            '<div class="single-input-item m-b-10">'.form_error('fullname', '<div class="alert-danger">', '</div>'),
                            'text',
                            'fullname',
                            'from-control',
                            'fullname', //? id  
                            'Họ và tên',
                            oldValue('fullname'),
                            '</div>'
                        );
                        HtmlHelper::input(
                            '<div class="single-input-item m-b-10">'.form_error('email', '<div class="alert-danger">', '</div>'),
                            'email',
                            'email',
                            'from-control',
                            'email', //? id
                            'Email',
                            oldValue('email'),
                            '</div>'
                        );
                        HtmlHelper::input(
                            '<div class="single-input-item m-b-10">'.form_error('username', '<div class="alert-danger">', '</div>'),
                            'text',
                            'username',
                            'from-control',
                            'username', //? id
                            'Tên đăng nhập',
                            oldValue('username'),
                            '</div>'
                        );
                        HtmlHelper::input(
                            '<div class="single-input-item m-b-10">'.form_error('password', '<div class="alert-danger">', '</div>'),
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
                        echo '<div>
                        <a href="/login" class="hover-text-primary">Đăng Nhập</a>
                    </div>';
                        HtmlHelper::formClose();
                        ?>
                        <!-- Form Action End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Register Section End -->
<!-- <script type="text/javascript">
    $(document).ready(() => {
        $('#registerForm').validate({
            rules: {
                fullname: {
                    required: true,
                    minlength: 5,
                },
                email: {
                    required: true,
                    email: true,
                    remote: './backend/check_email.php'
                },
                username: {
                    required: true,
                    minlength: 5,
                    maxlength: 50,
                    remote: './backend/check_user.php'
                },
                password: {
                    required: true,
                    minlength: 5,
                    maxlength: 50
                }
            },
            messages: {
                fullname: {
                    required: "Vui lòng nhập họ và tên",
                    minlength: "Họ và tên phải có ít nhất 5 ký tự"
                },
                email: {
                    required: "Vui lòng nhập email",
                    email: "Email không đúng định dạng",
                    remote: jQuery.validator.format('{0} đã tồn tại')
                },
                username: {
                    required: "Vui lòng nhập username",
                    minlength: "Username phải có ít nhất 5 ký tự",
                    maxlength: "Username không được vượt quá 50 ký tự",
                    remote: jQuery.validator.format('{0} đã tồn tại')
                },
                password: {
                    required: "Vui lòng nhập password",
                    minlength: "Password phải có ít nhất 5 ký tự",
                    maxlength: "Password không được vượt quá 50 ký tự"
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