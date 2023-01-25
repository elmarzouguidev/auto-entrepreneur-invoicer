<?php

namespace App\Http\Controllers\Authentification;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginForm()
    {
        return view('theme.Authentification.Login.index');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if (! Auth::user()->active) {
            Auth::logout();

            return redirect(route('admin:auth:login'))->withErrors(['Votre compte est désactivé']);
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect(route('admin:auth:login'));
    }

    /**
     * @return string
     */
    private function redirectTo()
    {
        return route('admin:home');
    }
}
