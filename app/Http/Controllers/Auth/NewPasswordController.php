<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'code' => ['required', 'numeric', 'digits:6'],
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'code.required' => 'El código de verificación es obligatorio.',
            'code.digits' => 'El código debe tener exactamente 6 dígitos.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->two_factor_code != $request->code || !$user->two_factor_expires_at || now()->greaterThan($user->two_factor_expires_at)) {
            return back()->withInput($request->only('email'))->withErrors(['code' => 'El código de verificación es incorrecto o ha expirado.']);
        }

        $user->password = Hash::make($request->password);
        $user->two_factor_code = null;
        $user->two_factor_expires_at = null;
        $user->save();

        return redirect()->route('login')->with('status', '¡Tu contraseña ha sido actualizada correctamente! Ya puedes iniciar sesión.');
    }
}
