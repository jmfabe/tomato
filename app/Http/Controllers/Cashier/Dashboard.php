<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class Dashboard extends Controller
{
  public function __construct()
  {
    //checking the user is superadmin
      $this->middleware('auth:cashier');

  }
  public function Dashboard()
  {
        $cashier = Auth::user();
        $branch = $cashier->branch;
        $orders = $branch->orders;
    return view('cashier.dashboard',compact('branch','orders'));
  }
}
