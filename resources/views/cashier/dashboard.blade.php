@include('cashier.layout.header')


    <h2>New Order Updates</h2>



    <table>
      <thead>
        <tr>
          <th>Order #</th>
          <th>Name</th>
          <th>Grand Total</th>
          <th>Payment Method</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $order)
          @if ($order->statuses->sortBy('created_at')->last()->order_status === 1)
        <tr>
          <td>{{$order->id}}</td>
          <td>{{$order->fullname}}</td>
          <td>{{$order->grand_total}}</td>
          <td>{{$order->payment_method}}</td>
        </tr>
        @endif
          @endforeach
      </tbody>
    </table>



@include('cashier.layout.footer')
<script type="text/javascript">
   setTimeout(function(){
       location.reload();
   },30000);
</script>
