<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UmkmProfileController extends Controller
{
    public function index(): View
    {
        $umkm = auth()->user()->umkm;

        $stats = [
            'bergabung' => $umkm?->created_at,
            'total_transaksi' => Transaction::count(),
            'total_produk' => Product::count(),
        ];

        return view('profiles.index', compact('umkm', 'stats'));
    }

    public function update(Request $request): RedirectResponse
    {
        $umkm = auth()->user()->umkm;

        $validated = $request->validate([
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'nama_usaha' => ['required', 'string', 'max:255'],
            'nama_brand' => ['nullable', 'string', 'max:255'],
            'pemilik' => ['nullable', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
            'no_hp' => ['required', 'string', 'max:20'],
            'jenis_usaha' => ['nullable', 'string', 'max:255'],
            'deskripsi_usaha' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('logo')) {
            if ($umkm->logo) {
                Storage::disk('public')->delete($umkm->logo);
            }

            $file = $request->file('logo');
            $filename = 'logos/'.Str::uuid().'.'.$file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('logos', $file, basename($filename));

            $validated['logo'] = $filename;
        }

        $umkm->update($validated);

        return redirect()->route('umkm-profile.index')
            ->with('success', 'Profil usaha berhasil diperbarui.');
    }
}
