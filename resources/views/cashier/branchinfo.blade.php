@include('cashier.layout.header')
  <h2>My Branch Info</h2>

<div class="row">
  <div class="col l6">
    <img src="/storage/{{$branch->cover_image}}" width="50%">
    <h5>Name: {{$branch->name}}</h5>
    Type: {{$branch->type}}
    <br>
    Cuisines: {{$branch->cuisines}}
    <br>
    Contact Number: {{$branch->contact_number}}
    <br>
    City: {{$branch->city}}
    <br>
    Area: {{$branch->area}}
  </div>
  <div class="col l6">
<h6>Operation Hours</h6>

      <table>
        <thead>
          <tr>
            <td>DAY</td>
            <td>Opens at</td>
            <td>Closes at</td>
          </tr>
        </thead>
        <tbody>
            @foreach ($branch->hours as $hours)
              <tr>
                <td>
                @switch($hours->day)

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
                <td>
                  {{date("g:i a", strtotime($hours->open_time))}}
                </td>

                <td>
                  {{date("g:i a", strtotime($hours->close_time))}}
                </td>
              </tr>
            @endforeach
        </tbody>
      </table>



  </div>
</div>

@include('cashier.layout.footer')
