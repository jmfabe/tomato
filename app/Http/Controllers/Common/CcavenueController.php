<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\Cart;


class CcavenueController extends Controller
{
    public function payment(Request $req)
    {
        if ($req->paymentOption == "COD") {
            $order_id = $this->CartToOrderPush("COD");
        // pass the order to order success view file update order database
        } else {
            $order_id = $this->CartToOrderPush("CCAVENUE");
            if ($order_id=="FAILED") {
                echo "Some error occured, please contact Adminitrator";
            } else {
                if ($req->paymentOption == 'COD') {
                    Mail::to($billing_email)->cc(\config('puranmal.ADMIN_EMAIL'))->cc("catering@puranmal.ae")->send(new OrderSuccessMail($order));
                    $url = url('/')."/order-success";
                    //$data = array('key1' => 'value1', 'key2' => 'value2');?>
              <form method="post" id="codform" action="<?php echo $url ?>">
              <?php
              echo "<input type='hidden' name='orderid' value='$order->id>'"; ?>
              </form>
              <script language='javascript'>document.getElementById('codform').submit();</script>
              <?php
                } else {
                    $this->paymentControl($order_id);
                }

                //ccavenue prepaid payment
            }
        }
        // retry word is not found push to order table and initiate payment
    }



    public function CartToOrderPush($PayMethod)
    {
        if (Auth::check()) {
            $userid = Auth::id();
        } elseif (session('identity')) {
            $userid = session('identity');
        }


        $cart = Cart::whereIdentity($userid)->first();
        //New Order table
        $order = new Order;

        $order->sub_total = $cart->subtotal;
        $order->grand_total = $cart->grand_total;
        $order->delivery_fee = $cart->delivery_fee;
        $order->payment_method = $PayMethod;
        $order->payment_reference_number = "0";
        $order->payment_status = 'Pending';

        if (Auth::check()) {
            $order->user_id = $userid;
            $order->fullname = $cart->address->fullname;
            $order->addressline1 = $cart->address->addressline1;
            $order->addressline2 = $cart->address->addressline2;
            $order->phone = $cart->address->phone;
            $order->city = $cart->address->city;
            $order->area = $cart->address->area;
        } else {
            $order->guest_id = $userid;
            $order->fullname = session('fullname');
            $order->addressline1 = session('addressline1');
            $order->addressline2 = session('addressline2');
            $order->phone = session('phone');
            $order->city = session('city');
            $order->area = session('area');
            $order->email = session('email');
        }

        $order->save();
        //$order->order_status = 'Initiated';
        $status = new Order_status;
        if ($PayMethod == "COD") {
            $status->order_status = 1;
            $order->status()->save($status);
        } else {
            $status->order_status = 0;
            $order->status()->save($status);
        }



        $caritems = Cart_item::Where('cart_id', $cart->id)->get();

        foreach ($caritems as $cartitem) {
            $order_item = new Order_item;

            $order_item->order_id = $order->id;
            $order_item->product_name = $cartitem->option->product->name." ".$cartitem->option->name;
            foreach ($cartitem->addons as $addon) {
                $order_item->product_name = $order_item->product_name." - ".$addon->name;
            }
            $order_item->quantity = $cartitem->quantity;

            $order_item->unitprice = $cartitem->unitprice;
            $order_item->totalprice = $order_item->quantity*$order_item->unitprice;
            $order_item->save();
        }

        $cart->delete();
        if ($order->id) {
            return $order->id;
        } else { //if the order has alrady initiated order for the same user id
            return "FAILED";
        }
    }

