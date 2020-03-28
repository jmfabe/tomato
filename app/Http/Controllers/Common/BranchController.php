<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch;
use App\Cart;

class BranchController extends Controller
{
    public function list()
    {
      $locations = Branch::all();
      $branches = Branch::select('city')->groupBy('city')->get();
      return view('public.branches',compact('branches','locations'));
    }

    //this is to select from the branch - locations page not the popup selection
    public function branchSelection($branch_slug)
    {
      $branch = Branch::where('slug',$branch_slug)->first();
      session(['city' => $branch->city]);
      session(['area' => $branch->area]);
      if ($branch->area !== session('area')) {
        if (Auth::check()) {
            $identity = Auth::id();
        } elseif (\Session::has('identity')) {
            $identity = \Session::get('identity');
        }
        else {
          $identity = NULL;
        }
        Cart::where('identity',$identity)->delete();
      }

      return redirect('/online-food-menu');
    }
}
