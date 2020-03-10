
    setTimeout(function() {
      $('#successMessage').fadeOut('fast');
  }, 3000); // <-- time in milliseconds

(function($){
  $(function(){


 $('.timepicker').timepicker();

$('.fixed-action-btn').floatingActionButton();
    $('.sidenav').sidenav();
    $(".dropdown-trigger").dropdown({coverTrigger: false});
      $('select').formSelect();
	 $('.slider').slider({indicators:false});
  $('.collapsible').collapsible();





  }); // end of document ready
})(jQuery); // end of jQuery name space
