@include('public.layout.header')

@include('public.components.OptionModal')

@include('public.components.CartModal')


<style media="screen">
input[type=number]:focus {
    outline: none !important;
}
header, main, footer {
    padding-left: 300px;
  }

  @media only screen and (max-width : 992px) {
    header, main, footer {
      padding-left: 0;
    }
  }
</style>
@include('public.components.sidebar')
<main>



  <div class="row">
    <h4>Selected Branch: {{$branch->name}} <a class="modal-trigger" id="modalSelect" href="#modal1"><u>Change?</u></a> </h4>
  </div>
  <div class="row">
    <ul style="position: -webkit-sticky; /* Safari */
  position: sticky;
  top: 0;" class="tabs hide-on-large-only">
      @foreach ($rootCategries as $rootCat)
        <li style="margin-left:5px;margin-right:5px" class="tab"><a class="puranmal cream" href="#{{$rootCat->id}}">{{$rootCat->name}}</a></li>
      @include('public.subcatsTabs', ['cats' => $rootCat->children])
      @endforeach
     </ul>
    <div class="col l8">
      <table>
        <tbody>
          @foreach ($rootCategries as $rootCat)
            <tr id="{{$rootCat->id}}" class="scrollspy">
              <td colspan="4" style="text-align:center">{{strtoupper($rootCat->name)}}</td>
            </tr>
              @if ($rootCat->children->count() > 0)
                    @include('public.subcatsMenu', ['cats' => $rootCat->children])
              @else
                @foreach ($rootCat->products->where('branch_id',$branch_id)->where('is_approved',true) as $product)
                  <tr>

                          <td><img width="100px" src="/storage/{{$product->image}}" alt=""></td>
                          <td>{{$product->name}}</td>



                          <td>

                              AED {{$product->options->min('price')}}
                          </td>
                          <td style="text-align:center">@if ($product->options->first->name === NULL AND count($product->addons) <= 0)
                            <form action="#" method="post">
                              <input type="hidden" name="option" value="{{(isset($product->options[0]->id) ? $product->options[0]->id : '') }}">

                                <button type="submit" class="submit_form btn" style="width:100px" name="button">ADD</button>
                            </form>

                          @else
                          <a href="#" style="width:100px" onclick="event.preventDefault();customize({{$product->id}});"  class="btn">ADD</a><br>Customizable
                          @endif</td>
                        </tr>
                @endforeach
              @endif

          @endforeach
        </tbody>

    </table>

    </div>


    <div  class="col hide-on-med-and-down l4 ">

        <div style="min-height:250px; height:100%;width:400px;padding:10px" class="toc-wrapper puranmal cream center">
          <h5 class="center">CART</h5>


          <div id="loader">
            <div class="preloader-wrapper small active">
              <div class="spinner-layer spinner-green-only">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>
            </div>
          </div>


          <div class="cart">

          </div>
        </div>


    </div>


  </div>


</main>
@include('public.components.mobilebar')
    @include('public.layout.footer')

<script>

function customize(id)
{
  $.ajax({
  url: "/getProdOpts/"+id,
  type: "get", //send it through get method
  beforeSend: function(){
          $('#productOpts').html('');
},
  success: function(data) {
      $('#productOpts').append('<form method="post">');
      if (data['options'].length!==0) {
        $('#productOpts form').append('<h4>Choose option</h4>');
          for (var i = 0; i < data['options'].length; ++i)
          {
              $('#productOpts form').append('<p>'+
    '<label>'+
      '  <input name="option" required type="radio" value="'+data['options'][i].id+'" />'+
        '<span>'+data['options'][i].name+' AED. '+data['options'][i].price+'</span>'+
      '</label>'+
    '</p>');
          }
      }

      if (data['addons'].length!==0) {
        $('#productOpts form').append('<h4>Choose Addons</h4>');
        for (var i = 0; i < data['addons'].length; ++i)
        {
            $('#productOpts form').append('<p>'+
  '<label>'+
    '  <input name="addons[]" type="checkbox" value="'+data['addons'][i].id+'" />'+
      '<span>'+data['addons'][i].name+' AED. '+data['addons'][i].price+'</span>'+
    '</label>'+
  '</p>');
        }
      }


  },

  complete:function(){
   $('#productOpts form').append('<button type="submit" class="submit_form btn" style="width:100px" name="button">ADD</button>');
   }
});


  var elem = document.querySelector('#customize');
  var instance = M.Modal.getInstance(elem);
  instance.open();
}

