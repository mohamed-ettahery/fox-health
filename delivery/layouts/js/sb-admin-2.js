(function($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
      $('#sidebarToggle i').attr('class','fas fa-chevron-right');
    }
    else
    {
      $('#sidebarToggle i').attr('class','fas fa-chevron-left');
    }
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
    
    // Toggle the side navigation when window is resized below 480px
    if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
      $("body").addClass("sidebar-toggled");
      $(".sidebar").addClass("toggled");
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

    //Scroll To Top
    $(window).on('scroll',function(){
      "use strict";
      if($(window).scrollTop()>100)
      {
          $('.scroll-to-top').fadeIn(300);
      }
      else
      {
          $('.scroll-to-top').fadeOut(300);
      }
  });
  $('.scroll-to-top').click(function(){
      "use strict";
      // $(window).scrollTop(0);
      $('html, body').animate({scrollTop:0},300); // will take two seconds to scroll to the element
  });

})(jQuery); // End of use strict
