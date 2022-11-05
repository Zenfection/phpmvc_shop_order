<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (!empty($page_title) ? $page_title : 'Trang Chủ') ?></title>

    <link rel="shortcut icon" href="<?php echo _WEB_ROOT; ?>/assets/images/favicon.ico">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
    <!-- <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/assets/css/vendor/themify-icons-min.css" /> -->
    <!-- //* Font Awesome Pro 6.2.0 -->
    <script src="https://cdn.jsdelivr.net/gh/zenfection/phpmvc_shop_order/cdn/js/icon-zen.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nice-select2@2.0.0/dist/css/nice-select2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lobibox@1.2.7/css/lobibox.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.css">
    
    <!-- Custom main style: 
    pace.min.css
    style.css
    custom.css
    -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/zenfection/phpmvc_shop_order/cdn/css/style.min.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/gh/zenfection/phpmvc_shop_order/cdn/js/load-content.min.js"></script>

    <?php $this->render('blocks/header', $sub_content); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/nice-select2@2.0.0/dist/js/nice-select2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lobibox@1.2.7/js/lobibox.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lobibox@1.2.7/js/notifications.js"></script>
    
    <!--  -->
    <script src="<?php echo _WEB_ROOT; ?>/assets/js/custom.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/assets/js/backend.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/assets/js/main.js"></script>


    <div id="content">
        <?php $this->render($content, $sub_content) ?>
    </div>

    <!-- // TODO Load Javascript
    //! vendor: 
    //* 1. popper.min.js          : 2.11.5
    //* 2. bootstrap.min.js       : 5.1.3
    //* 3. jquery.min.js          : 3.6.0
    //* 4. jquery-migrate.min.js  : 3.4.0
    //* 5. modernizr.min.js       : 3.11.2

    //! plugins:
    //* 1. anime.min.js           : 3.2.1
    //* 2. aos.min.js             : 3.0.0
    //* 3. tiny-slider.js         : 2.9.3
    //* 4. feather.min.js         : 4.28.0
    //* 5. jquery.validate.min.js : 1.19.3
    //* 6. jquery-ui.min.js       : 1.12.1
    //* 7. jquery.nice-select.min.js : 1.1.0
    //* 8. lolibox.min.js         : 1.0.0
    //* 9. notifications.min.js   : 1.0.0
    -->


    <?php
    $this->render('blocks/footer');
    $this->render('blocks/mobile');
    ?>
</body>

</html>