//onpage load
$(document).ready(function(){
  $('.tabs').tabs();

    $('.sidenav').sidenav();
     $('.scrollspy').scrollSpy();


     $.ajax({
     url: "/OnPageLoad",
     type: "get", //send it through get method
     beforeSend: function(){
             $('#loader').show();
   },
   success: function(data) {
         $('#loader').hide();
       CartUpdate(data);
   },

     complete:function(){
       $('#loader').hide();

      }
   });

  });



  setTimeout(function() {
       var tocWrapperHeight = 260; // Max height of ads.
       var tocHeight = $('.toc-wrapper .table-of-contents').length
         ? $('.toc-wrapper .table-of-contents').height()
         : 0;
       var socialHeight = 95; // Height of unloaded social media in footer.
       var footerOffset = $('body > footer').first().length
         ? $('body > footer')
             .first()
             .offset().top
         : 0;
       var bottomOffset = footerOffset - socialHeight - tocHeight - tocWrapperHeight;

       if ($('nav').length) {
         console.log('Nav pushpin', $('nav').height());
         $('.toc-wrapper').pushpin({
           top: $('nav').height(),
           bottom: bottomOffset
         });
       } else if ($('#index-banner').length) {
         $('.toc-wrapper').pushpin({
           top: $('#index-banner').height(),
           bottom: bottomOffset
         });
       } else {
         $('.toc-wrapper').pushpin({
           top: 0,
           bottom: bottomOffset
         });
       }
     }, 100);



//add to CART

$('#loader').hide();
$(document).on('click','.submit_form',function(){
  $.ajax({

    beforeSend: function(){
        $('#loader').show();
},


         type: "POST",
         url: "/add-to-cart",
         data: $(this).parent().serialize(), // changed
         success: function(data) {
             $('#loader').hide();
            CartUpdate(data);
         },

         complete:function(){
          $('#loader').hide();
          var elem = document.querySelector('#customize');
          var instance = M.Modal.getInstance(elem);
          instance.close();
          }
  });
  return false; // avoid to execute the actual form submission.
});

$(document).on('change','[type="number"]',function(){
    var quantity = $(this).val();
    var cart_item_id = $(this).attr('id');

    $.ajax({
    url: "/OptionQuantity/"+cart_item_id+"/"+quantity,
    type: "get", //send it through get method
    beforeSend: function(){
            $('#loader').show();
  },
  success: function(data) {
        $('#loader').hide();
      CartUpdate(data);
  },

    complete:function(){
      $('#loader').hide();

     }
  });
});

//disable input number typing (quantity)
$(document).on('keypress','[type="number"]',function(evt){

    evt.preventDefault();
});

function CartUpdate(data){


  $('#mobilebar').show();
  $('#MobileBarContent').html(data.cartitems.length+' item(s) in the cart AED '+data.cart.subtotal+' | VIEW');
  $('.cart').html('<table class="carttable"><tbody>');
  if(data.cartitems)
  {
  for (var i = 0; i < data.cartitems.length; i++) {
    $('.carttable').append('<tr>'+
    '<td id="'+i+'">'+data.cartitems[i].name+'<a onclick="removeCart('+data.cartitems[i].id+');" href="#"><i class="material-icons">close</i></a><br> AED. '+data.cartitems[i].unitprice+'<br></td>'+
    '<td><input style="width:40px; text-align:center" id="'+data.cartitems[i].id+'" type=number value="'+data.cartitems[i].quantity+'"></td>'+
      '<td class="right">'+data.cartitems[i].totalprice+'</td>'+
    '</tr>');
    for (var j = 0; j < data.cartitems[i].addons.length; j++) {
      $('.carttable #'+i+'').append(data.cartitems[i].addons[j].name);
    }
  }


    $('.carttable').append('<tr><td colspan="2">TOTAL: </td><td class="right"> AED '+data.cart.subtotal+'</td></tr>');
    $('.carttable').append('<tr><td colspan="2">DELIVERY FEE: </td><td class="right"> AED '+data.cart.delivery_fee+'</td></tr>');
    $('.carttable').append('<tr><td colspan="2">GRAND TOTAL: </td><td class="right"> AED '+data.cart.grand_total+'</td></tr>');
    $('.carttable').append('</table></tbody>');
    $('.cart').append('<a style="margin-top:15px;margin-bottom:15px" class="btn" href="/checkout">Procced To checkout</a>');
    }
    else {
      $('.cart').html('');
      $('#mobilebar').hide();
  }
}


function removeCart(CartItemId)
{
  $.ajax({
  url: "/removeCart/"+CartItemId,
  type: "get", //send it through get method
  beforeSend: function(){
          $('#loader').show();

},
success: function(data) {
    $('#loader').hide();
    CartUpdate(data);
},

  complete:function(){
    $('#loader').hide();

   }
});
}





</script>
