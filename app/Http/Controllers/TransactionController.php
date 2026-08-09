<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index(): View
    {
        $transactions = Transaction::with('product')->latest('tanggal_transaksi')->latest('id')->get();
        $products = Product::orderBy('nama_produk')->get();

        return view('transactions.index', compact('transactions', 'products'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'tanggal_transaksi' => ['required', 'date'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'metode_pembayaran' => ['nullable', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ]);

        try {
            $transaction = DB::transaction(function () use ($request, $validated) {
                $product = Product::lockForUpdate()->findOrFail($validated['product_id']);

                if ($product->stok < $validated['jumlah']) {
                    throw new \Exception('Stok produk tidak mencukupi (sisa '.$product->stok.').');
                }

                $noTransaksi = 'TRX-'.now()->format('Ymd').'-'.strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6));

                $product->decrement('stok', $validated['jumlah']);

                $transaction = Transaction::create([
                    'no_transaksi' => $noTransaksi,
                    'tanggal_transaksi' => $validated['tanggal_transaksi'],
                    'jenis' => 'penjualan',
                    'product_id' => $product->id,
                    'jumlah' => $validated['jumlah'],
                    'total' => $product->harga * $validated['jumlah'],
                    'metode_pembayaran' => $validated['metode_pembayaran'],
                    'keterangan' => $validated['keterangan'],
                ]);

                Cash::create([
                    'transaction_id' => $transaction->id,
                    'tanggal' => $validated['tanggal_transaksi'],
                    'jenis' => 'pemasukan',
                    'kategori' => 'Penjualan Produk',
                    'nominal' => $transaction->total,
                    'metode' => $validated['metode_pembayaran'],
                    'keterangan' => 'Penjualan: '.$product->nama_produk.' ('.$validated['jumlah'].' pcs)',
                ]);

                return $transaction;
            });
        } catch (\Exception $e) {
            return redirect()->route('transactions.index')
                ->withInput()
                ->withErrors(['product_id' => $e->getMessage()]);
        }

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi '.$transaction->no_transaksi.' berhasil dicatat.');
    }

    public function destroy(Transaction $transaction): RedirectResponse
    {
        DB::transaction(function () use ($transaction) {
            $transaction->product()?->increment('stok', $transaction->jumlah);
            $transaction->delete();
        });

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus dan stok dikembalikan.');
    }
}
