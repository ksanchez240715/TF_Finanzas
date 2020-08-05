<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = 'inicio';

    protected $username = 'username';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function username()
    {
        return 'username';
    }
    public function getLogin()
    {
        return view('auth.login');
    }

    protected function getFailedLoginMessage()
    {
        return trans('auth.failed');
    }

    private function redirectBack($request)
    {
        $errors = ['username' => trans('auth.failed')];
        return redirect()->back()
            ->withInput($request->only('username', 'remember'))
            ->withErrors($errors);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect("/login");
    }
}
