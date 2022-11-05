<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="<?php echo _GIT_SOURCE; ?>/assets/admin/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="<?php echo _GIT_SOURCE; ?>/assets/admin/plugins/simplebar/css/simplebar.min.css" rel="stylesheet" />
	<link href="<?php echo _GIT_SOURCE; ?>/assets/admin/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- add_product-->
	<link href="<?php echo _GIT_SOURCE; ?>/assets/admin/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.5/css/perfect-scrollbar.min.css">    
	<!-- loader-->
	<link href="<?php echo _GIT_SOURCE; ?>/assets/admin/css/pace.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo _GIT_SOURCE; ?>/assets/admin/css/bootstrap-extended.min.css">
	<link rel="stylesheet" href="<?php echo _GIT_SOURCE; ?>/assets/admin/css/app.min.css">
	<link rel="stylesheet" href="<?php echo _GIT_SOURCE; ?>/assets/admin/css/icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="<?php echo _GIT_SOURCE; ?>/assets/admin/css/dark-theme.min.css" />
	<link rel="stylesheet" href="<?php echo _GIT_SOURCE; ?>/assets/admin/css/semi-dark.min.css" />
	<link rel="stylesheet" href="<?php echo _GIT_SOURCE; ?>/assets/admin/css/header-colors.min.css" />
	<link rel="stylesheet" href="<?php echo _GIT_SOURCE; ?>/assets/admin/css/custom.css" />
    <title><?php echo (!empty($page_title) ? $page_title : 'Trang Chủ') ?></title>
</head>
<html>

<body>
	<!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
	<script src="<?php echo _GIT_SOURCE; ?>/assets/admin/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="<?php echo _GIT_SOURCE; ?>/assets/admin/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.5/dist/perfect-scrollbar.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.36.1/dist/apexcharts.min.js"></script>
	<script src="<?php echo _GIT_SOURCE; ?>/assets/admin/js/main.js"></script>
	<script src="<?php echo _GIT_SOURCE; ?>/assets/admin/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>
	<!--app JS-->
	<script src="<?php echo _GIT_SOURCE; ?>/assets/admin/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

	<div class="wrapper">
		<?php 
			$sidebar = [
				'current_sidebar' => $sub_content['current_sidebar'],
			];
            $this->render('admin/blocks/sidebar', $sidebar, false);
            $this->render('admin/blocks/header');
		?>
	
	<div id="content">
		<?php $this->render($content, $sub_content)?>
	</div>

	<!--start overlay-->
	<div class="overlay toggle-icon"></div>
	<!--end overlay-->
	
	<!--Start Back To Top Button--> 
    <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
	<!--End Back To Top Button-->
	
	<footer class="page-footer">
		<p class="mb-0">Copyright © 2022-Zenfection</p>
	</footer>

	</div>

	<?php $this->render('admin/blocks/switcher')?>

	<script src="<?php echo _GIT_SOURCE; ?>/assets/admin/js/load-content.js"></script>
	
	<script>
		$(document).ready(function() {
			AOS.init();
		});
	</script>
</body>

</html>