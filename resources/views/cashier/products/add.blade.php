@include('cashier.layout.header')

<form method="POST" id="myform" enctype="multipart/form-data" action="{{ url("cashier/product/add") }}">
    @csrf
    <input type="text" name="name" id="product_name" placeholder="Product Name" required>

    <input id="slug" type="text" name="slug" placeholder="Product slug">



    <select name="category" required>
      <option value="" selected disabled>Select Category</option>
        @foreach ($leefCategries as $cat)
          <option value="{{$cat->id}}">{{$cat->name}}</option>
        @endforeach
    </select>




    <div class="file-field input-field">
        <div class="btn">
          <span>Choose Image</span>
          <input name="image" type="file">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text" required>
        </div>
      </div>

      <p>
     <label>
       <input name="product_type" value="simple" type="radio"  />
       <span>Simple</span>
     </label>
   </p>

   <p>
  <label>
    <input name="product_type" value="variable" type="radio" />
    <span>Variable</span>
  </label>
  </p>

    <span id="pricing"></span>


      <p>
        <label>
          <input type="checkbox" id="anytime" onclick="anytimefunc()" name="anytime" value="yes" checked/>
          <span>THIS DISH WILL BE AVAILABLE AT ANYTIME IN THE RESTAURANT WORKING HOURS</span>
        </label>
      </p>

      <span id="timing">

  </span>

    <button type="submit" class="btn btn-primary">
        Add
    </button>





</form>

@if(Session::has('success'))

<div id="successMessage" class="alert-message">


    {{Session::get('success')}}
</div>
@endif



@include('cashier.layout.footer')
<script type="text/javascript">
    //slug
    $('#product_name').on('change', function() {
        $('#slug').val($('#product_name').val().toLowerCase().split(' ').join('-'));

    });

//checkbox anytime
function anytimefunc()
{
  if ($('#anytime').prop('checked')) {
    $('#timing').html('');
  }
  else {
    $('#timing').html('<input type="text" name="start_time" placeholder="Start Time" class="timepicker" required>'+
    '<input type="text" name="end_time" placeholder="End Time" class="timepicker" required>');
    $('.timepicker').timepicker();


  }
}

//simple or variable product

$('input[type=radio][name=product_type]').change(function() {
    if (this.value == 'simple') {
      $('#pricing').html(''+
      '<input type="text" name="regular_price" placeholder="Regular Price" required>'+
      '<input type="text" name="offer_price" placeholder="Offer Price (ignore if no offer)">');
    }
    else if (this.value == 'variable') {
      $('#pricing').html(''+
      '<div class="row" name="row[0]">'+
        '<div class="col l4">'+
          '<input type="text" name="option_name[0]" placeholder="Option Name" value="" required>'+
        '</div>'+
        '<div class="col l8">'+
          '<input style="width:37%;margin-right:10px" type="text" name="regular_price[0]" placeholder="Regular Price" value="" required>'+
          '<input style="width:37%" type="text" name="offer_price[0]" placeholder="Offer Price" value="">'+
          '<a href="#" name="addbtn[0]" onclick="event.preventDefault(); addOption(0)" style="width:10%">Add More</a>'+
        '</div>'+

      '</div>'+
    '');
    }
});

function addOption(id){
  var inc = id + 1;
  $('a[name="addbtn['+id+']"]').remove();
  $('#pricing').append(''+
  '<div class="row" name="row['+inc+']">'+
    '<div class="col l4">'+
      '<input type="text" name="option_name['+inc+']" placeholder="Option Name" value="" required>'+
    '</div>'+
    '<div class="col l8">'+
      '<input style="width:37%;margin-right:10px" type="text" name="regular_price['+inc+']" placeholder="Regular Price" value="" required>'+
      '<input style="width:37%" type="text" name="offer_price['+inc+']" placeholder="Offer Price" value="">'+
      '<div name="buttonsdiv['+inc+']" style="width=10%" class="right">'+
      '<a href="#" name="remove['+inc+']" onclick="event.preventDefault(); removeOption('+inc+')">Delete</a><br>'+
      '<a href="#" name="addbtn['+inc+']" onclick="event.preventDefault(); addOption('+inc+')">Add More</a>'+
      '</div>'+
'</div>'+
  '</div>'+
'');
}


function removeOption(id){
  $('div[name="row['+id+']"]').remove();
  $('a[name="addbtn['+id+']"]').remove();

  var dec = id - 1;
  if (id == 1) {
    $('#pricing div[name="row['+dec+']"] div[class="col l8"]').append(''+
      '<a href="#" name="addbtn[0]" onclick="event.preventDefault(); addOption(0)" style="width:10%">Add More</a>'+
    '');
  }
  else {

    $('#pricing div[name="row['+dec+']"] div[name="buttonsdiv['+dec+']"]').append(''+
    '<a href="#" name="addbtn['+dec+']" onclick="event.preventDefault(); addOption('+dec+')">Add More</a>'+
    '');
  }

}

</script>
