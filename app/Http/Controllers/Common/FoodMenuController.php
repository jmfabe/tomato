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
        $products = Product::where('branch_id',$branch->id)->get();

    }
    else {
      $branch = Branch::find(238);
      $products = Product::where('branch_id',238)->get();
    }

    $rootCategries = Category::get()->toTree();

    $branch_id = $branch->id;
    return view('public.products',compact('products','branches','branch','rootCategries','branch_id'));
  }
}
