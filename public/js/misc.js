(function($) {
  'use strict';
  $(function() {
    // $('#sidebar .nav').perfectScrollbar();
    $('.container-scroller').perfectScrollbar( {suppressScrollX: true});
    $('[data-toggle="minimize"]').on("click", function () {
      $('body').toggleClass('sidebar-icon-only');
    });
  });

  $(".form-check label,.form-radio label").append('<i class="input-helper"></i>');
})(jQuery);
(function($) {
    'use strict';
    $(function() {
      // Toggle sidebar
      $('[data-toggle="offcanvas"]').on('click', function () {
        $('.sidebar').toggleClass('active');
        $('body').toggleClass('sidebar-active');
      });

      // Close sidebar when clicking outside
      $(document).on('click', function(e) {
        if ($(window).width() < 992) {
          if (!$(e.target).closest('.sidebar, .navbar-toggler').length) {
            $('.sidebar').removeClass('active');
            $('body').removeClass('sidebar-active');
          }
        }
      });

      // Perfect scrollbar initialization
      $('.container-scroller').perfectScrollbar({suppressScrollX: true});
    });
  })(jQuery);
