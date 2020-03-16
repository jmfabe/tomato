<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
     <link rel="stylesheet" href="{{asset('backend/css/back.css') }}">

    <style>
    header, main, footer {
      padding-left: 300px;
    }

    @media only screen and (max-width : 992px) {
      header, main, footer {
        padding-left: 0;
      }
    }
    @media only screen and (min-width: 993px)
.container {
    width: 96% !important;
}
  .collapsible-header{
    padding-left: 32px !important;
  }
    </style>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>



      <ul id="slide-out" class="sidenav sidenav-fixed">
        <li><a href="/cashier/dashboard">Dashboard</a></li>
            <li><a href="/cashier/branch">My Branch</a></li>
            <li><a href="/cashier/orders">Orders</a></li>


              <li class="no-padding">
                <ul class="collapsible collapsible-accordion">


                  <li>
                    <a class="collapsible-header">Products<i class="material-icons right">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                      <ul>
                        <li><a href="/cashier/product/add">Add Product</a></li>
                        <li><a href="/cashier/products">List Products</a></li>
                      </ul>
                    </div>
                  </li>



                </ul>
              </li>







              <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">LOGOUT</a>
              </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>






      </ul>

      <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <main>
        <div class="container">
              <span style="float:right; border-width:2px; border-style: solid;padding:5px;">welcome, {{Auth::user()->name}}. Your Branch is:
                @foreach ($branch->hours->where('day',date("w")) as $hour)
                  @if (date("H:i:s") > $hour->open_time AND date("H:i:s") < $hour->close_time)
                      <span style="background-color: green; color:white; padding:5px">OPEN</span>
                    @php $is_opened = 1; @endphp
                    @break
                  @endif
                @endforeach
                @if(!(isset($is_opened)))
                <span style="background-color: red; color:white; padding:5px">CLOSED</span>
                @endif

               </span>
        <h5>{{ $PageHeading ?? '' }}</h5>
