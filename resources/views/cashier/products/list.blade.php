@include('cashier.layout.header')
<style media="screen">
#overlay {
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
text-align: center;
background-color: #000;
filter: alpha(opacity=50);
-moz-opacity: 0.5;
opacity: 0.5;

}

#overlay span {
  padding: 5px;
  border-radius: 5px;
  color: #000;
  background-color: #fff;
  position:relative;
  top:50%;
}

</style>
<div id="overlay" style="display:none">
    <span>Please wait...</span>
</div>
@if(Session::has('success'))

<div id="successMessage" class="alert-message">


{{Session::get('success')}}
</div>
@endif
<table class="center">
  <thead>
    <tr>
      <th>ID</th>
      <th></th>
      <th>Name</th>
      <th>Availablity</th>
      <th>Category</th>
      <th>Approved?</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($products as $product)
    <tr>
        <td>{{$product->id}}</td>
      <td><img width="100px" src="/storage/{{$product->image}}" alt=""></td>
      <td>{{$product->name}}</td>
      <td><div class="switch">
    <label>
      <input id="availablity{{$product->id}}" onclick="event.preventDefault();availablity({{$product->id}});" type="checkbox" @if ($product->is_available == TRUE)
        checked
      @endif>
      <span class="lever"></span>
    </label>
  </div>
      </td>
      <td>{{$product->category->name}}</td>
      <td>@if ($product->is_approved == true)
        APPROVED
      @else
        PENDING
      @endif</td>
      <td><a href="/cashier/product/edit/{{$product->id}}" class="btn">Edit</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@include('cashier.layout.footer')
<script type="text/javascript">

function availablity(id)
{
  $('#overlay').show();
  $.ajax({
  url: "/cashier/product/availablity-switch/"+id,
  type: "get", //send it through get method
  success: function(data) {
    $('#overlay').hide();
    if (data==true) {
        $('#availablity'+id).prop('checked',true);
    }
    else {
      $('#availablity'+id).prop('checked',false);
    }

  },
  error: function(xhr) {
    $('#overlay').hide();
  }
});
}

</script>
