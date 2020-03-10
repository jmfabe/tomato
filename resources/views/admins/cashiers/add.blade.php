@include('admins.layout.header')

@if(Session::has('success'))

<div id="successMessage" class="alert-message">


{{Session::get('success')}}
</div>
@endif
<form action="/notadmin/cashier/add" method="post">
<input type="text" name="name" placeholder="Name" value="" required>
<input type="text" name="username" placeholder="User Name" value="" required>
<input type="text" name="password" placeholder="Password" value="" required>
<select name="branch_id" required>
<option value="" selected disabled>Select Branch</option>
<option value="">NOT APPLICABLE</option>
@foreach ($branches as $branch)
<option value="{{$branch->id}}">{{$branch->name}}</option>
@endforeach


</select>
@csrf
<button type="submit" name="button" class="btn">ADD</button>
</form>
@include('admins.layout.footer')
