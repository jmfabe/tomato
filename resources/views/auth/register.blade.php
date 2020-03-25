@include('public.layout.header')
<script type="text/javascript">
     var onloadCallback = function() {
       grecaptcha.render('captcha_element', {
         'sitekey' : '6Lc-Z9sUAAAAAO6JxR-Nj2GuZq8ElnmG5OJKz0bn'
       });
     };
   </script>
<div class="container">
  <div class="row">
    <h1 class="center">Register</h1>
  <div class="col l6 offset-l3 center">
    @error('captcha')
    <span  style="color:red;text-align:center"> {{ $message }}</span>
    @enderror
  <form method="POST" action="{{ route('register') }}">
      @csrf
              <input type="text" placeholder="Name*"  name="name" required autocomplete="name" autofocus>
              @error('name')
              <span  style="color:red;text-align:center"> {{ $message }}</span>
              @enderror

              <input type="email" name="email" placeholder="Email*" required autocomplete="email">
              @error('email')
                    <span  style="color:red;text-align:center"> {{ $message }}</span>
              @enderror

              <input type="text" name="phone" placeholder="Contact Number*" required>
              @error('phone')
                  <span  style="color:red;text-align:center"> {{ $message }}</span>
              @enderror

              <input type="password" name="password" placeholder="Password*" required autocomplete="new-password">
              @error('password')
                    <span  style="color:red;text-align:center"> {{ $message }}</span>
              @enderror

              <input type="password" name="password_confirmation" placeholder="Re-type Password*" required autocomplete="new-password">
              <div id="captcha_element"></div>
                <br/>
              <button type="submit" class="btn btn-primary">
                  {{ __('Register') }}
              </button>

  </form>
  </div>
  </div>
</div>
@include('public.layout.footer')
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
