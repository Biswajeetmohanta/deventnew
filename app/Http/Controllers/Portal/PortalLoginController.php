<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PortalLoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->isClient()) {
            return redirect()->intended(url('/portal'));
        }
        return view('portal.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();

            if ($user->isClient()) {
                $request->session()->regenerate();
                return redirect()->intended(url('/portal'));
            }

            // If logged in user is not a client, log them out and return error
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'Unauthorized. This portal is for clients only.',
            ]);
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(url('/portal/login'));
    }
}
