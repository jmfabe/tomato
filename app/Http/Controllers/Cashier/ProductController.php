<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Option;
use Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        //checking the user is superadmin
        $this->middleware('auth:cashier');
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
    public function list()
    {
        $cashier = Auth::user();
        $branch = $cashier->branch;
        $products = Product::all();
        $PageHeading = "List Products";
        return view('cashier.products.list', compact('products', 'PageHeading','branch'));
    }

    public function addform()
    {
        $cashier = Auth::user();
        $branch = $cashier->branch;

        $leefCategries = Category::whereIsLeaf()->get();

        $PageHeading = "Add Product";
        return view('cashier.products.add', compact('leefCategries', 'PageHeading','branch'));
    }

    public function add(Request $req)
    {


        $product = new Product;
        $product->name = $req->name;
        $product->slug = $req->slug;
        $product->category_id = $req->category;

        $image = $req->image;
        $name=str_replace(' ', '_', $req->name.' '.time());
        $img_extension = pathinfo(storage_path().$image->getClientOriginalName(), PATHINFO_EXTENSION);
        $pretty_image_name=$name.'.'.$img_extension;
        $image->storeAs('public/ProductImages/'.str_replace(' ', '_', $req->name), $pretty_image_name);
        $fullpath = 'ProductImages/'.str_replace(' ', '_', $req->name).'/'.$pretty_image_name;

        $product->image = $fullpath;

        $product->is_available = true;

        if ($req->anytime and $req->anytime=="yes") {

        } else {

          $product->start_time = date("G:i", strtotime($req->start_time));
          $product->end_time = date("G:i", strtotime($req->end_time));

        }



        $product->is_approved = false;


        $product->branch_id = Auth::user()->branch->id;
        $product->save();



        if ($req->product_type == "simple") {
          $option = new Option;
          $option->regular_price = $req->regular_price;
          $option->offer_price = $req->offer_price;
          $option->product_id = $product->id;
          $option->save();
        }
        else {

          for ($i=0; $i < count($req->option_name); $i++) {
            $option = new Option;
            $option->name = $req->option_name[$i];
            $option->regular_price = $req->regular_price[$i];
            $option->offer_price = $req->offer_price[$i];
            $option->product_id = $product->id;
            $option->save();
          }

        }


        return redirect('/cashier/products')->withSuccess('Category Added Successfully');
    }

    public function edit($id)
    {
        $cashier = Auth::user();
        $branch = $cashier->branch;
        $PageHeading = "Edit Product";
        $leefCategries = Category::whereIsLeaf()->get();
        $product = Product::find($id);
        return view('cashier.products.edit', compact('product', 'PageHeading','leefCategries','branch'));
    }
    public function update(Request $req)
    {
      $product = Product::find($req->product_id);
      $product->name = $req->name;
      $product->slug = $req->slug;
      $product->category_id = $req->category;

      if ($req->image) {
      $image = $req->image;
      $name=str_replace(' ', '_', $req->name.' '.time());
      $img_extension = pathinfo(storage_path().$image->getClientOriginalName(), PATHINFO_EXTENSION);
      $pretty_image_name=$name.'.'.$img_extension;
      $image->storeAs('public/ProductImages/'.str_replace(' ', '_', $req->name), $pretty_image_name);
      $fullpath = 'ProductImages/'.str_replace(' ', '_', $req->name).'/'.$pretty_image_name;

      $product->image = $fullpath;

      }

      $product->is_available = true;

      if ($req->anytime and $req->anytime=="yes") {
        $product->start_time = NULL;
        $product->end_time = NULL;
      } else {

        $product->start_time = date("G:i", strtotime($req->start_time));
        $product->end_time = date("G:i", strtotime($req->end_time));

      }

      $product->is_approved = false;

      $product->branch_id = Auth::user()->branch->id;
      $product->save();
      Option::where('product_id',$product->id)->delete();

      if ($req->product_type == "simple") {

        $option = new Option;
        $option->regular_price = $req->regular_price;
        $option->offer_price = $req->offer_price;
        $option->product_id = $product->id;
        $option->save();
      }
      else {

        for ($i=0; $i < count($req->option_name); $i++) {

          $option = new Option;
          $option->name = $req->option_name[$i];
          $option->regular_price = $req->regular_price[$i];
          $option->offer_price = $req->offer_price[$i];
          $option->product_id = $product->id;
          $option->save();
        }

      }
        return redirect('/cashier/products')->withSuccess('product updated Successfully');
    }
}
