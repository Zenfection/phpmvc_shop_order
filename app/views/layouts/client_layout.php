<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- HTML Meta Tags -->
    <title><?php echo (!empty($page_title) ? $page_title : 'Zen Shop Order') ?></title>
    <meta name="description" content="This is my personal project on PHP MVC, I hope you guys can give me your opinion">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="https://shop.zenfection.com">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Zen Shop Order">
    <meta property="og:description" content="This is my personal project on PHP MVC, I hope you guys can give me your opinion">
    <meta property="og:image" content="https://ik.imagekit.io/zenfection/shoporder/tr:h-500,w-900/meta_image.png">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="shop.zenfection.com">
    <meta property="twitter:url" content="https://shop.zenfection.com">
    <meta name="twitter:title" content="Zen Shop Order">
    <meta name="twitter:description" content="This is my personal project on PHP MVC, I hope you guys can give me your opinion">
    <meta name="twitter:image" content="https://ik.imagekit.io/zenfection/shoporder/tr:h-500,w-900/meta_image.png">

    <link rel="shortcut icon" href="<?php echo _GIT_SOURCE; ?>/assets/images/favicon.ico">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/combine/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css,npm/animate.css@4.1.1/animate.min.css,npm/aos@2.3.4/dist/aos.min.css,npm/nice-select2@2.0.0/dist/css/nice-select2.min.css,npm/lobibox@1.2.7/css/lobibox.min.css,npm/tiny-slider@2.9.3/dist/tiny-slider.min.css">

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nice-select2@2.0.0/dist/css/nice-select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lobibox@1.2.7/css/lobibox.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.css"> -->

    <script src="<?php echo _WEB_ROOT; ?>/cdn/js/icon-zen.min.js"></script>
    <!-- Custom main style: 
    pace.min.css
    style.css
    custom.css
    -->
    <link rel="stylesheet" href="<?php echo _CDN_JSDelivr; ?>/cdn/css/style-v2.min.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/jquery"></script>
    <script src="https://cdn.jsdelivr.net/npm/nice-select2@2.0.0/dist/js/nice-select2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lobibox@1.2.7/js/lobibox.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.js"></script>
    
    <!--  Zen Script -->
    <script defer src="<?php echo _WEB_ROOT; ?>/assets/js/main.js"></script>
    <script defer src="<?php echo _WEB_ROOT; ?>/assets/js/backend.js"></script>
    <script defer src="<?php echo _WEB_ROOT; ?>/assets/js/load-content.js"></script>
    <script defer src="<?php echo _WEB_ROOT; ?>/assets/js/custom.js"></script>

    <?php $this->render('blocks/header', $sub_content); ?>

    <div id="content">
        <?php $this->render($content, $sub_content) ?>
    </div>


    <?php
    $this->render('blocks/footer');
    $this->render('blocks/mobile');
    ?>

    <!-- <script src="<?php echo _WEB_ROOT; ?>/cdn/js/main.min.js"></script> -->
</body>

</html>