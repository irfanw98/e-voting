<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
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
    protected $redirectTo = 'dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required|string',
            'password' => 'required'
        ]);

        $loginType = filter_var($request->nim, FILTER_VALIDATE_EMAIL) ? 'email' : 'nim';

        $login = [
            $loginType => $request->nim,
            'password' => $request->password
        ];

        //Berhasil Login
        if (auth()->attempt($login)) {
            return redirect()->route('dashboard');
        }
        

        return redirect()->route('login')->with(['error' => 'Nim atau password anda salah!']);
    }
}
