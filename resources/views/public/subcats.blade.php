@foreach ($cats as $cat)

  <li><a href="#{{$cat->id}}"> @for ($i = 1; $i <= $cat->ancestors->count(); $i++)
  &nbsp;-
@endfor{{$cat->name}}</a></li>
@include('public.subcats', ['cats' => $cat->children])
@endforeach
