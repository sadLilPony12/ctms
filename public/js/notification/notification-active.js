(function ($) {
	"use strict";

	/*
	 * Notifications
	 */
	function notify(from, align, icon, type, animIn, animOut) {
		$.growl({
			icon: icon,
			title: ' Logout? <br/>',
			message: 'You are about to be logged out.',
			url: ''
		}, {
			element: 'body',
			type: type,
			allow_dismiss: true,
			placement: {
				from: from,
				align: align
			},
			offset: {
				x: 20,
				y: 85
			},
			spacing: 10,
			z_index: 1031,
			delay: 10000,
			timer: 1000,
			url_target: '_blank',
			mouse_over: false,
			animate: {
				enter: animIn,
				exit: animOut
			},
			icon_type: 'class',
			template: '<div data-growl="container" class="alert" role="alert">' +
				'<button onclick="event.preventDefault(); document.getElementById(`logout-form`).submit();" style="position: absolute; right:8%; top:60%;" class="close" data-growl="dismiss">' +
				'<span class="notika-icon notika-checked" aria-hidden="true"></span>' +
				'</button>' +
				'<button class="close" data-growl="dismiss">' +
				'<span class="notika-icon notika-close" aria-hidden="true"></span>' +
				'</button>' +
				'<span data-growl="icon"></span>' +
				'<span data-growl="title"></span>' +
				'<span data-growl="message"></span>' +
				'</div>'
		});
	};

	$('.notification-demo .btn').on('click', function (e) {
		e.preventDefault();
		var nFrom = $(this).attr('data-from');
		var nAlign = $(this).attr('data-align');
		var nIcons = $(this).attr('data-icon');
		var nType = $(this).attr('data-type');
		var nAnimIn = $(this).attr('data-animation-in');
		var nAnimOut = $(this).attr('data-animation-out');

		notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut);
	});


})(jQuery); 