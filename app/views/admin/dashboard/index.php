<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row row-cols-1 row-cols-lg-4">
            <div class="col-12 col-lg-3" data-aos="fade-right">
                <div class="card radius-10 bg-primary bg-gradient">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-white">Đơn Hàng</p>
                                <h4 class="my-1 text-white"><?php echo $count_order ?></h4>
                            </div>
                            <div class="text-white ms-auto font-35"><i class='bx bx-cart-alt'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3" data-aos="fade-right">
                <div class="card radius-10 bg-danger bg-gradient">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-white">Thu Nhập</p>
                                <h4 class="my-1 text-white"><?php echo $total_money_order ?>$</h4>
                            </div>
                            <div class="text-white ms-auto font-35"><i class='bx bx-dollar'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3" data-aos="fade-left">
                <div class="card radius-10 bg-success bg-gradient">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-dark">Sản phẩm</p>
                                <h4 class="text-dark my-1"><?php echo $count_product ?></h4>
                            </div>
                            <div class="text-dark ms-auto font-35"><i class='bx bx-food-menu'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3" data-aos="fade-left">
                <div class="card radius-10 bg-warning bg-gradient">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-dark">Khách Hàng</p>
                                <h4 class="text-dark my-1"><?php echo $count_customer ?></h4>
                            </div>
                            <div class="text-dark ms-auto font-35"><i class='bx bx-user-pin'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->

        <div class="row">
            <div class="col-lg-4 d-flex" data-aos="fade-right">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?php echo _WEB_ROOT; ?>/assets/admin/images/avatars/zen.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                            <div class="mt-3">
                                <h4>Lê Tuấn Kiệt</h4>
                                <p class="text-secondary mb-1">Full Stack Developer</p>
                                <p class="text-muted font-size-sm">Ninh Kiều, Cần Thơ</p>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                        </path>
                                    </svg>Website</h6>
                                <span class="text-secondary">https://zenshop.com</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github me-2 icon-inline">
                                        <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                        </path>
                                    </svg>Github</h6>
                                <span class="text-secondary"><a href="https://github.com/zenfection">zenfection</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-2 icon-inline text-info">
                                        <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                        </path>
                                    </svg>Twitter</h6>
                                <span class="text-secondary"><a href="https://twitter.com/zenfection">@zenfection</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-2 icon-inline text-danger">
                                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                    </svg>Instagram</h6>
                                <span class="text-secondary"><a href="https://instagram.com/zenfection">@zenfection</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                        </path>
                                    </svg>Facebook</h6>
                                <span class="text-secondary"><a href="https://facebook.com/zenfection">@zenfection</a></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 d-flex" data-aos="fade-left">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="font-weight-bold mb-0">Trạng thái đơn hàng</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <div class="cursor-pointer text-dark font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded"></i>
                                </div>
                            </div>
                        </div>
                        <div id="chart4"></div>
                        <div class="d-flex align-items-center justify-content-between text-center">
                            <div>
                                <h5 class="mb-1 font-weight-bold"><?php echo $count_order?></h5>
                                <p class="mb-0 text-secondary">Đã Đặt</p>
                            </div>
                            <div>
                                <h5 class="mb-1 font-weight-bold"><?php echo $count_pending?></h5>
                                <p class="mb-0 text-secondary">Đang Xử Lý</p>
                            </div>
                            <div class="mb-1">
                                <h5 class="mb-1 font-weight-bold"><?php echo $count_shipping?></h5>
                                <p class="mb-0 text-secondary">Đang Giao Hàng</p>
                            </div>
                            <div>
                                <h5 class="mb-1 font-weight-bold"><?php echo $count_canceled?></h5>
                                <p class="mb-0 text-secondary">Huỷ</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
        
        <?php $this->render('admin/dashboard/top_product', $data, false)?>
        <!--end row-->
    </div>
</div>
<!--end page wrapper -->


<script>
    // chart4
    var options = {
        series: [<?php echo ROUND(($count_delivered / $count_order)*100,2)?>],
        chart: {
            //foreColor: '#9a9797',
            height: 380,
            type: 'radialBar',
            offsetY: -10
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                hollow: {
                    margin: 0,
                    size: '70%',
                    background: 'transparent',
                },
                track: {
                    strokeWidth: '100%',
                    dropShadow: {
                        enabled: false,
                        top: -3,
                        left: 0,
                        blur: 4,
                        //color: 'rgba(209, 58, 223, 0.65)',
                        opacity: 0.12
                    }
                },
                dataLabels: {
                    name: {
                        fontSize: '16px',
                        color: '#212529',
                        offsetY: 5
                    },
                    value: {
                        offsetY: 20,
                        fontSize: '30px',
                        color: '#212529',
                        formatter: function(val) {
                            return val + "%";
                        }
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                shadeIntensity: 0.15,
                gradientToColors: ['#4a00e0'],
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 50, 65, 91]
            },
        },
        colors: ["#8e2de2"],
        stroke: {
            dashArray: 4
        },
        labels: ['Đã Giao'],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    height: 300,
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#chart4"), options);
    chart.render();

    new PerfectScrollbar('.best-selling-products');
    new PerfectScrollbar('.recent-reviews');
    //new PerfectScrollbar('.support-list');
</script>