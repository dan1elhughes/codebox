//Fade items in one by one

	$(window).load(function() {
		$('.fade').hide().each(function(i) {
		$(this).delay((i++) * 50).fadeTo(1000, 1); })
	});
	
//Display navbar on #pull click
	
	$(function() {
			var pull 		= $('#pull');
				menu 		= $('#navigation');
				menuHeight	= menu.height();

			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});

			$(window).resize(function(){
        		var w = $(window).width();
        		if(w > 320 && menu.is(':hidden')) {
        			menu.removeAttr('style');
        		}
    		});
		});