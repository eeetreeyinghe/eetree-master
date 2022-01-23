<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

// use Socialite;

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
    public function __construct(Request $request)
    {
        if ($request->isMethod('get')) {
            session(['url.intended' => url()->previous()]);
        }
        $this->middleware('guest')->except('logout');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $account = $request->input('account');
        $password = $request->input('password');
        if (preg_match('/^1[0-9]{10}$/', $account)) {
            $field = 'mobile';
        } else {
            $field = 'name';
        }
        return $this->guard()->attempt([$field => $account, 'password' => $password], $request->filled('remember'));
    }

    public function username()
    {
        return 'account';
    }

    /**
     * Redirect the user to the weixin authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToWeixin()
    {
        // return Socialite::driver('weixinweb')->redirect();
    }

    /**
     * Obtain the user information from Weixinweb.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleWeixinCallback()
    {
        // $user = Socialite::driver('weixinweb')->user();
        // Socialite::driver('weixinweb')->stateless()->user()
        // $accessTokenResponseBody = $user->accessTokenResponseBody;

        // $user->token;
    }

    public function redirectToQQ()
    {
        // return Socialite::driver('qq')->redirect();
    }

    public function handleQQCallback()
    {
        // $user = Socialite::driver('qq')->user();
        // $accessTokenResponseBody = $user->accessTokenResponseBody;

        // $user->token;
    }
}
