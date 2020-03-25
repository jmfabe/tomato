@foreach ($cats as $cat)
<li style="margin-left:5px;margin-right:5px" class="tab"><a class="puranmal cream" href="#{{$cat->id}}">{{$cat->name}}</a></li>
@include('public.subcats', ['cats' => $cat->children])
@endforeach
