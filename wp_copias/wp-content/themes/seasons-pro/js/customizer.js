/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ($) {

  //* hero banner bg image
  wp.customize('wps_hero_bg_image', function (value) {
    value.bind(function (to) {
      $('.fp-section-1').attr('style', 'background-image: url(' + to + ')');
    });
  });

  // wpstudio hero title one
  wp.customize('wps_hero_title_one', function (value) {
    value.bind(function (to) {
      $('.fp-section-1 h2').text(to);
    });
  });

  // wpstudio hero title two
  wp.customize('wps_hero_title_two', function (value) {
    value.bind(function (to) {
      $('.fp-section-2 h2').text(to);
    });
  });

  // wpstudio hero title three
  wp.customize('wps_hero_title_three', function (value) {
    value.bind(function (to) {
      $('.fp-section-3 h2').text(to);
    });
  });

  // wpstudio hero text
  wp.customize('wps_hero_text_one', function (value) {
    value.bind(function (to) {
      $('.fp-section-1 .text').html(to);
    });
  });

    // wpstudio hero text
  wp.customize('wps_hero_text_two', function (value) {
    value.bind(function (to) {
      $('.fp-section-2 .text').html(to);
    });
  });

    // wpstudio hero text
  wp.customize('wps_hero_text_three', function (value) {
    value.bind(function (to) {
      $('.fp-section-3 .text').html(to);
    });
  });

  // wpstudio hero button 1 show/hide
  wp.customize('wps_hero_button1_show', function (value) {
    value.bind(function (to) {
      return to === 'yes' ? $('.fp-section-1 .button').show() : $('.fp-section-1 .button').hide();
    });
  });

  // wpstudio hero button 2 show/hide
  wp.customize('wps_hero_button2_show', function (value) {
    value.bind(function (to) {
      return to === 'yes' ? $('.fp-section-2 .button').show() : $('.fp-section-2 .button').hide();
    });
  });

  // wpstudio hero button 3 show/hide
  wp.customize('wps_hero_button3_show', function (value) {
    value.bind(function (to) {
      return to === 'yes' ? $('.fp-section-3 .button').show() : $('.fp-section-3 .button').hide();
    });
  });

  //* hero button 1 text
  wp.customize('wps_hero_button1_text', function (value) {
    value.bind(function (to) {
      $('.fp-section-1 .button').text(to);
    });
  });

  //* hero button 2 text
  wp.customize('wps_hero_button2_text', function (value) {
    value.bind(function (to) {
      $('.fp-section-2 .button').text(to);
    });
  });

  //* hero button 3 text
  wp.customize('wps_hero_button3_text', function (value) {
    value.bind(function (to) {
      $('.fp-section-3 .button').text(to);
    });
  });

  //* hero text color 1
  wp.customize('wps_hero_text_color_1', function (value) {
    value.bind(function (to) {
      if (to === 'blank') {
        return $('#front-intro .fp-section-1 .inner, #front-intro .fp-section-1 .inner h2, #front-intro .fp-section-1 .button').css({'color': undefined});
      }
      $('#front-intro .fp-section-1 .inner, #front-intro .fp-section-1 .inner h2, #front-intro .fp-section-1 .button').css({'color': to});
    });
  });

  //* hero text color 2
  wp.customize('wps_hero_text_color_2', function (value) {
    value.bind(function (to) {
      if (to === 'blank') {
        return $('#front-intro .fp-section-2 .inner, #front-intro .fp-section-2 .inner h2, #front-intro .fp-section-2 .button').css({'color': undefined});
      }
      $('#front-intro .fp-section-2 .inner, #front-intro .fp-section-2 .inner h2, #front-intro .fp-section-2 .button').css({'color': to});
    });
  });

  //* hero text color 3
  wp.customize('wps_hero_text_color_3', function (value) {
    value.bind(function (to) {
      if (to === 'blank') {
        return $('#front-intro .fp-section-3 .inner, #front-intro .fp-section-3 .inner h2, #front-intro .fp-section-3 .button').css({'color': undefined});
      }
      $('#front-intro .fp-section-3 .inner, #front-intro .fp-section-3 .inner h2, #front-intro .fp-section-3 .button').css({'color': to});
    });
  });

  //* hero banner
  wp.customize('wps_cta_show', function (value) {
    value.bind(function (to) {
      return to === 'yes' ? $('.fp-section-4, .fp-section-5, .fp-section-6').show() : $('.fp-section-4, .fp-section-5, .fp-section-6').hide();
    });
  });

  //* CTA widget 1 text
  wp.customize('wps_cta_text_one', function (value) {
    value.bind(function (to) {
      $('.fp-section-4 .inner .wrap').html(to);
    });
  });

    //* CTA widget 2 text
  wp.customize('wps_cta_text_two', function (value) {
    value.bind(function (to) {
      $('.fp-section-5 .inner .wrap').html(to);
    });
  });

    //* CTA widget 3 text
  wp.customize('wps_cta_text_three', function (value) {
    value.bind(function (to) {
      $('.fp-section-6 .inner .wrap').html(to);
    });
  });





  //* subtitle webshop
  wp.customize('wps_hero_text_webshop', function (value) {
    value.bind(function (to) {
      $('.shop-header .inner .text p').text(to);
    });
  });

  //* hero webshop color
  wp.customize('wps_hero_color_webshop', function (value) {
    value.bind(function (to) {
      if (to === 'blank') {
        return $('.shop-header .inner h1, .shop-header .inner .text').css({'color': undefined});
      }
      $('.shop-header .inner h1, .shop-header .inner .text').css({'color': to});
    });
  });

  //* CTA background color 1
  wp.customize('wps_cta_bgcolor_one', function (value) {
    value.bind(function (to) {
      if (to === 'blank') {
        return $('#front-intro .fp-section-4').css({'background': undefined});
      }
      $('#front-intro .fp-section-4').css({'background': to});
    });
  });

  //* CTA background color 2
  wp.customize('wps_cta_bgcolor_two', function (value) {
    value.bind(function (to) {
      if (to === 'blank') {
        return $('#front-intro .fp-section-5').css({'background': undefined});
      }
      $('#front-intro .fp-section-5').css({'background': to});
    });
  });

  //* CTA background color 1
  wp.customize('wps_cta_bgcolor_three', function (value) {
    value.bind(function (to) {
      if (to === 'blank') {
        return $('#front-intro .fp-section-6').css({'background': undefined});
      }
      $('#front-intro .fp-section-6').css({'background': to});
    });
  });

    //* CTA color 1
  wp.customize('wps_cta_color_one', function (value) {
    value.bind(function (to) {
      if (to === 'blank') {
        return $('#front-intro .fp-section-4 h4, #front-intro .fp-section-4 h3, #front-intro .fp-section-4 p').css({'color': undefined});
      }
      $('#front-intro .fp-section-4 h4, #front-intro .fp-section-4 h3, #front-intro .fp-section-4 p').css({'color': to});
    });
  });

  //* CTA color 2
  wp.customize('wps_cta_color_two', function (value) {
    value.bind(function (to) {
      if (to === 'blank') {
        return $('#front-intro .fp-section-5 h4, #front-intro .fp-section-5 h3, #front-intro .fp-section-5 p').css({'color': undefined});
      }
      $('#front-intro .fp-section-5 h4, #front-intro .fp-section-5 h3, #front-intro .fp-section-5 p').css({'color': to});
    });
  });

  //* CTA color 1
  wp.customize('wps_cta_color_three', function (value) {
    value.bind(function (to) {
      if (to === 'blank') {
        return $('#front-intro .fp-section-6 h4, #front-intro .fp-section-46h3, #front-intro .fp-section-6 p').css({'color': undefined});
      }
      $('#front-intro .fp-section-6 h4, #front-intro .fp-section-6 h3, #front-intro .fp-section-6 p').css({'color': to});
    });
  });

})(jQuery);