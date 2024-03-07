$(function(){
    // "use strict";
    // alert('is Working');
    // $(window).scrollTop(0);
    var WinH = $(window).height(),
        WinW = $(window).width(),
        navHeight = $('nav').innerHeight();
    $('.dress-height-nav').height(navHeight);
    $('.front-section').width(WinW);
    $('.front-section').height(WinH-navHeight);

    $('.li-search a').click(function(){
        "use strict";
        $('.search-collapse').slideToggle(200);
    });
    $('.chose-list li').click(function(){
        "use strict";
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $('.boss-box').hide(300);
        // $('.boss-box').slideUp(300);
        $("."+$(this).data('target')).show(300)
        // $("."+$(this).data('target')).slideDown(300);
    });
    //Scroll To Top
    $(window).on('scroll',function(){
        "use strict";
        if($(window).scrollTop()>1000)
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
        $('html, body').animate({scrollTop:0},1000); // will take two seconds to scroll to the element
    });

    //Plus/mince count
    $('.plus-count').click(function(){
        "use strict";
        if(parseInt($('.count-input').val()) < 5)
        {
            $('.count-input').val(parseInt($('.count-input').val())+1);
        }
    });
    $('.mince-count').click(function(){
        "use strict";
        if(parseInt($('.count-input').val()) > 1)
        {
            $('.count-input').val(parseInt($('.count-input').val())-1);
        }
    });

    //LOGIN
    $('.login-title span:first').click(function(){
        "use strict";
        $(this).addClass('selected-login').siblings().removeClass('selected-signup');
        $('.login-page form').hide();
        $("."+$(this).data('class')).slideDown(500);
    });
    $('.login-title span:last').click(function(){
        "use strict";
        $(this).addClass('selected-signup').siblings().removeClass('selected-login');
        $('.login-page form').hide();
        $("."+$(this).data('class')).slideDown(500);
    });

    //PROFILE
     //upload Profile Image
     $('.upload').click(function(){
        "use strict";
        $('.saveImg').fadeIn(200);
      //   alert($(this).val());
      setTimeout(function(){
          "use strict";
          var val = $(".upload").val();
          if(val == "")
          {
              $('.saveImg').fadeOut();
              // alert("yes");
          }
          // alert($(".upload").val());
      },10000);
    });
    $('.edit-about').click(function(){
        "use strict";
      //   alert($('.p-about').data("text"));
      var text = $('.p-addr').data("text");
      $('.p-addr').replaceWith("<form id='about-form' action='profile.php' method='POST'><textarea name='address' class='form-control txtarea-addr'>"+text+"</textarea><input type='submit' name='edit-addr' value='save' class='btn btn-success'/><input type='button' onclick='closeAbout()' value='close' class='btn btn-info close-about'/></form>");
      
    });

    $('.edit-desc-box').click(function(){
      "use strict";
    //   alert($('.p-about').data("text"));
    var text_p_cin = $('.p-cin').data("text");
    var text_p_city = $('.p-city').data("text");
    var text_p_phone = $('.p-phone').data("text");
    var text_p_dateN = $('.p-dateN').data("text");

    $('.p-cin').replaceWith("<input type='text' class='form-control ch-input ch-input-cin' name='cin' disabled required value='"+text_p_cin+"'/>");
    $('.p-city').replaceWith("<input type='text' class='form-control ch-input ch-input-city' name='city' required value='"+text_p_city+"'/>");
    $('.p-phone').replaceWith("<input type='text' class='form-control ch-input ch-input-phone' name='phone' required value='"+text_p_phone+"'/>");
    $('.p-dateN').replaceWith("<input type='text' class='form-control ch-input ch-input-dateN' name='dateN' required value='"+text_p_dateN+"'/>");

    $('.changeToSubmit').replaceWith("<input type='submit' class='btn btn-success saveDesc' value='save' name='edit-desc'/>");
    $('.changeToClose').replaceWith("<input type='button' class='btn btn-info closeDesc' onclick='closeDesc()' value='close' name='edit-desc'/>");

  });
  $('.edit-username').click(function(){
      "use strict";
      var name = $('.username').data('text');
      $('.username').replaceWith("<input type='text' class='form-control input-name' name='username' value='"+name+"'/>");
      $('.changeToSaveName').replaceWith("<input type='submit' class='btn btn-success saveName' name='edit-name' value='save'/>");
      $('.changeToCloseName').replaceWith("<input type='button' class='btn btn-info closeName' onclick='closeName()' value='close'/>");

      $(this).fadeOut();
  });
//DELETE CONFIRMATION
$(".confirm").on("click",function(){
    "use strict";
    return confirm("Are you sure to delete ?");
});

$(".year").text(new Date().getFullYear());
});