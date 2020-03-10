@include('admins.layout.header')
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
    </tr>
  </thead>
  <tbody>
    @foreach ($branches as $branch)
    <tr>
      <td>{{$branch->name}}</td>
      <td>{{$branch->city}}</td>
      <td>{{$branch->contact_number}}</td>
      <td><a href="/notadmin/branch/edit/{{$branch->id}}" class="btn">Edit</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@include('admins.layout.footer')
