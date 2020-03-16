(function($){
  $(function(){

    



    $('.materialboxed').materialbox();

    $('select').formSelect();


    $("#togglesidenav").click(function() {
        var elem = document.querySelector('#productoptions');
        var instance = M.Sidenav.getInstance(elem);
            if (instance.isOpen) {
              instance.close();
            }
            else {
                instance.open();
            }
        });


        $('.tabs').tabs();
  $('.parallax').parallax();
   $('.sidenav').sidenav();

     $(".dropdown-trigger").dropdown({coverTrigger: false,constrainWidth: false});

  $('.collapsible').collapsible();





  }); // end of document ready
//viewport animation
  $(document).ready(function() {



  // Check if element is scrolled into view
  function isScrolledIntoView(elem) {
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
  }
  // If element is scrolled into view, fade it in
  $(window).scroll(function() {
    $('.scroll-animated').each(function() {
      var className = $('.scroll-animated').attr('class');

       var res = className.split("animate-");

      if (isScrolledIntoView(this) === true) {

        $(this).addClass('animated '+res[1]);
      }
    });
  });
});
//viewport animation


//mobile bottom navigation

var navItems = document.querySelectorAll(".mobile-bottom-nav__item");
navItems.forEach(function(e, i) {
	e.addEventListener("click", function(e) {
		navItems.forEach(function(e2, i2) {
			e2.classList.remove("mobile-bottom-nav__item--active");
		})
		this.classList.add("mobile-bottom-nav__item--active");
	});
});

//mobile bottm navigation

})(jQuery); // end of jQuery name space

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems);

  });

//quantity
  $('.quantity').change( function() {
  updateQuantity();
});
function updateQuantity(){
  alert("sdfdsf");
}
