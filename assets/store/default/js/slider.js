$(document).ready(function () {
	$(".image-slider1").slick({
		infinite: true,
		slidesToShow: 6,
		slidesToScroll: 1,
		prevArrow: "<button type='button' class='slick-prev pull-left'><i class='bx bx-chevron-up bx-rotate-270' ></i></button>",
		nextArrow: "<button type='button' class='slick-next pull-right'><i class='bx bx-chevron-up bx-rotate-90' ></i></button>",
		arrows: false,
		autoplay: true,
		autoplaySpeed: 1000,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					arrows: false,
					autoplay: true,
					autoplaySpeed: 1500,
				},
			},
		],
	})
})

// CATEGORY
$(document).ready(function () {
	$(".category-listing").slick({
		infinite: true,
		slidesToShow: 5,
		slidesToScroll: 1,
		prevArrow: "<button type='button' class='slick-prev pull-left'><i class='bx bx-chevron-up bx-rotate-270' ></i></button>",
		nextArrow: "<button type='button' class='slick-next pull-right'><i class='bx bx-chevron-up bx-rotate-90' ></i></button>",
		arrows: false,
		autoplay: false,
		autoplaySpeed: 1000,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					infinite: true,
					slidesToShow: 2,
					slidesToScroll: 2,
					arrows: true,
					autoplay: false,
				},
			},
		],
	})
})

// STRATEGY
$(document).ready(function () {
	$(".product-strategy").slick({
		infinite: true,
		slidesToShow: 5,
		slidesToScroll: 1,
		prevArrow: "<button type='button' class='slick-prev pull-left'><i class='bx bx-chevron-up bx-rotate-270' ></i></button>",
		nextArrow: "<button type='button' class='slick-next pull-right'><i class='bx bx-chevron-up bx-rotate-90' ></i></button>",
		arrows: false,
		autoplay: true,
		autoplaySpeed: 1000,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					infinite: true,
					slidesToShow: 2,
					slidesToScroll: 2,
					arrows: true,
					autoplay: false,
				},
			},
		],
	})
	$(".product-strategy-for-affiliate").slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 3,
		prevArrow: "<button type='button' class='slick-prev pull-left'><i class='bx bx-chevron-up bx-rotate-270' ></i></button>",
		nextArrow: "<button type='button' class='slick-next pull-right'><i class='bx bx-chevron-up bx-rotate-90' ></i></button>",
		arrows: false,
		autoplay: true,
		autoplaySpeed: 1500,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					infinite: true,
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: true,
					autoplay: false,
				},
			},
		],
	})
})

// DAOTAO
$(document).ready(function () {
	$(".slider-daotao").slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		prevArrow: "<button type='button' class='slick-prev pull-left'><i class='bx bx-chevron-up bx-rotate-270' ></i></button>",
		nextArrow: "<button type='button' class='slick-next pull-right'><i class='bx bx-chevron-up bx-rotate-90' ></i></button>",
		arrows: false,
		autoplay: false,
		autoplaySpeed: 1000,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					infinite: true,
					slidesToShow: 1,
					slidesToScroll: 2,
					arrows: true,
					autoplay: false,
				},
			},
		],
	})
})

// COUPON
$(document).ready(function () {
	$(".coupon-slider").slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		prevArrow: "<button type='button' class='slick-prev pull-left'><i class='bx bx-chevron-up bx-rotate-270' ></i></button>",
		nextArrow: "<button type='button' class='slick-next pull-right'><i class='bx bx-chevron-up bx-rotate-90' ></i></button>",
		arrows: false,
		autoplay: true,
		autoplaySpeed: 2000,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					infinite: true,
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: true,
					autoplay: false,
				},
			},
		],
	})
})
