<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class BranchController extends Controller
{
  public function __construct()
  {
    //checking the user is superadmin
      $this->middleware('auth:cashier');

  }
  public function view()
  {
    $cashier = Auth::user();
    $branch = $cashier->branch;
    return view('cashier.branchinfo',compact('branch'));
  }
}
