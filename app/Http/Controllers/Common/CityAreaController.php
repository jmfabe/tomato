<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch;
use App\Cart;
use Auth;

class CityAreaController extends Controller
{
  public function submit(Request $req)
  {
    $req->session()->put('city', $req->city);
    $req->session()->put('area', $req->area);

      if (Auth::check()) {
          $identity = Auth::id();
      } elseif (\Session::has('identity')) {
          $identity = \Session::get('identity');
      }
      else {
        $identity = NULL;
      }
      Cart::where('identity',$identity)->delete();

    return redirect()->back();
  }

  public function getAreas($cityname)
  {
    $branches = Branch::where('city',$cityname)->get();
    return $branches;
  }
}
