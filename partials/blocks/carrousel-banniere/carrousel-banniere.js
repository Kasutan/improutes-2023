//https://owlcarousel2.github.io/OwlCarousel2/docs/api-options.html

(function($) {

	$( document ).ready(function() {
		var owl = $(".carrousel-banniere .owl-carousel"); 
		if(owl.length > 0) {
			
			owl.owlCarousel({
				loop:true,
				nav : false,
				navText:['<span><span class="screen-reader-text"> Article précédent</span></span>','<span><span class="screen-reader-text">Article suivant <span></span>'],
				dots : true,
				autoplay:true,
				autoplayTimeout:5000,
				autoplaySpeed:2000,
				autoplayHoverPause:true,
				items:1,
				margin:0,
				//slideBy:'page',
				//checkVisible: false,
				onInitialized: accessibleNav,
				
			});
		}

		function accessibleNav(e) {
			$('.owl-dot span').addClass('screen-reader-text');
			$('.owl-dot span').html('Planche suivante - next slide');
			//Role incorrect d'après Axe
			//$('.owl-nav button').removeAttr('role');

		}
	}); //fin document ready
})( jQuery );