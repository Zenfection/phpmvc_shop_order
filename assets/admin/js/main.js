$(function () {
	"use strict";

	/*-------------------------
		Ajax Load Data Nagivation
	---------------------------*/
	$(document).on('click', '.viewOrderDetails', function () {
		let id = $(this).attr('id');
		$.ajax({
			type: 'POST',
			url: '/admin/order_details.php',
			data: { id: id },
			success: function (data) {
				window.scrollTo(0, 0);
				$('#content').html(data);
				AOS.init();
			}
		});
	});
	$(document).on('keypress', '#searchProduct', function(e) {
		if(e.which == 13) {
			let search = $(this).val();
			window.location.href = `/admin/dashboard/product/${search}`;
		}
	});$(document).on('keypress', '#searchOrder', function(e) {
		if(e.which == 13) {
			let search = $(this).val();
			$.ajax({
				type: 'POST',
				url: '/admin/order.php',
				data: { search: search },
				success: function (data) {
					$('#content').html(data);
					AOS.init();
				}
			});
		}
	});
});