@include('cashier.layout.header')

<form method="POST" id="myform" enctype="multipart/form-data" action="{{ url("cashier/product/update") }}">
    @csrf
    <input type="text" name="name" id="product_name" placeholder="Product Name" value="{{$product->name}}" required>

    <input id="slug" type="text" name="slug" value="{{$product->slug}}" placeholder="Product slug">


    <select name="category" required>
      <option value="" selected disabled>Select Category</option>
        @foreach ($leefCategries as $cat)
          <option value="{{$cat->id}}" @if ($cat->id === $product->category_id)
            selected
          @endif>{{$cat->name}}</option>
        @endforeach
    </select>

    <img src="/storage/{{$product->image}}" alt="" width="200px">
    <div class="file-field input-field">
        <div class="btn">
          <span>Replace Image</span>
          <input name="image" type="file">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
        </div>
      </div>

      <p>
     <label>
       <input name="product_type" @if (count($product->options)===1 AND $product->options->first->name === NULL)
         checked
       @endif value="simple" type="radio"  />
       <span>Simple</span>
     </label>
   </p>

   <p>
  <label>
    <input name="product_type" @if (count($product->options)>=1 AND $product->options->first->name !== NULL)
      checked
    @endif value="variable" type="radio" />
    <span>Variable</span>
  </label>
  </p>
    <span id="pricing">

    @if (count($product->options)===1 AND $product->options->first->name === NULL)
      @foreach ($product->options as $option)
        <input type="text" name="price" value="{{$option->price}}" placeholder="Price" required>

      @endforeach
    @else

      @foreach ($product->options as $option)
        <div class="row" name="row[{{$loop->index}}]">
          <div class="col l4">
          <input type="text" name="option_name[{{$loop->index}}]" placeholder="Option Name" value="{{$option->name}}" required>
          </div>
          <div class="col l8">
          <input style="width:37%;margin-right:10px" type="text" name="price[{{$loop->index}}]" placeholder="Price" value="{{$option->price}}" required>

          <div name="buttonsdiv['+inc+']" style="width=10%" class="right">
          <a href="#" name="remove[{{$loop->index}}]" onclick="event.preventDefault(); removeOption({{$loop->index}})">Delete</a><br>
          <a href="#" name="addbtn[{{$loop->index}}]" onclick="event.preventDefault(); addOption({{$loop->index}})">Add More</a>
          </div>

        </div>

        </div>
      @endforeach
   @endif
    </span>


      <p>
        <label>
          <input type="checkbox" id="anytime" onclick="anytimefunc()" name="anytime" value="yes" @if ($product->start_time===NULL)
            checked
          @endif/>
          <span>THIS DISH WILL BE AVAILABLE AT ANYTIME IN THE RESTAURANT WORKING HOURS</span>
        </label>
      </p>

      <span id="timing">
        @if ($product->start_time!==NULL)
        <input type="text" name="start_time" value="{{date("g:i a", strtotime($product->start_time))}}" placeholder="Start Time" class="timepicker" required>
        <input type="text" name="end_time" value="{{date("g:i a", strtotime($product->end_time))}}"  placeholder="End Time" class="timepicker" required>
        @endif
      </span>

      <hr>
      <h6>Applicable Addons:</h6>
          @foreach ($addons as $addon)

                  <p>
                    <label>
                      <input type="checkbox" name="addons[]" value="{{$addon->id}}" @foreach ($product->addons as $p_addon)
                        @if ($p_addon->id === $addon->id)
                          checked
                        @endif
                      @endforeach />
                      <span>{{$addon->name}} -- AED. {{$addon->price}}</span>
                    </label>
                  </p>

          @endforeach


      <input type="hidden" name="product_id" value="{{$product->id}}">
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
      '<input type="text" name="price" placeholder="Price" required>');

    }
    else if (this.value == 'variable') {
      $('#pricing').html(''+
      '<div class="row" name="row[0]">'+
        '<div class="col l4">'+
          '<input type="text" name="option_name[0]" placeholder="Option Name" value="" required>'+
        '</div>'+
        '<div class="col l8">'+
          '<input style="width:37%;margin-right:10px" type="text" name="price[0]" placeholder="Price" value="" required>'+

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
      '<input style="width:37%;margin-right:10px" type="text" name="price['+inc+']" placeholder="Price" value="" required>'+
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
