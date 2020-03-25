@include('public.layout.header')
<div class="container">


<h1>Selct Payment Option</h1>
<form method="post" action="/PaymentOptionSelection">
  @csrf
  <p>
    <label>
      <input name="paymentOption" value="COD" type="radio" checked/>
      <span>Pay through Cards</span>
    </label>
  </p>
    <p>
      <label>
        <input name="paymentOption" value="CCAVENUE" type="radio" />
        <span>Cash On Delivery</span>
      </label>
    </p>
    <button type="submit" class="btn" name="button">Pay and Order</button>
    <br>
    <br>
  </form>
</div>
@include('public.layout.footer')
