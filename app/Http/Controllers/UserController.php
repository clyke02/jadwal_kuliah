<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()
                ->route('users.index')
                ->with('error', 'Tidak bisa menghapus akun yang sedang digunakan!');
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Pengguna berhasil dihapus!');
    }
}
