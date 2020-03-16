@include('admins.layout.header')
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
      <th>Name</th>
      <th>City</th>
      <th>Contact Number</th>
      <th>Branch Availablity</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($branches as $branch)
    <tr>
      <td>{{$branch->name}}</td>
      <td>{{$branch->city}}</td>
      <td>{{$branch->contact_number}}</td>
      <td><div class="switch">
    <label>
      <input id="availablity{{$branch->id}}" onclick="event.preventDefault();availablity({{$branch->id}});" type="checkbox" @if ($branch->is_available == TRUE)
        checked
      @endif>
      <span class="lever"></span>
    </label>
  </div>
      </td>
      <td><a href="/notadmin/branch/edit/{{$branch->id}}" class="btn">Edit</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@include('admins.layout.footer')

<script type="text/javascript">

function availablity(id)
{
  $('#overlay').show();
  $.ajax({
  url: "/notadmin/branch/availablity-switch/"+id,
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
