<!-- Contact Us Section Start -->
<div class="section section-margin">
    <div class="container">

        <div class="row m-b-n50">
            <div class="col-12 col-lg-6 m-b-50 order-2 order-lg-1" data-aos="fade-right" data-aos-duration="1000">

                <!-- Section Title Start -->
                <div class="contact-title p-b-15">
                    <h2 class="title">Gửi yêu cầu</h2>
                </div>
                <!-- Section Title End -->

                <!-- Contact Form Wrapper Start -->
                <div class="contact-form-wrapper contact-form">
                    <form action="" id="contactForm" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-area m-b-20">
                                            <input class="input-item" type="text" placeholder="Họ Tên *" name="name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-area m-b-20">
                                            <input class="input-item" type="email" placeholder="Email *" name="email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="input-area m-b-20">
                                            <input class="input-item" type="text" placeholder="Chủ đề *" name="subject" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="input-area m-b-40">
                                            <textarea cols="30" rows="5" class="textarea-item" name="message" placeholder="Tin nhắn" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" id="submit" name="submit" class="btn btn-primary btn-hover-dark">Submit</button>
                                    </div>
                                    <p class="col-8 form-message mb-0"></p>

                                </div>
                            </div>
                        </div>
                    </form>
                    <p class="form-messege"></p>
                </div>
                <!-- Contact Form Wrapper End -->

            </div>
            <div class="col-12 col-lg-6 m-b-50 order-1 order-lg-2" data-aos="fade-left" data-aos-duration="1500">
                <!-- Section Title End -->
                <!-- Google Map Area Start -->
                <div class="google-map-area w-100">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.841518408663!2d105.76842661447657!3d10.029933692830634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0895a51d60719%3A0x9d76b0035f6d53d0!2zxJDhuqFpIGjhu41jIEPhuqduIFRoxqE!5e0!3m2!1svi!2s!4v1650011390597!5m2!1svi!2s" width="550" height="400" style="border-radius:10px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <!-- Google Map Area Start -->
            </div>
        </div>

    </div>
</div>
<!-- Contact us Section End -->

<script type="text/javascript">
    $(document).ready(() => {
        $('#contactForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                subject: {
                    required: true,
                    minlength: 3,
                    maxlength: 30
                },
                message: {
                    required: true,
                    minlength: 3,
                    maxlength: 300
                }
            },
            messages: {
                name: {
                    required: 'Vui lòng nhập họ tên',
                    minlength: 'Họ tên phải có ít nhất 3 ký tự'
                },
                email: {
                    required: 'Vui lòng nhập email',
                    email: 'Vui lòng nhập đúng định dạng email'
                },
                subject: {
                    required: 'Vui lòng nhập chủ đề',
                    minlength: 'Chủ đề phải có ít nhất 3 ký tự',
                },
                message: {
                    required: 'Vui lòng nhập tin nhắn',
                    minlength: 'Tin nhắn phải có ít nhất 3 ký tự',
                    maxlength: 'Tin nhắn không được quá 300 ký tự'
                },
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
</script>