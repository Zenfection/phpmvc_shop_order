
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (!empty($page_title) ? $page_title : 'Trang Chủ') ?></title>
	<link rel="stylesheet" href="https://repack.me/templates/Great/css/bootstrap.css">
    <link href="<?php echo _GIT_SOURCE; ?>/assets/css/errors.css" rel="stylesheet">
</head>
<body class="blue-bg">
    <div class="col-md-12" style="top:48vmin">
        <div class="meow">
            <div class="cat">
                <div class="cat-inner">
                </div>
                <div class="cat-head">
                    <div class="cat-ear"></div>
                    <div class="cat-ear2"></div>
                    <div class="cat-nose"></div>
                    <div class="cat-mouth">
                        <div class="cat-meow"></div>
                    </div>
                    <div class="cateye">
                        <div class="cateye inner"></div>
                        <div class="cateye inner inner-2"></div>
                        <div class="cateyelid top"></div>
                        <div class="cateyelid bottom"></div>
                    </div>
                    <div class="cateye2">
                        <div class="cateye inner"></div>
                        <div class="cateye inner inner-2"></div>
                        <div class="cateyelid top"></div>
                        <div class="cateyelid bottom"></div>
                    </div>
                </div>
                <div class="cat-leg"></div>
                <div class="cat-foot"></div>
                <div class="cat-leg-front"></div>
                <div class="cat-foot-front"></div>
                <div class="cat-hind-leg"></div>
                <div class="cat-hind-leg-top"></div>
                <div class="cat-hind-foot"></div>
                <div class="cat-hind-paw"></div>
                <div class="cat-hind-leg2"></div>
                <div class="cat-hind-leg-top2"></div>
                <div class="cat-hind-foot2"></div>
                <div class="cat-hind-paw2"></div>
                <div class="cat-tail"></div>
                <div class="cat-tail-end"></div>
            </div>
            <h1><?php echo $number_error?></h1>
        </div>
    </div>
    <div class="col-md-12">
        <div class="message">
            <h2>Không tìm thấy file</h2>
            <p>Xem lại đường dẫn liên kết</p>
            <br>
            <div class="btndiv">
                <div class="btnpop" style="border-radius: 1rem;" onclick="window.location.href='/'; return false;">Trở Lại</div>
            </div>
        </div>
    </div>

</body>
</html>