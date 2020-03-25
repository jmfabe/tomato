<ul id="productoptions" class="sidenav sidenav-fixed">

  @foreach ($rootCategries as $rootCat)
    <li><a href="#{{$rootCat->id}}">{{$rootCat->name}}</a></li>
  @include('public.subcats', ['cats' => $rootCat->children])
  @endforeach


    </ul>
