<?php

namespace App\Http\Controllers\Authentification;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('theme.Authentification.Password.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    private function redirectTo()
    {
        return route('admin:home');
    }
}
