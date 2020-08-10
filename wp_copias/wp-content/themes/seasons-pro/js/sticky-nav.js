jQuery(document).ready(function() {

  jQuery(window).scroll(function () {

    if (jQuery(window).scrollTop() >  44 ) {
      jQuery('.site-header').addClass('navbar-fixed-top');
      jQuery('.site-container').addClass('fixed');
      jQuery('.nav-secondary').addClass('hide');
    }

    if (jQuery(window).scrollTop() < 44 ) {
      jQuery('.site-header').removeClass('navbar-fixed-top');
      jQuery('.site-container').removeClass('fixed');
      jQuery('.nav-secondary').removeClass('hide');
    }

  });

});