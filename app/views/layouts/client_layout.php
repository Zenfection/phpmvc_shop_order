<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (!empty($page_title) ? $page_title : 'Trang Chủ') ?></title>

    <link rel="shortcut icon" href="<?php echo _WEB_ROOT; ?>/assets/images/favicon.ico">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/assets/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/assets/css/vendor/themify-icons-min.css" />
    <!-- //* Font Awesome Pro 6.2.0 -->
    <script src="<?php echo _WEB_ROOT; ?>/assets/js/all.js"></script>

    <link href="<?php echo _WEB_ROOT; ?>/assets/css/plugins/pace.min.css" rel="stylesheet"/>
	<script src="<?php echo _WEB_ROOT; ?>/assets/admin/js/pace.min.js"></script>

    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/assets/css/plugins/animate.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/assets/css/plugins/aos.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/assets/css/plugins/nice-select.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/assets/css/plugins/lobibox.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/assets/css/plugins/tiny-slider.css">

    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/assets/css/custom.css">
</head>

<body>
    <script src="<?php echo _WEB_ROOT; ?>/assets/js/load-content.js"></script>
    <?php $this->render('blocks/header', $sub_content); ?>
    
    <script src="<?php echo _WEB_ROOT; ?>/assets/js/vendor/popper.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/assets/js/vendor/bootstrap.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <!-- <script src="<?php echo _WEB_ROOT; ?>/assets/js/vendor/jquery-migrate-3.4.0.min.js"></script> -->
    <!-- <script src="<?php echo _WEB_ROOT; ?>/assets/js/vendor/modernizr-3.11.2.min.js"></script> -->
    <!-- <script src="<?php echo _WEB_ROOT; ?>/assets/js/plugins/jquery-ui.min.js"></script> -->
    
    <script src="<?php echo _WEB_ROOT; ?>/assets/js/plugins/aos.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/assets/js/plugins/feather.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/assets/js/plugins/tiny-slider.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/assets/js/plugins/anime.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/assets/js/plugins/nice-select.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/assets/js/plugins/lobibox.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/assets/js/plugins/notifications.min.js"></script>
    
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