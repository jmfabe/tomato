@include('public.layout.header')

<div class="container">
<h1>Delivery Address</h1>
<div class="row">
  @if ($addresses!==NULL)
  @foreach ($addresses as $address)
  <div class="col l4">
    <b>{{$address->fullname}}</b><br>
    {{$address->addressline1}} <br>
    {{$address->addressline2}} <br>
    {{$address->area}} <br>
    {{$address->city}} <br>
    {{$address->phone}} <br>

    <div class="row" style="margin-bottom:10px">
      <div class="col l12">
        <a href="/select-address/{{$address->id}}" style="width:100%" class="btn">Deliver to this address</a>
      </div>
    </div>

    <div class="row">
      <div class="col l6">
        <a href="/edit-address/{{$address->id}}" style="width:100%" class="btn grey white-text">Edit</a>
      </div>
      <div class="col l6">
        <a href="/delete-address/{{$address->id}}" style="width:100%" class="btn grey white-text">Delete</a>
      </div>
    </div>


  </div>

@endforeach
@endif
</div>
<div class="row">
  <div class="col l8">
    @auth
        <h2>Add a New Address</h2>
    @endauth

  <form class="" action="/address/add" method="post">
    @csrf
  <div class="input-field">
  <label for="fullname">Full Name:*</label>
  <input type="text" required id="fullname" name="fullname" value="{{ Auth::check() ? Auth::user()->name : ''  }}">
  </div>

  @guest
    <div class="input-field">
    <label for="email">Email:*</label>
    <input type="email" required id="email" name="email" value="">
    </div>
  @endguest

  <div class="input-field">
  <label for="addressline1">Address Line 1:*</label>
  <input type="text" id="addressline1" required name="addressline1" value="">
  </div>

  <div class="input-field">
  <label for="addressline2">Address Line 2:*</label>
  <input type="text" required id="addressline2" name="addressline2" value="">
  </div>

  <div class="input-field">
  <label for="phone">Phone Number:*</label>
  <input type="text" id="phone" required name="phone" value="{{ Auth::check() ? Auth::user()->phone : ''  }}">
  </div>

  <div class="input-field">
  <select name="city" required >
    <option value="" selected disabled>Select City</option>
    <option value="Dubai">Dubai</option>
    <option value="Sharjah">Sharjah</option>
    <option value="Ajman">Ajman</option>
    <option value="Fujairah">Fujairah</option>
    <option value="Ras Al Khaima">Ras Al Khaima</option>
    <option value="Umm Al Quwain">Umm Al Quwain</option>
    <option value="Abu Dhabi">Abu Dhabi</option>
    <option value="Al Ain">Al Ain</option>
  </select>


  </div>


  <div class="input-field">
  <label for="area">Area:*</label>
  <input type="text" id="area" required name="area" value="">
  </div>

  <button class="btn right" type="submit" >Deliver to this address</button>


  </div>
</form>

</div>
</div>

@include('public.layout.footer')
