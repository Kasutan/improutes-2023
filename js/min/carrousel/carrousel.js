!function(t){t(document).ready(function(){var e,a=t(".carrousel .owl-carousel");0<a.length&&a.owlCarousel({loop:!0,nav:!(a=5),navText:['<span><span class="screen-reader-text"> Article précédent</span></span>','<span><span class="screen-reader-text">Article suivant <span></span>'],dots:!0,autoplay:!0,autoplayTimeout:5e3,autoplaySpeed:2e3,autoplayHoverPause:!0,margin:0,onInitialized:function(e){t(".owl-dot span").addClass("screen-reader-text"),t(".owl-dot span").html("Afficher le groupe de logos suivant"),t(".owl-nav button").removeAttr("role")},responsive:{0:{items:e=2,dotsEach:e},500:{items:e=3,dotsEach:e},768:{items:e=4,dotsEach:e},960:{items:a,dotsEach:a}}})})}(jQuery);