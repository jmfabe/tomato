<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\Cart;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $request, $user)
    {


        //delete old cart


        $newcart= Cart::where('identity', '=', (string) $request->session()->get('identity'))->first();


        if ($newcart) { //if the user  added any items to the cart before logged in
            Cart::where('identity', '=', (string) $user->id)->delete();
            $newcart->identity = $user->id;
            $newcart->save();
        }
    }


    public function showLoginForm(Request $request)
    {
        $pattern = '/\blogin\b/';
        $url = url()->previous();


        if (preg_match($pattern, $url) == false) {
            $request->session()->put('targeturl', url()->previous());
        } else {
        }



        return view('auth.login');
    }
}
