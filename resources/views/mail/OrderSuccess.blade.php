Thank you for your order.
<h3>Order Details</h3>
<h4>Order#: {{$order->id}}</h4>
<table>
  <thead>
    <tr>
      <th>Product Name</th>
      <th>Quantity</th>
      <th>Unit Price</th>
      <th style="text-align:right">Price</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($order->orderitems as $item)
    <tr>
      <td>{{$item->product_name}}</td>
      <td>{{$item->quantity}}</td>
      <td>AED {{$item->unitprice}}</td>
      <td style="text-align:right">AED {{$item->totalprice}}</td>
    </tr>
    @endforeach
    <tr>
      <td colspan="3" style="text-align:right">Sub Total</td>
      <td colspan="3" style="text-align:right">AED {{$order->sub_total}}</td>
    </tr>
    <tr>
      <td colspan="3" style="text-align:right">Shipping</td>
      <td colspan="3" style="text-align:right">AED {{$order->shipping_cost}}</td>
    </tr>
    <tr>
      <td colspan="3" style="text-align:right">Order Total</td>
      <td colspan="3" style="text-align:right">AED {{$order->grand_total}}</td>
    </tr>

  </tbody>
</table>
<h4>Delivery Address</h4>
{{$order->fullname}}<br>
{{$order->addressline1}}<br>
{{$order->addressline2}}<br>
{{$order->phone}}<br>
{{$order->city}}<br>
{{$order->area}}<br>

<br>
Thank you!<br>
Puranmal Group
