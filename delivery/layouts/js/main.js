$(document).ready(function(){
    $(".box-comment").hover(
        function() {
            $(this).children(".box-actions").children().children().css( "right", "0" );
        },
        function() {
            $(this).children(".box-actions").children().children().css( "right", "-140px" );
            // $(this).children(".box-actions").children().children().css( "display", "none" );
        }
      );
    // $('#img-file').on('change',function(){
    //     "use strict";
    //     // alert(this.files);
    //     console.log(this.files);
    //     // var src = $(this).val();
    //     // $('.new-img-insert').attr("src",src);
    // });


    // const input = document.getElementById('img-file');

    // input.addEventListener('change', function (e) {
    //     const reader = new FileReader()
    //     reader.onload = function () {
    //     var src = reader.result
    //     $('.new-img-insert').attr("src",src);
    //     }
    //     reader.readAsDataURL (input.files [0]) 
    // }, false);

    $('.new-img-insert').on('click',function(){
        "use strict";
        // input.click();
        $('#img-file').click();
    });
    // const input = document.getElementById('img-file');
    //     input.addEventListener('change', function (e) {
    //     //  console. Log(input. files);
    //     const reader = new FileReader()
    //     reader.onload = function () {

    //         const img = new Image()
    //     img.src = reader.result
    //     document.body. appendChild(img)
    //     }
    //     reader.readAsDataURL (input.files [0]) 
    //     }, false);



    $('#add-product-btn').on('click',function(e){
        "use strict";
        if($('#addproName').val()==""||$('#addproPrice').val()==""||$('#addproDesc').val()==""||$('#addproCat').val()=="0"||$('#img-file').val()=="")
        {
            e.preventDefault();
            swal({
                title: "Notice",
                text: "you should to complete all information about product before insert it!",
                // icon: "warning",
                icon: "error"
              });
            // swal("Hello world!");

            if($('#addproName').val()=="")
            {
                $('#addproName').css({"boxShadow":"0px 0px 3px #f00"});
            }
            else
            {
                $('#addproName').css({"boxShadow":"none"});
            }
            if($('#addproPrice').val()=="")
            {
                $('#addproPrice').css({"boxShadow":"0px 0px 3px #f00"});
            }
            else
            {
                $('#addproPrice').css({"boxShadow":"none"});
            }
            if($('#addproCat').val()=="0")
            {
                $('#addproCat').css({"boxShadow":"0px 0px 3px #f00"});
            }
            else
            {
                $('#addproCat').css({"boxShadow":"none"});
            }
            if($('#addproDesc').val()=="")
            {
                $('#addproDesc').css({"boxShadow":"0px 0px 3px #f00"});
            }
            else
            {
                $('#addproDesc').css({"boxShadow":"none"});
            }
            if($('#img-file').val()=="")
            {
                $('.imgFile-label').css({"boxShadow":"0px 0px 3px #f00"});
            }
            else
            {
                $('.imgFile-label').css({"boxShadow":"none"});
            }
            if($('#addproPromotion').val()=="")
            {
                $('#addproPromotion').css({"boxShadow":"0px 0px 3px #f00"});
            }
            else
            {
                $('#addproPromotion').css({"boxShadow":"none"});
            }
            if($('#addproRating').val()=="")
            {
                $('#addproRating').css({"boxShadow":"0px 0px 3px #f00"});
            }
            else
            {
                $('#addproRating').css({"boxShadow":"none"});
            }
        }
    });
    $('#edit-product-btn').on('click',function(e){
        "use strict";
        if($('#addproName').val()==""||$('#addproPrice').val()==""||$('#addproDesc').val()==""||$('#addproCat').val()=="0")
        {
            e.preventDefault();
        
            swal({
                title: "Notice",
                text: "you should to complete all information about product before update it!",
                // icon: "warning",
                icon: "error"
              });
            // swal("Hello world!");

            if($('#addproName').val()=="")
            {
                $('#addproName').css({"boxShadow":"0px 0px 3px #f00"});
            }
            else
            {
                $('#addproName').css({"boxShadow":"none"});
            }
            if($('#addproPrice').val()=="")
            {
                $('#addproPrice').css({"boxShadow":"0px 0px 3px #f00"});
            }
            else
            {
                $('#addproPrice').css({"boxShadow":"none"});
            }
            if($('#addproCat').val()=="0")
            {
                $('#addproCat').css({"boxShadow":"0px 0px 3px #f00"});
            }
            else
            {
                $('#addproCat').css({"boxShadow":"none"});
            }
            if($('#addproDesc').val()=="")
            {
                $('#addproDesc').css({"boxShadow":"0px 0px 3px #f00"});
            }
            else
            {
                $('#addproDesc').css({"boxShadow":"none"});
            }
            if($('#addproPromotion').val()=="")
            {
                $('#addproPromotion').css({"boxShadow":"0px 0px 3px #f00"});
            }
            else
            {
                $('#addproPromotion').css({"boxShadow":"none"});
            }
            if($('#addproRating').val()=="")
            {
                $('#addproRating').css({"boxShadow":"0px 0px 3px #f00"});
            }
            else
            {
                $('#addproRating').css({"boxShadow":"none"});
            }
        }
    });
    $(".confirm-delete").on('click',function(e){
        "use strict";
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Item!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              swal("Poof! Your Item has been deleted!", {
                icon: "success",
              })
              .then(() => {
                window.open($(this).attr("href"),'_self');
            });
             
            }
          });
    });
    // $('*[required]').css("display","none");
    $('#btn-add-cat').on('click',function(e){
        "use strict";
        if($('#addCatName').val()==""||$('#addCatDesc').val()=="")
        {
            e.preventDefault();
            swal({
                title: "Notice",
                text: "you should to complete all information about category before Insert it!",
                icon: "error"
              });

            if($('#addCatName').val()=="")
            {
                $('#addCatName').css({"boxShadow":"0px 0px 3px #f00"});
            }
            else
            {
                $('#addCatName').css({"boxShadow":"none"});
            }
            if($('#addCatDesc').val()=="")
            {
                $('#addCatDesc').css({"boxShadow":"0px 0px 3px #f00"});
            }
            else
            {
                $('#addCatDesc').css({"boxShadow":"none"});
            }
        }
    });
    $('#btn-edit-cat').on('click',function(e){
        "use strict";
        if($('#editCatName').val()==""||$('#editCatDesc').val()=="")
        {
            e.preventDefault();
            swal({
                title: "Notice",
                text: "you should to complete all information about category before update it!",
                icon: "error"
              });

            if($('#editCatName').val()=="")
            {
                $('#editCatName').css({"boxShadow":"0px 0px 3px #f00"});
            }
            else
            {
                $('#editCatName').css({"boxShadow":"none"});
            }
            if($('#editCatDesc').val()=="")
            {
                $('#editCatDesc').css({"boxShadow":"0px 0px 3px #f00"});
            }
            else
            {
                $('#editCatDesc').css({"boxShadow":"none"});
            }
        }
    });
  });