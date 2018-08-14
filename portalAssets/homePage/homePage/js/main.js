//set button id on click to hide first modal
$("#signin").on( "click", function() {
        $('#myModal1').modal('hide');  
});
//trigger next modal
$("#signin").on( "click", function() {
        $('#myModal2').modal('show');  
});

$("#signUp").on( "click", function() {
        $('#myModal3').modal('hide');  
});
//trigger next modal
$("#signUp").on( "click", function() {
        $('#myModal4').modal('show');  
});


$("#organization").on( "click", function() {
        $('#myModal5').modal('hide');  
});
//trigger next modal
$("#organization").on( "click", function() {
        $('#myModal6').modal('show');  
});

$("#organization3").on( "click", function() {
        $('#myModal7').modal('show');  
});





$("#myModal1").on('hidden.bs.modal', function (event) {
  if ($('.modal:visible').length) {
    $('body').addClass('modal-open');
  }
});
$("#myModal2").on('hidden.bs.modal', function (event) {
  if ($('.modal:visible').length) {
    $('body').addClass('modal-open');
  }
});
$("#myModal3").on('hidden.bs.modal', function (event) {
  if ($('.modal:visible').length) {
    $('body').addClass('modal-open');
  }
});
$("#myModal4").on('hidden.bs.modal', function (event) {
  if ($('.modal:visible').length) {
    $('body').addClass('modal-open');
  }
});

$("#myModal5").on('hidden.bs.modal', function (event) {
  if ($('.modal:visible').length) {
    $('body').addClass('modal-open');
  }
});
$("#myModal6").on('hidden.bs.modal', function (event) {
  if ($('.modal:visible').length) {
    $('body').addClass('modal-open');
  }
});

$("#myModal7").on('hidden.bs.modal', function (event) {
  if ($('.modal:visible').length) {
    $('body').addClass('modal-open');
  }
});













// (function($) {

// $(document)
//     .on( 'hidden.bs.modal', '.modal', function() {
//         $(document.body).removeClass( 'modal-scrollbar' );
//     })
//     .on( 'show.bs.modal', '.modal', function() {
//         // Bootstrap's .modal-open class hides any scrollbar on the body,
//         // so if there IS a scrollbar on the body at modal open time, then
//         // add a right margin to take its place.
//         if ( $(window).height() < $(document).height() ) {
//             $(document.body).addClass( 'modal-scrollbar' );
//         }
//     });

// })(window.jQuery);