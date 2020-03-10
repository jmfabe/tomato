<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
class SuperAdminAuth extends Controller
{

    public function LoginForm()
    {
      return view('admins.login');
    }

    public function Login(Request $req)
    {
      $this->validate($req, [
              'email'   => 'required|email',
              'password' => 'required|min:6'
          ]);

          if (Auth::guard('superadmin')->attempt(['email' => $req->email, 'password' => $req->password], $req->get('remember'))) {

              return redirect('/notadmin/dashboard');
          }
          return back()->withInput($req->only('email', 'remember'));
    }
}
