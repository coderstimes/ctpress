$(document).ready(function () {
	'use strict';
	$('body').append('<div id="toTop" class="btn back-top"><span class="ti-arrow-up"></span></div>');
	$(window).on("scroll", function () {
		if ($(this).scrollTop() !== 0) {
			$('#toTop').fadeIn();
		} else {
			$('#toTop').fadeOut();
		}
	});
	$('#toTop').on("click", function () {
		$("html, body").animate({
			scrollTop: 0
		}, 600);
		return false;
	});
	$(".se-pre-con").fadeOut("slow");
	var owl = $("#NewsTicker");
	owl.owlCarousel({
		autoPlay: 5000,
		singleItem: true,
		transitionStyle: "goDown",
		pagination: false,
		navigation: true,
		navigationText: ["<i class='ti-angle-left'></i>", "<i class='ti-angle-right'></i>"]
	});
	$('#NewsTicker-rtl').owlCarousel({
		rtl: true,
		loop: true,
		dots: false,
		autoplay: true,
		autoplayTimeout: 5000,
		autoplayHoverPause: true,
		nav: true,
		navText: ["<i class='ti-angle-left'></i>", "<i class='ti-angle-right'></i>"],
		items: 1
	});
	$('.main-content, .rightSidebar, .leftSidebar').theiaStickySidebar({
		additionalMarginTop: 30
	});
	var owl = $("#owl-slider");
	owl.owlCarousel({
		autoPlay: 4000,
		singleItem: true,
		transitionStyle: "fade",
		navigation: true,
		navigationText: ["<i class='ti-angle-left'></i>", "<i class='ti-angle-right'></i>"]
	});
	$('#owl-slider-rtl').owlCarousel({
		rtl: true,
		loop: true,
		autoplay: true,
		autoplayTimeout: 6000,
		autoplayHoverPause: true,
		nav: true,
		navText: ["<i class='ti-angle-left'></i>", "<i class='ti-angle-right'></i>"],
		items: 1,
		responsive: {
			0: {
				items: 1
			},
			479: {
				items: 1
			},
			768: {
				items: 1
			},
			980: {
				items: 1
			},
			1199: {
				items: 1
			}
		}
	});
	$("#featured-owl").owlCarousel({
		autoPlay: 4000,
		items: 4,
		lazyLoad: true,
		pagination: false,
		navigation: false
	});
	$('#featured-owl-rtl').owlCarousel({
		rtl: true,
		loop: true,
		dots: false,
		nav: false,
		items: 4,
		responsive: {
			0: {
				items: 1
			},
			479: {
				items: 1
			},
			768: {
				items: 2
			},
			980: {
				items: 3
			},
			1199: {
				items: 4
			}
		}
	});
	var owl = $("#post-slider");
	owl.owlCarousel({
		navigation: true,
		singleItem: true,
		pagination: false,
		transitionStyle: "fade",
		navigationText: ["<i class='ti-angle-left'></i>", "<i class='ti-angle-right'></i>"]
	});
	var owl = $("#post-slider-2");
	owl.owlCarousel({
		navigation: true,
		singleItem: true,
		pagination: false,
		transitionStyle: "fade",
		navigationText: ["<i class='ti-angle-left'></i>", "<i class='ti-angle-right'></i>"]
	});
	$('.post-slider-rtl').owlCarousel({
		rtl: true,
		loop: true,
		dots: false,
		nav: true,
		navText: ["<i class='ti-angle-left'></i>", "<i class='ti-angle-right'></i>"],
		items: 1,
		responsive: {
			0: {
				items: 1
			},
			479: {
				items: 1
			},
			768: {
				items: 1
			},
			980: {
				items: 1
			},
			1199: {
				items: 1
			}
		}
	});
	var owl = $("#post-slider-3");
	owl.owlCarousel({
		navigation: true,
		singleItem: true,
		pagination: false,
		transitionStyle: "fade",
		navigationText: ["<i class='ti-angle-left'></i>", "<i class='ti-angle-right'></i>"]
	});
	$(".weather-week>div.list-group>a").click(function (e) {
		e.preventDefault();
		$(this).siblings('a.active').removeClass("active");
		$(this).addClass("active");
		var index = $(this).index();
		$("div.bhoechie-tab>div.weather-temp-wrap").removeClass("active");
		$("div.bhoechie-tab>div.weather-temp-wrap").eq(index).addClass("active");
	});
	$("#datepicker").datepicker();
	window.api_key = 'AIzaSyAroKpLQWTON6y34m5VqGcLCPtOmfLBqh4';
	$('#rypp-demo-1').rypp(api_key, {
		update_title_desc: true,
		autoplay: false,
		autonext: false,
		loop: false,
		mute: false,
		debug: false
	});
	$('.collapse.in').prev('.panel-heading').addClass('active');
	$('#accordion').on('show.bs.collapse', function (a) {
		$(a.target).prev('.panel-heading').addClass('active');
	}).on('hide.bs.collapse', function (a) {
		$(a.target).prev('.panel-heading').removeClass('active');
	});
	var el = document.getElementsByClassName('progressber'),
		l = el.length;
	for (var i = 0; i < l; i++) {
		var options = {
			percent: el[i].getAttribute('data-percent'),
			size: el[i].getAttribute('data-size') || 60,
			lineWidth: el[i].getAttribute('data-line') || 4
		};
		var canvas = document.createElement('canvas');
		var span = document.createElement('span');
		span.textContent = options.percent + '%';
		if (typeof (G_vmlCanvasManager) !== 'undefined') {
			G_vmlCanvasManager.initElement(canvas);
		}
		var ctx = canvas.getContext('2d');
		canvas.width = canvas.height = options.size;
		el[i].appendChild(span);
		el[i].appendChild(canvas);
		ctx.translate(options.size / 2, options.size / 2);
		var radius = (options.size - options.lineWidth) / 2;
		var drawCircle = function (color, lineWidth, percent) {
			percent = Math.min(Math.max(0, percent || 1), 1);
			ctx.beginPath();
			ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
			ctx.strokeStyle = color;
			ctx.lineCap = 'round';
			ctx.lineWidth = lineWidth;
			ctx.stroke();
		};
		drawCircle('transparent', options.lineWidth, 100 / 100);
		drawCircle('#eb0254', options.lineWidth, options.percent / 100);
	}
	var d = new Date();
	var getMonth = d.getMonth() + 1;
	var getDay = d.getDate();
	var currentDate = d.getFullYear() + '-' +
		(('' + getMonth).length < 2 ? '0' : '') + getMonth + '-' +
		(('' + getDay).length < 2 ? '0' : '') + getDay;
	var base_url = window.location.origin;
	var current_archive_date = currentDate;
	var last_archive_date = currentDate;
	var sel_edition = '';	
});