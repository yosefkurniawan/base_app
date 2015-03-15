/*
 * Global JS Helper
 *
 * Description:
 * - Contain JS helper for global use
 */
(function($j){
  $j.Class.extend('GlobalHelper',
  
  /* @static */
  {
    // var: value
  },

  /* @prototype */
  {
    init: function( ) {

    },

    // animation
    animation: function( x, animatedObj ){
      $j('body').addClass('animation-running');
      animatedObj.removeClass('fadeIn').addClass(x);

      animatedObj.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
          $j('body').removeClass('animation-running');
          animatedObj.removeClass(x);
      });
    },

    // show Message
    show_message: function(htmlMsg, animation) {
      if (typeof animation == 'undefined') {
        var animation = fadeIn;
      }else{
        var animation = animation;
      }

      if ($j('#content').hasClass('table-layout')) {
        $j('#content > .tray-center > .alert').remove();
        $j('#content > .tray-center').prepend(htmlMsg);
        $j('#content > .tray-center > .alert').addClass('animated '+animation);
      }else{
        $j('#content > .alert').remove();
        $j('#content').prepend(htmlMsg);
        $j('#content > .alert').addClass('animated '+animation);
      }
      globalhelper.scrollTo('body',200);
    },

    // ajax error
    ajax_error: function(msg) {
      var message = '';
      if (!msg) {
        message = 'Ajax request was failed';
      }else{
        message = msg;
      }
      var html = '<div class="alert alert-danger alert-dismissable">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                  '<i class="fa fa-remove pr10"></i>'+message+
                  '</div>';
    },

    // scroll to sepcified elm
    scrollTo: function(elm,time) {
      if (typeof time == 'undefined') {
        var time = 1000;
      }else{
        var time = time
      }

      $j('html, body').animate({
          scrollTop: $(elm).offset().top
      }, time);
    }

  });

})(jQuery);