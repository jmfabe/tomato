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
      <th>Slug</th>
      <th>Parent</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($categories as $category)
    <tr>
      <td>{{$category->name}}</td>
      <td>{{$category->slug}}</td>
      <td>@foreach ($category->ancestors as $parent)
          {{($parent->name)}} @if (!$loop->last)
            ==>
          @endif
      @endforeach
      </td>
      <td><a href="/notadmin/branch/edit/{{$category->id}}" class="btn">Edit</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@include('admins.layout.footer')
