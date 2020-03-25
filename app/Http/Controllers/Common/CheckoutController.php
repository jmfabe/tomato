<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Cart;
use App\Address;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (strpos(url()->current(), "guest")!==false) {
                session(['guest' => 'yes']);
            }

            if ($request) {
                return $next($request);
            } else {
                $next;
            }
        });
    }

    public function addresses()
    {
        if (Auth::check()) {
            $identity = Auth::id();
        } elseif (\Session::has('identity')) {
            $identity = \Session::get('identity');
        }


        $cart = Cart::whereIdentity($identity)->first();

        if ($cart) {
            $cartitems = $cart->items;

            if ($cartitems) { //if the user has cart cartitems

                if (Auth::check()) {
                    $addresses = Address::Where('user_id', $identity)->get();
                } else {
                    $addresses = null;
                }

                return view('public.address', compact('addresses'));
            } else { //if cart items not there
                return redirect('/online-food-menu');
            }
        } else { //if cart is not there
            return redirect('/online-food-menu');
        }
    }

    public function addAddress(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $address = new Address();
            $address->fullname = $request->fullname;
            $address->addressline1 = $request->addressline1;
            $address->addressline2 = $request->addressline2;
            $address->phone = $request->phone;
            $address->city = $request->city;
            $address->area = $request->area;

            $user->addresses()->save($address);


            return redirect('/select-address'.'/'.$address->id);
        } elseif (\Session::get('guest')=="yes") {
            \Session::put('fullname', $request->fullname);
            \Session::put('addressline1', $request->addressline1);
            \Session::put('addressline2', $request->addressline2);
            \Session::put('phone', $request->phone);
            \Session::put('city', $request->city);
            \Session::put('area', $request->area);
            \Session::put('email', $request->email);
            return redirect('/select-address/guest');
        }
    }

    public function SelectAddress($id)
    {
      if (Auth::check()) {
      $identity = Auth::id();
    }
    elseif (session('identity')) {
      $identity = session('identity');
    }

    if ($id=="guest") {

    }
    else {
      $address = Address::find($id);
    }
 $cart = Cart::where('identity',$identity)->first();
 if (isset($address->user_id)) {
        $address_userid = $address->user_id;
      }
      else {
        $address_userid = NULL;
      }
      if ($address_userid == $identity OR $id == "guest") {

        if ($id == "guest") {
          $cart->address_id= NULL;

        }
        else {
          $cart->address_id=$id;
        }

        $cart->save();

        return view('public.PaymentOptions',compact('cart'));
    }
  }
}
