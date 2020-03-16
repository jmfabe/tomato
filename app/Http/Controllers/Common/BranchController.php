<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch;

class BranchController extends Controller
{
    public function list()
    {
      $locations = Branch::all();
      $branches = Branch::select('city')->groupBy('city')->get();
      return view('public.branches',compact('branches','locations'));
    }

    public function branchSelection($branch_slug)
    {
      $branch = Branch::where('slug',$branch_slug)->first();
      session(['city' => $branch->city]);
      session(['area' => $branch->area]);
      return redirect('/online-food-menu');
    }
}
