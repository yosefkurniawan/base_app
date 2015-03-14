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
      var time = time || 1000;
      $j('html, body').animate({
          scrollTop: $(elm).offset().top
      }, time);
    }

  });

})(jQuery);