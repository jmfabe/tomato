@include('public.layout.header')
<div class="container">
  <div class="row">
  <div class="col l6 offset-l3 center">
  <h1>Login</h1>

  <form method="POST" action="{{ route('login') }}">
    @csrf
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required placeholder="Email Address"  autofocus>
      @error('email')
      <strong>{{ $message }}</strong>
      @enderror

      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

      @error('password')

              <strong>{{ $message }}</strong>

      @enderror


      <div class="row valign-wrapper ">
        <div class="col l6 s12">
        <button type="submit" class="btn btn-primary">
          {{ __('Login') }}
      </button>
        </div>
        <div class="col l6 s12">
         <a href="password/reset" class="">Forgot Password</a>

          </div>
      </div>


</form>
<br>
New to Puranmal?<br>
<a href="/register" class="waves-effect waves-light btn">Create Your Account</a>
@if (strpos(url()->previous(),"online-food-menu")!==false)
<a href="/guest-checkout" class="waves-effect waves-light btn">Checkout as Guest</a>
@endif

</div>  <!--col-->
</div> <!--row-->
</div> <!--container-->
<br>

@include('public.layout.footer')
