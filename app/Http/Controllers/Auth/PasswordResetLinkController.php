<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withInput($request->only('email'))
                         ->withErrors(['email' => 'No encontramos ninguna cuenta registrada con ese correo electrónico.']);
        }

        $code = random_int(100000, 999999);
        $user->two_factor_code = $code;
        $user->two_factor_expires_at = now()->addMinutes(10);
        $user->save();

        \Illuminate\Support\Facades\Mail::send('emails.verificacion_code', ['code' => $code, 'name' => $user->name], function ($message) use ($user) {
            $message->to($user->email)->subject('Código para restablecer tu contraseña - SINGKI');
        });

        session(['reset_email' => $user->email]);

        return redirect()->route('password.reset.code')->with('status', 'Hemos enviado un código de 6 dígitos a tu correo electrónico.');
    }
}
