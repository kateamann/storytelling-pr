(function($) {
    $(document).ready(function() {

    $('.home-slides').slick({
	    infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		lazyLoad: 'progressive',
		dots: false,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 5000,
		fade: true,
		speed: 800
	  });

  });

})(jQuery);