
<script>
//ajax add to CART
$(".addtocart").submit(function(event){
	event.preventDefault();

  var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	var form_data = $(this).serialize(); //Encode form elements for submission

  $.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){ //
		M.toast({html: '<table style="width:80%"><tbody><tr><td>Item Added to cart.</td><td><a href="/cart" style="color:white"><u>Checkout</u></a></td><td>(X)</td></tr></tbody></table>',displayLength: Infinity})
	});

});

$(document).on('click', '#toast-container .toast', function() {
    $(this).fadeOut(function(){
        $(this).remove();
    });
});
</script>
