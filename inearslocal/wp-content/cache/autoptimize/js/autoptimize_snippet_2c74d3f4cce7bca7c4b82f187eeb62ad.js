jQuery(function($){"use strict";$('.genesis-pro-portfolio .entry').matchHeight();function kreativ_sticky_header(){var header=$('.site-header'),body=$('body'),wrap=header.find('.wrap').first(),spacer=$('<div />',{'class':'header-spacer',});if(!body.hasClass('sticky-header-active')){return;}
if(header.length){$(window).scroll(function(){if(window.innerWidth>1024){var spacerHeight=header.outerHeight(),scrolltop=$(window).scrollTop();if(body.hasClass('admin-bar')){scrolltop=scrolltop+32;}
spacer.height(spacerHeight);if(!header.hasClass('sticky')&&scrolltop>header.offset().top){header.before(spacer);header.addClass('sticky');}
else if(header.hasClass('sticky')&&(scrolltop<spacer.offset().top||scrolltop==0)){spacer.remove();header.removeClass('sticky');}}});}
$(window).resize(function(){if(window.innerWidth<1024){if(header.hasClass('sticky')){header.removeClass('sticky');}
if(spacer.size()){spacer.remove();}}});}
kreativ_sticky_header();function kreativ_scroll_top(){var scrollup=$('.scrollup');$(window).scroll(function(){if($(this).scrollTop()>100){scrollup.fadeIn();}else{scrollup.fadeOut();}});scrollup.click(function(){$("html, body").animate({scrollTop:0},600);return false;});}
kreativ_scroll_top();});