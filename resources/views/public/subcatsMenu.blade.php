@foreach ($cats as $cat)

  <tr id="{{$cat->id}}" class="scrollspy">
    <td style="text-align:center" colspan="4">{{$cat->name}}</td>
  </tr>
  @if ($cat->children->count() > 0)
        @include('public.subcatsMenu', ['cats' => $cat->children])
  @else
    @foreach ($cat->products->where('branch_id',$branch_id)->where('is_approved',true) as $product)
      <tr>

              <td><img width="100px" src="/storage/{{$product->image}}" alt=""></td>
              <td>{{$product->name}}</td>



              <td>

                  AED {{$product->options->min('price')}}
              </td>
              <td style="text-align:center">@if (count($product->options)===1 AND $product->options->first->name === NULL)
                <form action="/add-to-cart" method="post">
                  <input type="hidden" name="option_id" value="{{(isset($product->options[0]->id) ? $product->options[0]->id : '') }}">
                  @csrf
                    <button type="submit" class="submit_form btn" style="width:100px" name="button">ADD</button>
                </form>


              @else
              <a href="#customize" style="width:100px"  class="btn modal-trigger">ADD</a><br>Customizable
              @endif</td>
            </tr>
    @endforeach

  @endif

@endforeach
