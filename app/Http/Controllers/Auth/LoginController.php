<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = 'home';

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
        Auth::logoutOtherDevices($request->password); // logout other devices 

        $credentials = $request->only('email', 'password');

        // admin
        if(Auth::attempt($credentials) && Gate::allows('admin')) {
            $request->session()->regenerate();
            return redirect(route('home.index'));
        }
  
        // user
        if(Auth::attempt($credentials) && Gate::allows('user')) {
            $request->session()->regenerate();
            return redirect(route('dashboard.index'));
        }
    }
}
