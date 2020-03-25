<!DOCTYPE html>
  <html>
    <head>

      <title>{{$title ?? ''}}</title>
      <meta name="description" content="{{$description ?? ''}}">
        @if (config('app.env')=="production")
      <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NVBWR45');</script>
<!-- End Google Tag Manager -->
@endif

      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Playball&display=swap" rel="stylesheet">
	  <!--<link href="https://fonts.googleapis.com/css?family=Chivo:300,300i,400,400i,700,700i,900,900i&display=swap" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,500&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
     <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">
      <!--Import materialize.css-->
       <link rel="stylesheet" href="{{asset('frontend/css/front.css') }}">
	   <style>



     .covercontainer {
     position: relative;
     }

     /* Bottom right text */
     .centeredtext {
       position: absolute;
       top: 40%;
       left: 50%;
       transform: translate(-50%, -50%);
     }
     .dot {
       height: 25px;
       width: 25px;

       border-radius: 50%;
       right:20px;
       padding: 1px;
     }
     .swiper-container {
    width: 100%;

}
	   .carousel{
    width: 100% !important;
	}
	.carousel-item{
	width: 250px !important;
	}
	   // RESTYLE MATERIALIZE SEARCH INPUT
		nav .input-field input[type=search] {
		width:0px;
		}
		nav .input-field input[type=search]:focus {
		width:320px;
		color: transparent;                     // Remove blinking cursor 1/2
		text-shadow: 0 0 0 rgba(0, 0, 0, 0.87); // Remove blinking cursor 2/2
		}
	   </style>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
    @if (config('app.env')=="production")
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NVBWR45"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endif


    <!--floading chat icon
      <div class="fixed-action-btn center-align">
  <a class="btn-floating btn-large red">
    <i class="large material-icons">headset_mic</i>

  </a>
  <br>
  <span style="background-color:#fff; padding:3px" ><b>Chat Online</b>
</span>
</div>-->



<ul id="sericedd" class="dropdown-content puranmal cream">
<li><a  class="puranmal-text" href="/event-catering">Event Catering</a></li>
<li><a  class="puranmal-text" href="/live-kitchens">Live kitchens</a></li>
<li><a  class="puranmal-text" href="/supplying-to-leading-hotels">Supplying to Leading Hotels</a></li>
</ul>

	<ul id="aboutdd" class="dropdown-content puranmal cream">
  <li><a class="puranmal-text" href="/history">History</a></li>
  <li><a class="puranmal-text" href="/puranmal">Puranmal Restaurant</a></li>
  <li><a  class="puranmal-text" href="/vega">Vega By Puranmal</a></li>
  <li><a  class="puranmal-text" href="/art-gallery">Art Gallery</a></li>
  <li><a  class="puranmal-text" href="/manufacturing">Central Food Kitchen</a></li>
	</ul>

<!--	<ul id="sericemdd" class="dropdown-content">
  <li><a href="/event-catering">Event Catering</a></li>
  <li><a href="/live-kitchens">Live kitchens</a></li>
  <li><a href="/supplying-to-leading-hotels">Supplying to Leading Hotels</a></li>
	</ul>

  <ul id="aboutmdd" class="dropdown-content">
  <li><a href="/history">History</a></li>
  <li><a href="/puranmal">Puranmal</a></li>
  <li><a href="/vega">Vega</a></li>
  <li><a href="/art-gallery">Art Gallery</a></li>
  <li><a href="/manufacturing">Kitchen Manufacture</a></li>
</ul> -->


	<div class="hide-on-med-and-down">
  <nav class="z-depth-0" style="height:30px">
    <div class="nav-wrapper white">
      <div class="row">
        <div class="col s12">

          <ul class="right" style="line-height: 30px;">

          <!--  <li>

              <form style="height:30px;">
                <div class="input-field ">
                  <input id="search" type="search" required placeholder="Search Products">
                  <label class="label-icon" for="search"><i class="this material-icons puranmal-text" style="line-height: 30px;">search</i></label>
					<i class="material-icons" style="line-height: 30px;">close</i>
                </div>
              </form>

            </li>-->
          {{-- comment  <li><a href="#" class="puranmal-text">Currency: AED ˅</a></li>--}}

      <li><a class="dropdown-trigger puranmal-text" href="#!" data-target="myaccountdd">My Account ˅</a></li>



      <ul id="myaccountdd" class="dropdown-content">

        @auth
          <li><a href="/my-orders">My Orders</a></li>
          <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">LOGOUT</a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        @endauth


        @guest
          <li><a href="/login">Login</a></li>
          <li><a href="/register">Register</a></li>
        @endguest





      </ul>


      <ul id="orderonlinedd" class="dropdown-content puranmal cream">

          <li><a href="/shop" class="puranmal-text">Packed items</a></li>
          <li><a href="/online-food-menu" class="puranmal-text">Order Food Online</a></li>

      </ul>
      @isset($branches)


      <li><a class="modal-trigger puranmal-text" id="modalSelect" href="#modal1">@if (session()->has('city') AND session()->has('area'))
      {{Session::get('city')}}, {{Session::get('area')}}.
      @else
        Area: Al Raffa, Dubai.
      @endif<u>Change?</u></a></li>  @endisset
      <!--<sup class="dot red">20</sup>-->
     <li><a href="/cart" class="puranmal-text" style="height: 30px;"><i class="material-icons" style="font-size:20px;line-height: 30px;">shopping_cart</i><small class="notification-badge">5</small></a></li>



          </ul>

        </div>
      </div>
    </div>
  </nav>
