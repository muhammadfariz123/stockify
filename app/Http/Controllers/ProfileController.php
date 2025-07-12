<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\ActivityLog; // ✅ Tambahkan

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
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        // ✅ Logging aktivitas update profil
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Mengupdate Profil',
            'description' => 'Pengguna "' . Auth::user()->name . '" memperbarui profil.',
        ]);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

        // ✅ Logging sebelum akun dihapus
        ActivityLog::create([
            'user_id' => $user->id,
            'role' => $user->role ?? 'User',
            'activity' => 'Menghapus Akun',
            'description' => 'Akun pengguna "' . $user->name . '" dihapus.',
        ]);

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
