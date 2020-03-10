<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class CashierAuth extends Controller
{
    public function LoginForm()
    {
      return view('cashier.login');
    }

    public function Login(Request $req)
    {
          if (Auth::guard('cashier')->attempt(['username' => $req->username, 'password' => $req->password], $req->get('remember'))) {

              return redirect('/cashier/dashboard');
          }
          return back()->withInput($req->only('email', 'remember'));
    }

    public function username()
    {
    return 'username';
    }
}
