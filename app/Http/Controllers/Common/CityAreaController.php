<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch;

class CityAreaController extends Controller
{
  public function submit(Request $req)
  {
    $req->session()->put('city', $req->city);
    $req->session()->put('area', $req->area);
    return redirect()->back();
  }

  public function getAreas($cityname)
  {
    $branches = Branch::where('city',$cityname)->get();
    return $branches;
  }
}
