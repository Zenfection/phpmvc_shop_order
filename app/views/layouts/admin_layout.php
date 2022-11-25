<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="<?php echo _WEB_ROOT; ?>/assets/admin/images/favicon-32x32.png" type="image/png" />

	<!-- //? plugins  -->
	<link href="https://cdn.jsdelivr.net/npm/simplebar@5.3.9/dist/simplebar.min.css" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/metismenu@3.0.7/dist/metisMenu.min.css" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.5/css/perfect-scrollbar.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/lobibox@1.2.7/css/lobibox.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/nice-select2@2.0.0/dist/css/nice-select2.min.css" rel="stylesheet">
	<link href="<?php echo _WEB_ROOT; ?>/assets/admin/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />
	
	<!-- //? loader -->
	<link href="<?php echo _WEB_ROOT; ?>/assets/admin/css/pace.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>

	<!-- //? Bootstrap CSS -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"/>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="<?php echo _WEB_ROOT; ?>/assets/admin/css/bootstrap-extended.min.css" rel="stylesheet" />
	<link href="<?php echo _WEB_ROOT; ?>/assets/admin/css/app.min.css" rel="stylesheet" />
	<script src="<?php echo _WEB_ROOT; ?>/cdn/js/icon-zen.min.js"></script>
	<!-- <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?> assets/admin/css/icons.min.css"> -->

	<!-- //? Theme Style CSS -->
	<link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/assets/admin/css/dark-theme.min.css" />
	<link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/assets/admin/css/semi-dark.min.css" />
	<link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/assets/admin/css/header-colors.min.css" />
	<link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/assets/admin/css/custom.css" />

	<title><?php echo (!empty($page_title) ? $page_title : 'Trang Chủ') ?></title>
</head>
<html>

<body>
	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/nice-select2@2.0.0/dist/js/nice-select2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/simplebar@5.3.9/dist/simplebar.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/metismenu@3.0.7/dist/metisMenu.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.5/dist/perfect-scrollbar.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.36.1/dist/apexcharts.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/tinymce@6.2.0/tinymce.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/lobibox@1.2.7/js/lobibox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lobibox@1.2.7/js/notifications.min.js"></script>
	

	<script src="<?php echo _WEB_ROOT; ?>/assets/admin/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>
	<!--app JS-->
	<script src="<?php echo _WEB_ROOT; ?>/assets/admin/js/main.js"></script>
	<script src="<?php echo _WEB_ROOT; ?>/assets/admin/js/app.js"></script>
	<script src="<?php echo _WEB_ROOT; ?>/assets/admin/js/backend.js"></script>

	<div class="wrapper">
		<?php
		if (isset($sub_content['load_only'])) {
		?>
			<div id="content">
				<?php $this->render($content, $sub_content) ?>
			</div>
		<?php
		} else {
			$sidebar = [
				'current_sidebar' => $sub_content['current_sidebar'],
			];
			$this->render('admin/blocks/sidebar', $sidebar, false);
			$this->render('admin/blocks/header');
		?>
			<div id="content">
				<?php $this->render($content, $sub_content) ?>
			</div>
		<?php
		}
		?>

		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->

		<!--Start Back To Top Button-->
		<a href="javaScript:;" class="back-to-top"><i class='fa-duotone fa-angles-up fa-beat'></i></a>
		<!--End Back To Top Button-->

		<footer class="page-footer">
			<p class="mb-0">Copyright © 2022-Zenfection</p>
		</footer>

	</div>

	<?php $this->render('admin/blocks/switcher') ?>

	<script src="<?php echo _WEB_ROOT; ?>/assets/admin/js/load-content.js"></script>

	<script>
		$(document).ready(function() {
			AOS.init();
		});
	</script>
</body>

</html>