    public function paymentControl($order_id)
    {
        $merchant_data='';
        $working_key=\config('puranmal.CCAVENUE_ENCRYPTION_KEY');
        $access_code=\config('puranmal.CCAVENUE_ACCESS_CODE');

        $order = Order::find($order_id);
        # Our new data
        $data = array(

        'merchant_id' => \config('puranmal.CCAVENUE_MID'),
        'order_id' => $order->id,
        'amount' => $order->grand_total,
        'currency' => 'AED',

        'redirect_url' => url('/')."/fromccavenue",
        'cancel_url' => url('/')."/ccavenuecancelled",


        'language' => "EN",


        'billing_name' => $order->fullname,
        'billing_address' => $order->addressline1." ".$order->addressline2,
        'billing_city' => $order->city,
        'billing_country' => 'United Arab Emirates',
        'billing_zip' => '00000',
        'billing_tel' => $order->phone,

    //optional fields

        'delivery_name' => $order->fullname,
        'delivery_address' => $order->addressline1." ".$order->addressline2,
        'delivery_city' => $order->city,
        'delivery_country' => 'United Arab Emirates',
        'delivery_zip' => '00000',
        'delivery_tel' => $order->phone,
  );

        if (session('email')) {
            $data['billing_email'] = session('email');
        } else {
            $user = Auth::user();
            $data['billing_email'] = $user->email;
        }

        foreach ($data as $key => $value) {
            $merchant_data.=$key.'='.urlencode($value).'&';
        }
        $encrypted_data=ccavenuencrypt($merchant_data, $working_key); // Method for encrypting the data.?>



<form method="post" id="ccavenue" action="https://secure.ccavenue.ae/transaction/transaction.do?command=initiateTransaction">
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
        echo "<input type=hidden name=access_code value=$access_code>"; ?>
</form>
  <script language='javascript'>document.getElementById('ccavenue').submit();</script>
<?php
    }

    public function response(Request $request)
    {
        $working_key=\config('puranmal.CCAVENUE_ENCRYPTION_KEY');
        $encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
    $rcvdString=ccavenuedecrypt($encResponse, $working_key);		//Crypto Decryption used as per the specified working key.
    $order_status="";
        $decryptValues=explode('&', $rcvdString);
        $dataSize=sizeof($decryptValues);


        for ($i = 0; $i < $dataSize; $i++) {
            $information=explode('=', $decryptValues[$i]);
            ${$information[0]}=$information[1];
        }

        if ($order_status==="Success") {
            $order = Order::find($order_id);
            $order->payment_status = $order_status;
            $order->payment_reference_number = $tracking_id;

            $order->save();
            //$order->order_status = "Placed";
            $status = new Order_status;
            $status->order_status = 1;
            $order->status()->save($status);

            Mail::to($billing_email)->cc(\config('puranmal.ADMIN_EMAIL'))->cc("catering@puranmal.ae")->send(new OrderSuccessMail($order));



            $url = url('/')."/order-success";
            //$data = array('key1' => 'value1', 'key2' => 'value2');?>



    <form method="post" id="myform" action="<?php echo $url ?>">
    <?php
    echo "<input type='hidden' name='orderid' value='$order_id>'"; ?>
    </form>
    <script language='javascript'>document.getElementById('myform').submit();</script>
    <?php
        } elseif ($order_status==="Aborted") {
            $order = Order::find($order_id);
            $order->payment_status = $order_status;
            $order->payment_reference_number = $tracking_id;

            $order->save();
            //$order->order_status = "Payment Failed";
            $status = new Order_status;
            $status->order_status = 7;
            $order->status()->save($status);
            //send an email to customer and admin

            return view('public.OrderCancelled', compact('order'));
        } elseif ($order_status==="Failure") {
            $order = Order::find($order_id);
            $order->payment_status = $order_status;
            $order->payment_reference_number = $tracking_id;

            $order->save();

            //$order->order_status = "Payment Failed";
            $status = new Order_status;
            $status->order_status = 7;
            $order->status()->save($status);

            //send an email to customer and admin

            return view('public.OrderCancelled', compact('order'));
        } else {
            $order = Order::find($order_id);
            $order->payment_status = $order_status;
            $order->payment_reference_number = $tracking_id;

            $order->save();
            //$order->order_status = "Payment Failed";
            $status = new Order_status;
            $status->order_status = 7;
            $order->status()->save($status);

            //send an email to customer and admin

            return view('public.OrderCancelled', compact('order'));
        }
    }

    public function success(Request $request)
    {
        $order = Order::find($request->orderid);
        return view('public.OrderSuccess', compact('order'));
    }
}
