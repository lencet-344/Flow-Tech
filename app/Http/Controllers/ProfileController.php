<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->name = $request->validated()['name'];
        $request->user()->save();

        if ($request->hasFile('avatar')) {
            $avatarDir = public_path('uploads/avatars');
            if (!file_exists($avatarDir)) {
                mkdir($avatarDir, 0755, true);
            }
            $filename = 'avatar_u' . $request->user()->id . '_' . md5(strtolower(trim($request->user()->email))) . '.jpg';
            $request->file('avatar')->move($avatarDir, $filename);
        }

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated')
            ->with('success', '✓ Perfil y foto actualizados correctamente');
    }

    /**
     * Upload avatar via AJAX.
     */
    public function updateAvatar(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
            ]);

            $avatarDir = public_path('uploads/avatars');
            if (!file_exists($avatarDir)) {
                mkdir($avatarDir, 0755, true);
            }
            $filename = 'avatar_u' . $request->user()->id . '_' . md5(strtolower(trim($request->user()->email))) . '.jpg';
            $request->file('avatar')->move($avatarDir, $filename);

            $userAvatarRelPath = 'uploads/avatars/' . $filename;
            
            return response()->json([
                'success' => true, 
                'avatar_url' => asset($userAvatarRelPath) . '?v=' . time()
            ]);
        }
        
        return response()->json(['success' => false], 400);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'Tu cuenta ha sido eliminada.');
    }
}
