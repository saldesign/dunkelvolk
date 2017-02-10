jQuery(document).ready(function($) {
	$( ".menu-item-home a" ).prepend( "<span></span>" );

	$(window).scroll(function() {
				  if ($(this).scrollTop() > 200){  
					jQuery('#masthead').addClass('sticky');
				  }
				  else{
					jQuery('#masthead').removeClass("sticky");
				  }
	});

	$('.search-button').click(function(){
		$('header .site-search').toggleClass('active');
	});


	$('.icon-f a, .icon-i a, .icon-y a').empty();
});//End document.ready 
