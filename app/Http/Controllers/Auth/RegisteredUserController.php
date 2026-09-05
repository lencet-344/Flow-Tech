<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:usuario,cliente,proveedor,servicios'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

    Auth::login($user); // Mantenemos el login para que el sistema sepa a quién enviarle el 2FA

    // ==========================================
    // 🔒 INYECCIÓN DEL SISTEMA 2FA
    // ==========================================
    $code = random_int(100000, 999999);
    
    $user->two_factor_code = $code;
    $user->two_factor_expires_at = now()->addMinutes(10);
    $user->save(); 

    \Illuminate\Support\Facades\Mail::send('emails.verificacion_code', [
        'code' => $code, 
        'name' => $user->name
    ], function ($message) use ($user) {
        $message->to($user->email)
                ->subject('Tu código de acceso único - SINGKI');
    });

    // Redirigimos a la pantalla visual que maquetaste
    return redirect()->route('2fa.index');
}
    }

