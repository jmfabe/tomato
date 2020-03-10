<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
  public function __construct()
  {
    //checking the user is superadmin
      $this->middleware('auth:cashier');

  }
  public function Dashboard()
  {
    return view('cashier.dashboard');
  }
}
