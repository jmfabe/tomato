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
      <th>Username</th>
      <th>Branch</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($cashiers as $cashier)
    <tr>
      <td>{{$cashier->name}}</td>
      <td>{{$cashier->username}}</td>
      <td>{{$cashier->branch_id}}</td>
      <td><a href="/notadmin/cashier/edit/{{$cashier->id}}" class="btn">Edit / Reset Pwd</a></td>

      <td><a href="/notadmin/cashier/delete/{{$cashier->id}}" class="btn">Delete</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@include('admins.layout.footer')
