<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
  public function __construct()
  {
    //checking the user is superadmin
      $this->middleware('auth:superadmin');

  }
  public function list()
  {
      $products = Product::all();
      $PageHeading = "List Products";
      return view('admins.products.list', compact('products', 'PageHeading'));
  }
  public function AvailablitySwitch($id)
  {
    $product = Product::find($id);
    if ($product->is_available == true) {
      $product->is_available = false;
    }
    else {
      $product->is_available = true;
    }
    $product->save();
    return $product->is_available;
  }

  public function ApprovalSwitch($id)
  {
    $product = Product::find($id);
    if ($product->is_approved == true) {
      $product->is_approved = false;
    }
    else {
      $product->is_approved = true;
    }
    $product->save();
    return $product->is_approved;
  }

}
