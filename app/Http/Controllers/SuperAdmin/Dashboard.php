<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
  public function __construct()
  {
    //checking the user is superadmin
      $this->middleware('auth:superadmin');

  }
  public function Dashboard()
  {
    return view('admins.dashboard');
  }
}
