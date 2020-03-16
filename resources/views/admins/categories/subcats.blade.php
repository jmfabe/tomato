@foreach ($cats as $cat)
<option value="{{$cat->id}}"> @for ($i = 1; $i <= $cat->ancestors->count(); $i++)
  &nbsp;-
@endfor {{$cat->name}}</option>
@include('admins.categories.subcats', ['cats' => $cat->children])
@endforeach
