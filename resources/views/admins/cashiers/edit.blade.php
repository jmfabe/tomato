@include('admins.layout.header')

@if(Session::has('success'))

<div id="successMessage" class="alert-message">


{{Session::get('success')}}
</div>
@endif
<form action="/notadmin/cashier/update" method="post">
  @csrf
  <input type="hidden" name="cashier_id" value="{{$cashier->id}}">
<input type="text" name="name" placeholder="Name" value="{{$cashier->name}}" required>
<input type="text" name="username" placeholder="User Name" value="{{$cashier->username}}" required>
<input type="text" name="password" placeholder="Password" value="">
<select name="branch_id" required>
<option value="" selected disabled>Select Branch</option>
<option value="" @if ($cashier->branch_id == NULL) selected @endif>NOT APPLICABLE</option>
@foreach ($branches as $branch)
<option value="{{$branch->id}}" @if ($cashier->branch_id == $branch->id) selected @endif>{{$branch->name}}</option>
@endforeach


</select>
@csrf
<button type="submit" name="button" class="btn">UPDATE</button>
</form>
@include('admins.layout.footer')
