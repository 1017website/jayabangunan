<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.form', ['user' => new User()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'required|in:admin,editor',
            'password' => ['required', Password::min(8)->letters()->numbers()],
            'password_confirmation' => 'required|same:password',
        ], [
            'password.min'                    => 'Password minimal 8 karakter.',
            'password_confirmation.same'      => 'Konfirmasi password tidak cocok.',
            'email.unique'                    => 'Email sudah digunakan.',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.users.form', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:admin,editor',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // Tidak boleh hapus diri sendiri
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Tidak dapat menghapus akun yang sedang digunakan.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    // ── Ganti Password (untuk user lain, oleh admin) ──────────────
    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'new_password'              => ['required', Password::min(8)->letters()->numbers()],
            'new_password_confirmation' => 'required|same:new_password',
        ], [
            'new_password.min'                    => 'Password minimal 8 karakter.',
            'new_password_confirmation.same'      => 'Konfirmasi password tidak cocok.',
        ]);

        $user->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Password user ' . $user->name . ' berhasil direset.');
    }

    // ── Ganti Password sendiri (profil) ──────────────────────────
    public function profile()
    {
        $user = Auth::user();
        return view('admin.users.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.profile')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password'          => 'required',
            'new_password'              => ['required', 'different:current_password', Password::min(8)->letters()->numbers()],
            'new_password_confirmation' => 'required|same:new_password',
        ], [
            'new_password.different'              => 'Password baru harus berbeda dari password lama.',
            'new_password.min'                    => 'Password minimal 8 karakter.',
            'new_password_confirmation.same'      => 'Konfirmasi password tidak cocok.',
        ]);

        // Verifikasi password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('admin.profile')
            ->with('success', 'Password berhasil diubah. Silakan login ulang.');
    }
}
