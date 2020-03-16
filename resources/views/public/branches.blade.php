  @include('public.layout.header')
  <style media="screen">
  .flex {
    display: flex;
  flex-wrap: wrap;
  }
  </style>
<main style="padding-top: 1px; padding-bottom: 1px; background-image:url('/img/banner1-min.png');">
<div class="container">
<h1 class="center">Our Branches</h1>
<div class="row flex">
@foreach ($locations as $branch)
   @php $is_opened = 0; @endphp
      <div class="col l6 s12 m12 flex">
      <div class="card">
       <div class="card-image">
         <img src="/storage/{{$branch->cover_image}}" class="responsive-img">
         <span class="card-title puranmal-text text-cream"><h4 style="background-color:#780d1085;; padding:5px;line-height: 25px; font-size:27px">{{$branch->name}}<br>
             <span style="font-family:Roboto;font-size:15px">{{$branch->type}}</span></h4>
         </span>
       </div>
       <div class="card-content">
         <table>

           <tbody>
             <tr>
               <td>Cuisines:</td>
               <td>{{$branch->cuisines}}</td>
             </tr>
             <tr>
               <td>Now:</td>
               <td>@foreach ($branch->hours->where('day',date("w")) as $hour)
                 @if (date("H:i:s") > $hour->open_time AND date("H:i:s") < $hour->close_time)
                     <span style="background-color: green; color:white; padding:5px">OPEN</span>
                     @if ($branch->is_available == true)
                       <span style="background-color: #8F0032; padding:5px"><a style="color:white; "href="/branch/{{$branch->slug}}">ORDER ONLINE</a></span>
                     @endif

                   @php $is_opened = 1; @endphp
                   @break
                 @endif
               @endforeach
               @if($is_opened === 0)
               <span style="background-color: grey; color:white; padding:5px">CLOSED</span>
               @endif</td>
             </tr>
               <tr style="border-bottom: unset;">
                   <td>Tel:</td>
                   <td>0{{$branch->contact_number}}</td>
               </tr>


           </tbody>
         </table>
       </div>
     </div>

     </div>

@endforeach
  </div>

</div>
</main>

@include('public.layout.footer')