</div>


	<div class="navbar-fixed">
	<nav class="z-depth-3" style="position: relative;">

    <div class="nav-wrapper">
      <a href="/" class="brand-logo animated tada"><img src="{{asset('/img/puranmal-logo-transparent-white.png')}}"></a>
	  <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down" style="text-transform:uppercase;">

        <li><a class="puranmal-text text-cream" href="/">Home</a></li>
        <li><a class="dropdown-trigger puranmal-text text-cream" href="#!" data-target="aboutdd">About Us<i class="material-icons right">arrow_drop_down</i></a></li>
        <li><a class="dropdown-trigger puranmal-text text-cream" href="#!" data-target="sericedd">Services<i class="material-icons right">arrow_drop_down</i></a></li>

    <li><a class="dropdown-trigger puranmal-text text-cream" href="#!" data-target="orderonlinedd">Order Online<i class="material-icons right">arrow_drop_down</i></a></li>
		<li><a class="puranmal-text text-cream" href="/locations">Our Branches</a></li>
		<li><a class="puranmal-text text-cream" href="/contact-us">Contact Us</a></li>
		<li><a class="puranmal-text text-cream" href="/franchise">Franchise</a></li>


      </ul>



	  </div>
	  </nav>
	  </div>

	  <ul id="nav-mobile" class="sidenav puranmal">
        <li><a class="puranmal-text text-white" href="/">Home</a></li>



          <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header puranmal-text text-white" style="padding-left:32px">About Us<i class="puranmal-text text-white material-icons right">arrow_drop_down</i></a>
            <div class="collapsible-body puranmal white" style="border:2px;">
              <ul>
                <li><a href="/history">History</a></li>
                <li><a href="/puranmal">Puranmal Restaurant</a></li>
                <li><a href="/vega">Vega By Puranmal</a></li>
                <li><a href="/art-gallery">Art Gallery</a></li>
                <li><a href="/manufacturing">Central Food Kitchen</a></li>

              </ul>
            </div>
          </li>
        </ul>


        <ul class="collapsible collapsible-accordion">
        <li>
          <a class="collapsible-header puranmal-text text-white" style="padding-left:32px">Services<i class="puranmal-text text-white material-icons right">arrow_drop_down</i></a>
          <div class="collapsible-body puranmal white" style="border:2px;">
            <ul>
              <li><a href="/event-catering">Event Catering</a></li>
              <li><a href="/live-kitchens">Live kitchens</a></li>
              <li><a href="/supplying-to-leading-hotels">Supplying to Leading Hotels</a></li>

            </ul>
          </div>
        </li>
      </ul>



		<li><a class="puranmal-text text-white" href="/shop">Order Online</a></li>
		<li><a class="puranmal-text text-white" href="/locations">Locations</a></li>
		<li><a class="puranmal-text text-white" href="/contact-us">Contact Us</a></li>
		<li><a class="puranmal-text text-white" href="/franchise">Franchise</a></li>


    <ul class="collapsible collapsible-accordion">
    <li>
      <a class="collapsible-header puranmal-text text-white" style="padding-left:32px">My Account<i class="puranmal-text text-white material-icons right">arrow_drop_down</i></a>
      <div class="collapsible-body puranmal white" style="border:2px;">
        <ul>
          @auth
            <li><a href="/my-orders">My Orders</a></li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">LOGOUT</a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          @endauth


          @guest
            <li><a href="/login">Login</a></li>
            <li><a href="/register">Register</a></li>
          @endguest

        </ul>
      </div>
    </li>
  </ul>

    <li><a class="puranmal-text text-white" href="/cart">Cart</a></li>
	  <!-- <li><form style="height:30px;">
       <div class="input-field ">
         <input id="search" type="search" class="right" required placeholder="Search Products">
         <i class="material-icons puranmal-text" style="line-height: 30px;">search</i>
         <i class="material-icons" style="line-height: 30px;">close</i>
       </div>
     </form></li>-->
      </ul>

      @isset($branches)


      <div id="modal1" class="modal">
       <div class="modal-content">
         <h4>Choose Location</h4>
         <form action="/CityAreaSelection" method="post">
         <div class="input-field">
         <select name="city" required id="city" >
           <option value="">Select City</option>

           @foreach ($branches as $branch)
               <option value="{{$branch->city}}">{{$branch->city}}</option>
           @endforeach

         </select>
         </div>

       <div id="loading">
         <div class="preloader-wrapper small active">
           <div class="spinner-layer spinner-green-only">
             <div class="circle-clipper left">
               <div class="circle"></div>
             </div><div class="gap-patch">
               <div class="circle"></div>
             </div><div class="circle-clipper right">
               <div class="circle"></div>
             </div>
           </div>
         </div>
       </div>

         <div class="input-field">
         <select name="area" id="area" required>
           <option value="">Select Area</option>
         </select>


         </div>
       </div>
       <div class="modal-footer">
         @csrf
         <button type="SUBMIT" class="btn" name="button">SUBMIT</button>
       </form>
       </div>


      </div>

<a class=" hide-on-large-only right modal-trigger puranmal-text" style="margin-right:15px" id="modalSelect" href="#modal1">@if (session()->has('city') AND session()->has('area'))
{{Session::get('city')}}, {{Session::get('area')}}.
@else
  Area: Al Raffa, Dubai.
@endif<u>Change?</u></a>
@endisset
