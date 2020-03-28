<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Option;
use App\Cart;
use App\Cart_item;
use App\Addon_cart_item;
use App\Addon;
use App\Branch;
use Auth;

class CartController extends Controller
{
    public function add(Request $req)
    {
        $newproduct = true;
        $GetCart = false;
        if (Auth::check()) {  //check if the user logged in
            $identity = Auth::id();
            $GetCart = true;
        } elseif ($req->session()->has('identity')) {// if not logged in check they have session identity
            $identity = $req->session()->get('identity');
            $GetCart = true;
        } else {//if they don't have session identity and also not logged in create one session id
            $identity = $this->generateSessionNumber();
            $req->session()->put('identity', $identity);
        }

        if ($GetCart) {//if user have cart table
            $cart = Cart::where('identity', $identity)->first();
            if (!empty($cart)) {//check carts for the given session or login ID
                $cartitems = Cart_item::where('cart_id', $cart->id)->get();

                if (count($cartitems)) {//if they have cart check if the cart has cartitems
                    foreach ($cartitems as $cartitem) {//looping through all cartitems
                        if ($cartitem->option_id==$req->option) {//if the given product id matached with cart item in the loop
                            $newproduct = false;
                            $cartitem->quantity = $cartitem->quantity+1;
                            $cartitem->addons()->detach();
                            $addon_price = 0;
                            if ($req->addons) {
                            foreach ($req->addons as $addon) {
                              $cartitem->addons()->attach($addon);
                              $addon_price = $addon_price + Addon::find($addon)->price;
                            }
                            }

                    $cartitem->unitprice = Option::find($req->option)->price + $addon_price;
                    $cartitem->totalprice = $cartitem->unitprice*$cartitem->quantity;
                    $cartitem->save();
                    $this->UpdateSubtotal($cartitem->cart_id);
                  }
                }
                      if ($newproduct) {//if cartitems is there but no product matched with the added product
                          $cartitem = $this->CreateNewCartItem($cart->id, $req->option, $req->addons);
                        $cart =  $this->UpdateSubtotal($cartitem->cart_id);
                  }
              } else {//if User have cart but cartitems not there
                $cartitem = $this->CreateNewCartItem($cart->id, $req->option, $req->addons);
              $cart =  $this->UpdateSubtotal($cartitem->cart_id);
                }
        } else {// if user does not have cart
        $cart = $this->CreateNewCart($identity);
        $cartitem = $this->CreateNewCartItem($cart->id, $req->option, $req->addons);
      $cart =  $this->UpdateSubtotal($cartitem->cart_id);
          }
  } else { //if the session id is newly set for the first time, which means there is not loggedin and no session id already
  $cart = $this->CreateNewCart($identity);
  $cartitem = $this->CreateNewCartItem($cart->id, $req->option, $req->addons);
$cart =  $this->UpdateSubtotal($cartitem->cart_id);
    }

    return $this->CartContents($cart);
}







  public function CreateNewCartItem($cart_id,$option_id,$addons)
   {
     $cartitem = new Cart_item();
     $option = Option::find($option_id);
     $cartitem->cart_id = $cart_id;
     $cartitem->option_id = $option_id;
     $cartitem->quantity = 1;


      $cartitem->unitprice = $option->price;
      $cartitem->totalprice = $cartitem->unitprice*$cartitem->quantity;
      $cartitem->save();

      $addon_price = 0;
      if ($addons) {

      foreach ($addons as $addon) {
        $cartitem->addons()->attach($addon);
        $addon_price = $addon_price + Addon::find($addon)->price;
      }
    }
      $cartitem->unitprice = $option->price + $addon_price;
      $cartitem->totalprice = $cartitem->unitprice*$cartitem->quantity;
      $cartitem->save();


     return $cartitem;
   }


    public function CreateNewCart($identity)
    {
        $cart = new Cart();
        $cart->identity = $identity;
        $branch = Branch::where('area',session('area'))->first();
        $cart->branch_id = $branch->id;
        $cart->save();
        return $cart;
    }

    public function generateSessionNumber()
    {
        $number = mt_rand(1000000000, 9999999999); // better than rand()

        // call the same function if the barcode exists already
        if (Cart::whereIdentity($number)->exists()) {
            return generateSessionNumber();
        }

        // otherwise, it's valid and can be used
        return "GUEST-".time().$number;
    }


    public function UpdateSubtotal($cart_id)
 {
   $subtotal = Cart_item::Where('cart_id',$cart_id)->sum('totalprice');
   $cart = Cart::find($cart_id);
   $cart->subtotal = $subtotal;
   $cart->delivery_fee = 5;
   $cart->grand_total = $cart->subtotal+$cart->delivery_fee;
   $cart->save();
   return $cart;
 }

public function quantity($cart_item_id, $quantity)
{
  $cart_item = Cart_item::find($cart_item_id);
  if ($quantity > $cart_item->quantity) {
    $cart_item->quantity = $cart_item->quantity + 1;
    $cart_item->totalprice = $cart_item->quantity * $cart_item->unitprice;
    $cart_item->save();
    $cart = $this->UpdateSubtotal($cart_item->cart_id);
    return $this->CartContents($cart);
  }
  elseif ($quantity <= 0) {
    return $this->removeItem($cart_item_id);
  }
  else {
    $cart_item->quantity = $cart_item->quantity - 1;
    $cart_item->totalprice = $cart_item->quantity * $cart_item->unitprice;
    $cart_item->save();
    $cart = $this->UpdateSubtotal($cart_item->cart_id);
    return $this->CartContents($cart);
  }



}

public function removeItem($cart_item_id)
{
  $cart_item = Cart_item::find($cart_item_id);
  if ($cart_item->addons()) {
      $cart_item->addons()->detach();
  }
  $cart = $cart_item->cart;
  $cart_item->delete();
  $cart = $this->UpdateSubtotal($cart->id);
  return $this->CartContents($cart);
}

public function CartContents($cart)
{

  if ($cart->items->count() > 0) {

  foreach ($cart->items as $item) {
    $items[] = array('id' => $item->id, 'name' => $item->option->product->name.' '.$item->option->name, 'addons'=> $item->addons, 'unitprice' => $item->unitprice, 'totalprice' => $item->totalprice, 'quantity' => $item->quantity);
  }
  $response = array('cart' => array('subtotal' => $cart->subtotal, 'delivery_fee' => $cart->delivery_fee, 'grand_total' => $cart->grand_total), 'cartitems' => $items);
    }
    else {
    $response = 'empty';
    }
  return $response;
}

public function OnPageLoad()
{

  if (Auth::check()) {  //check if the user logged in
      $identity = Auth::id();
      $GetCart = true;
  } elseif (session('identity')) {// if not logged in check they have session identity
      $identity =session('identity');
      $GetCart = true;
  } else {//if they don't have session identity and also not logged in create one session id
      $identity = $this->generateSessionNumber();
      $req->session()->put('identity', $identity);
  }
  if ($GetCart) {
      $cart = Cart::where('identity', $identity)->first();
      $response =  $this->CartContents($cart);
  }
  else {
    $response = NULL;
  }
  return $response;
}
}
