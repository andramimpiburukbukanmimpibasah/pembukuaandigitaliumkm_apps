<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CashController extends Controller
{
    public function index(): View
    {
        $cashes = Cash::latest('tanggal')->latest('id')->get();

        $totalPemasukan = Cash::where('jenis', 'pemasukan')->sum('nominal');
        $totalPengeluaran = Cash::where('jenis', 'pengeluaran')->sum('nominal');
        $saldo = $totalPemasukan - $totalPengeluaran;

        $running = 0;
        $rows = $cashes->map(function ($cash) use (&$running) {
            $running += $cash->jenis === 'pemasukan' ? $cash->nominal : -$cash->nominal;
            $cash->saldo_berjalan = $running;

            return $cash;
        });

        return view('cashes.index', compact('cashes', 'rows', 'totalPemasukan', 'totalPengeluaran', 'saldo'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'jenis' => ['required', 'in:pemasukan,pengeluaran'],
            'kategori' => ['required', 'string', 'max:255'],
            'nominal' => ['required', 'integer', 'min:1'],
            'metode' => ['nullable', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ]);

        Cash::create($validated);

        return redirect()->route('cashes.index')
            ->with('success', 'Transaksi kas berhasil dicatat.');
    }

    public function edit(Cash $cash): View
    {
        return view('cashes.edit', compact('cash'));
    }

    public function update(Request $request, Cash $cash): RedirectResponse
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'jenis' => ['required', 'in:pemasukan,pengeluaran'],
            'kategori' => ['required', 'string', 'max:255'],
            'nominal' => ['required', 'integer', 'min:1'],
            'metode' => ['nullable', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $cash->update($validated);

        return redirect()->route('cashes.index')
            ->with('success', 'Transaksi kas berhasil diperbarui.');
    }

    public function destroy(Cash $cash): RedirectResponse
    {
        $cash->delete();

        return redirect()->route('cashes.index')
            ->with('success', 'Transaksi kas berhasil dihapus.');
    }
}
