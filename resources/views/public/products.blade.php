  @include('public.layout.header')
<style media="screen">
header, main, footer {
    padding-left: 300px;
  }

  @media only screen and (max-width : 992px) {
    header, main, footer {
      padding-left: 0;
    }
  }
</style>
  <ul id="slide-out" class="sidenav sidenav-fixed">

    @foreach ($rootCategries as $rootCat)
      <li><a href="#{{$rootCat->id}}">{{$rootCat->name}}</a></li>
    @include('public.subcats', ['cats' => $rootCat->children])
    @endforeach




      </ul>
<main>



  <div class="row">
    <h4>Selected Branch: {{$branch->name}} <a class="modal-trigger" id="modalSelect" href="#modal1"><u>Change?</u></a> </h4>
  </div>
  <div class="row">

    <div class="col l8">
      <table>
        <tbody>
          @foreach ($rootCategries as $rootCat)
            <tr id="{{$rootCat->id}}" class="scrollspy">
              <td colspan="4" style="text-align:center">{{strtoupper($rootCat->name)}}</td>
            </tr>
              @if ($rootCat->children->count() > 0)
                    @include('public.subcatsMenu', ['cats' => $rootCat->children])
              @else
                @foreach ($rootCat->products->where('branch_id',$branch_id) as $product)
                  <tr>

                          <td><img width="100px" src="/storage/{{$product->image}}" alt=""></td>
                          <td>{{$product->name}}</td>



                          <td>

                              AED {{$product->options->min('regular_price','offer_price')}}
                          </td>
                          <td style="text-align:center">@if (count($product->options)===1 AND $product->options->first->name === NULL)
                          <a href="/notadmin/product/edit/{{$product->id}}" style="width:100px" class="btn">ADD</a>
                          @else
                          <a href="/notadmin/product/edit/{{$product->id}}" style="width:100px"  class="btn">ADD</a><br>Customizable
                          @endif</td>
                        </tr>
                @endforeach
              @endif

          @endforeach
        </tbody>

    </table>

    </div>


    <div  class="col hide-on-med-and-down l4 ">
      @if (isset($products))
        <div style="height:200px;width:400px;padding:10px" class="toc-wrapper puranmal cream">
          <h5 class="center">CART</h5>
        </div>
      @else

      @endif

    </div>


  </div>


</main>

    @include('public.layout.footer')

<script>
$(document).ready(function(){
    $('.sidenav').sidenav();
     $('.scrollspy').scrollSpy();
  });



  setTimeout(function() {
       var tocWrapperHeight = 260; // Max height of ads.
       var tocHeight = $('.toc-wrapper .table-of-contents').length
         ? $('.toc-wrapper .table-of-contents').height()
         : 0;
       var socialHeight = 95; // Height of unloaded social media in footer.
       var footerOffset = $('body > footer').first().length
         ? $('body > footer')
             .first()
             .offset().top
         : 0;
       var bottomOffset = footerOffset - socialHeight - tocHeight - tocWrapperHeight;

       if ($('nav').length) {
         console.log('Nav pushpin', $('nav').height());
         $('.toc-wrapper').pushpin({
           top: $('nav').height(),
           bottom: bottomOffset
         });
       } else if ($('#index-banner').length) {
         $('.toc-wrapper').pushpin({
           top: $('#index-banner').height(),
           bottom: bottomOffset
         });
       } else {
         $('.toc-wrapper').pushpin({
           top: 0,
           bottom: bottomOffset
         });
       }
     }, 100);

</script>
