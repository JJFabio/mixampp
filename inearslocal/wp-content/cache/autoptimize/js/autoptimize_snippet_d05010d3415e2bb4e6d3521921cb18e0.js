jQuery(function($){"use strict";$('.featured-portfolio .entry').matchHeight();$('.featured-content .entry').matchHeight();function kreativ_parallax_effects(){$(window).scroll(function(){var scrolltop=$(window).scrollTop();$(".front-page-1").css("backgroundPosition","50% "+-(scrolltop/6)+"px");});}
kreativ_parallax_effects();function kreativ_smooth_scroll(){var root=$('html, body');$('a[href*="#"]:not([href="#"])').click(function(){if(location.pathname.replace(/^\//,'')==this.pathname.replace(/^\//,'')&&location.hostname==this.hostname){var target=$(this.hash);target=target.length?target:$('[name='+this.hash.slice(1)+']');if(target.length){root.animate({scrollTop:target.offset().top},400);return false;}}});}
kreativ_smooth_scroll();});