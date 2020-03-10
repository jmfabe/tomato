@include('admins.layout.header')

        <form method="POST" enctype="multipart/form-data" action="{{ url("notadmin/branch/add") }}">
        @csrf
              <input type="text" name="name" id="location_name" placeholder="location name" required>

              <input type="file" name="cover_image" required>

              <input id="slug" type="text" name="slug" placeholder="location slug">

              <input type="text" name="type" placeholder="location type">

              <input type="text" name="map_link" placeholder="map_link">

              <input type="text" name="city" placeholder="City">

                <input type="text" name="area" placeholder="Area">

              <input type="text" name="address" placeholder="address">

              <input type="text" name="cuisines" placeholder="cuisines">

              HOURS:
              <table>
                <tbody>


                  @for ($i = 0; $i < 7; $i++)
                    <tr>
                      <td style="width:10%">
                        @switch($i)

                          @case(0)
                          SUNDAY
                          @break

                          @case(1)
                          MONDAY
                          @break

                          @case(2)
                          TUESDAY
                          @break

                          @case(3)
                          WEDNESDAY
                          @break

                          @case(4)
                          THURSDAY
                          @break

                          @case(5)
                          FRIDAY
                          @break

                          @case(6)
                          SATURDAY
                          @break


                        @endswitch
                      </td>
                      <td style="width:10%"><div class="switch"><label>
                                <input id="{{$i}}" type="checkbox">
                                <span class="lever"></span></label>
                      </div></td>
                      <td style="width:10%"><span id="{{$i}}Status">CLOSED</span></td>
                      <td><span id="{{$i}}Hours"></span></td>
                    </tr>
                  @endfor





                </tbody>
              </table>

















              <input type="text" name="contact_number" placeholder="contact_number" required>

              <button type="submit" class="btn btn-primary">
                      Add
              </button>





        </form>

        @if(Session::has('success'))

    <div id="successMessage" class="alert-message">


        {{Session::get('success')}}
    </div>
@endif



@include('admins.layout.footer')
<script type="text/javascript">

//slug
$('#location_name').on('change', function() {
$('#slug').val($('#location_name').val().toLowerCase().split(' ').join('-'));

});

</script>


<script>
function delTime(id, inc)
{
    $('input[name="open['+id+']['+inc+']"]').remove();
  $('input[name="close['+id+']['+inc+']"]').remove();
  $('a[name="rmbtn['+id+']['+inc+']"]').remove();
  $('a[name="addbtn['+id+']['+inc+']"]').remove();

}

function addTime(id,current) {
  var inc = current + 1;
$('a[name="addbtn['+id+']['+current+']"]').remove();
$('#'+id+'Hours').append('<input name="open['+id+']['+inc+']" type="text"style="width:40%;margin-right:10px" placeholder="Open Time" class="timepicker" required><input name="close['+id+']['+inc+']" type="text"style="width:40%;margin-right:10px" placeholder="Close Time" class="timepicker" required><br><a name="rmbtn['+id+']['+inc+']" style="/*margin-top:5%*/" class="right" href="#"  onclick="event.preventDefault(); delTime('+id+','+inc+')">Remove</a><br><a style="/*margin-top:5%*/" class="right" href="#" name="addbtn['+id+']['+inc+']"  onclick="event.preventDefault(); addTime('+id+','+inc+')">Add Time</a>');
 $('.timepicker').timepicker();
}
    $(document).ready(function(){

      $('input[type="checkbox"]').click(function(){

        if($(this).is(":checked")) {
           var id = $(this).attr('id');
           $('#'+id+'Status').html("OPEN");
           $('#'+id+'Hours').html('<input name="open['+id+'][0]" type="text"style="width:40%;margin-right:10px" placeholder="Open Time" class="timepicker" required><input name="close['+id+'][0]" type="text"style="width:40%;margin-right:10px" placeholder="Close Time" class="timepicker" required><a style="/*margin-top:5%*/" class="right" href="#" name="addbtn['+id+'][0]"  onclick="event.preventDefault(); addTime('+id+',0)">Add Time</a>');
           $('.timepicker').timepicker();
         }
         else {
           var id = $(this).attr('id');
           $('#'+id+'Status').html("CLOSED");
           $('#'+id+'Hours').html("");
         }


    /*  for (var i = 1; i <= 7; i++) {
          if($('#'+i).prop("checked") == true){
              $('#'+i+'Status').html("OPEN");
              $('#'+i+'Hours').html('<input name="" type="text"style="width:30%;margin-right:10px" placeholder="Open Time" class="timepicker"><input type="text"style="width:30%;margin-right:10px" placeholder="Close Time" class="timepicker">');
              $('.timepicker').timepicker();
          }
          else {
              $('#'+i+'Status').html("CLOSED");
              $('#'+i+'Hours').html("");
          }

}*/

    });
    });
</script>
