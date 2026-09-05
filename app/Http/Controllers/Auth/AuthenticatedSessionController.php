<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail; 

class AuthenticatedSessionController extends Controller
{
    
    public function create(): View
    {
        return view('auth.login');
    }

        public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate(); 

        $request->session()->regenerate(); 

        $user = Auth::user(); 
        
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

        return redirect()->route('2fa.index');
    }
    
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('info', 'Has cerrado sesión.');
    }
}