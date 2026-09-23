<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
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
        $categories = \App\Models\Category::all();
        return view('auth.register', compact('categories'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:usuario,cliente,proveedor,servicios'],
        ];

        if (in_array($request->role, ['proveedor', 'servicios'])) {
            $rules['first_name'] = ['required', 'string', 'max:255'];
            $rules['last_name'] = ['required', 'string', 'max:255'];
            $rules['cedula'] = ['required', 'string', 'max:50'];
            $rules['company_name'] = ['required', 'string', 'max:255'];
            $rules['description'] = ['required', 'string'];
            $rules['category_id'] = ['required', 'integer'];
            $rules['address'] = ['required', 'string', 'max:255'];
            $rules['latitude'] = ['nullable', 'numeric'];
            $rules['longitude'] = ['nullable', 'numeric'];
        } else {
            $rules['name'] = ['required', 'string', 'max:255'];
        }

        $request->validate($rules);

        $userData = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        if (in_array($request->role, ['proveedor', 'servicios'])) {
            $userData['first_name'] = $request->first_name;
            $userData['last_name'] = $request->last_name;
            $userData['cedula'] = $request->cedula;
            $userData['name'] = $request->first_name . ' ' . $request->last_name;
        } else {
            $userData['name'] = $request->name;
        }

        $user = User::create($userData);

        if (in_array($request->role, ['proveedor', 'servicios'])) {
            Company::create([
                'email' => $user->email,
                'name' => $request->company_name,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'type_product' => $request->role === 'servicios' ? 'Servicios' : 'Productos',
            ]);
        }

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

