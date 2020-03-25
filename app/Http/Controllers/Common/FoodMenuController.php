<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Branch;
use App\Category;

class FoodMenuController extends Controller
{
  public function list()
  {

    $branches = Branch::select('city')->groupBy('city')->get();
    if (session('area')) {
        $branch = Branch::where('area',session('area'))->first();
        //$products = Product::where('branch_id',$branch->id)->where('is_approved',true)->get();

    }
    else {
      $branch = Branch::find(18);
    //  $products = Product::where('branch_id',18)->where('is_approved',true)->get();
    }

    $rootCategries = Category::get()->toTree();

    $branch_id = $branch->id;
    return view('public.products',compact('branches','branch','rootCategries','branch_id'));
  }

  public function getProdOpts($id)
  {
    $OptsAndAddons = array("options" => Product::find($id)->options,"addons" => Product::find($id)->addons);
    return $OptsAndAddons;
  }
}
