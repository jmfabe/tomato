@foreach ($cats as $cat)

  <tr id="{{$cat->id}}" class="scrollspy">
    <td style="text-align:center" colspan="4">{{$cat->name}}</td>
  </tr>
  @if ($cat->children->count() > 0)
        @include('public.subcatsMenu', ['cats' => $cat->children])
  @else
    @foreach ($cat->products->where('branch_id',$branch_id) as $product)
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
