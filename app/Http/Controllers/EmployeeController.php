<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    /**
     * Tampilkan daftar pegawai milik umkm admin yang sedang login.
     */
    public function index(): View
    {
        $umkm = auth()->user()->umkm;

        $employees = User::where('umkm_id', $umkm?->id)
            ->where('role', 'pegawai')
            ->orderBy('name')
            ->get();

        return view('employees.index', compact('employees'));
    }

    /**
     * Buat akun pegawai yang terikat ke umkm admin yang membuatnya.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin = $request->user();

        User::create([
            'umkm_id' => $admin->umkm_id,
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'role' => 'pegawai',
        ]);

        return redirect()->route('employees.index')
            ->with('success', 'Akun pegawai berhasil dibuat dan terhubung ke usaha Anda.');
    }

    /**
     * Hapus akun pegawai (hanya milik umkm admin, tidak bisa hapus akun admin).
     */
    public function destroy(User $employee): RedirectResponse
    {
        abort_unless(
            $employee->isPegawai() && $employee->umkm_id === auth()->user()->umkm_id,
            403,
            'Tidak boleh menghapus akun ini.'
        );

        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Akun pegawai berhasil dihapus.');
    }
}
