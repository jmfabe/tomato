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
        <li><a href="/notadmin/dashboard">Dashboard</a></li>



              <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                  <li>
                    <a class="collapsible-header">Cashiers<i class="material-icons right">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                      <ul>
                        <li><a href="/notadmin/cashier/add">Add Cashier</a></li>
                        <li><a href="/notadmin/cashiers">List Cashiers</a></li>
                      </ul>
                    </div>
                  </li>
                  <li>
                    <a class="collapsible-header">Branches<i class="material-icons right">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                      <ul>
                        <li><a href="/notadmin/branch/add">Add Branch</a></li>
                        <li><a href="/notadmin/branches">List Branches</a></li>
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
        <h5>{{ $PageHeading ?? '' }}</h5>
