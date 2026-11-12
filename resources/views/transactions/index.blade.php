<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Tambah Transaksi -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6">
                <h3 class="font-semibold text-lg text-slate-800 mb-4">Catat Transaksi Penjualan</h3>

                <form method="POST" action="{{ route('transactions.store') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @csrf

                    <div>
                        <x-input-label for="tanggal_transaksi" :value="__('Tanggal')" />
                        <x-text-input id="tanggal_transaksi" type="date" name="tanggal_transaksi" class="mt-1 block w-full" :value="old('tanggal_transaksi', now()->format('Y-m-d'))" required />
                        <x-input-error :messages="$errors->get('tanggal_transaksi')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="product_id" :value="__('Produk')" />
                        <select id="product_id" name="product_id" class="mt-1 block w-full border-gray-300 focus:border-brand-primary focus:ring-2 focus:ring-brand-primary rounded-xl py-2.5 px-3.5 shadow-sm" required>
                            <option value="">-- Pilih Produk --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" data-harga="{{ $product->harga }}" data-stok="{{ $product->stok }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->nama_produk }} (Rp {{ number_format($product->harga, 0, ',', '.') }}, Stok: {{ $product->stok }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="jumlah" :value="__('Jumlah')" />
                        <x-text-input id="jumlah" type="number" name="jumlah" class="mt-1 block w-full" :value="old('jumlah', 1)" min="1" required />
                        <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="total" :value="__('Total (Rp)')" />
                        <x-text-input id="total" type="text" class="mt-1 block w-full bg-slate-50" readonly placeholder="0" />
                    </div>

                    <div>
                        <x-input-label for="metode_pembayaran" :value="__('Metode Pembayaran')" />
                        <select id="metode_pembayaran" name="metode_pembayaran" class="mt-1 block w-full border-gray-300 focus:border-brand-primary focus:ring-2 focus:ring-brand-primary rounded-xl py-2.5 px-3.5 shadow-sm" required>
                            <option value="Tunai" {{ old('metode_pembayaran') == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                            <option value="Transfer" {{ old('metode_pembayaran') == 'Transfer' ? 'selected' : '' }}>Transfer Bank</option>
                            <option value="QRIS" {{ old('metode_pembayaran') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                        </select>
                        <x-input-error :messages="$errors->get('metode_pembayaran')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="keterangan" :value="__('Keterangan')" />
                        <x-text-input id="keterangan" type="text" name="keterangan" class="mt-1 block w-full" :value="old('keterangan')" />
                        <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                    </div>

                    <div class="md:col-span-3">
                        <x-primary-button>
                            {{ __('Simpan Transaksi') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Riwayat Transaksi -->
            <div class="mt-6 bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6">
                <h3 class="font-semibold text-lg text-slate-800 mb-4">Riwayat Transaksi</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">No. Transaksi</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Produk</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">Jumlah</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Total</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Metode</th>
                                @if (auth()->user()->isAdmin())
                                <th class="px-4 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($transactions as $transaction)
                                <tr>
                                    <td class="px-4 py-3 text-sm font-semibold text-brand-primary">{{ $transaction->no_transaksi }}</td>
                                    <td class="px-4 py-3 text-sm text-slate-700">{{ $transaction->tanggal_transaksi->translatedFormat('d M Y') }}</td>
                                    <td class="px-4 py-3 text-sm text-slate-700">{{ $transaction->product?->nama_produk ?? 'Produk dihapus' }}</td>
                                    <td class="px-4 py-3 text-sm text-center text-slate-700">{{ $transaction->jumlah }}</td>
                                    <td class="px-4 py-3 text-sm font-semibold text-right text-brand-secondary">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-sm text-slate-500">{{ $transaction->metode_pembayaran ?? '-' }}</td>
                                    @if (auth()->user()->isAdmin())
                                    <td class="px-4 py-3 text-right whitespace-nowrap">
                                        <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus transaksi ini? Stok produk akan dikembalikan.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">Hapus</button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-6 text-center text-sm text-slate-500">Belum ada transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const product = document.getElementById('product_id');
            const jumlah = document.getElementById('jumlah');
            const total = document.getElementById('total');

            function hitung() {
                const opt = product.selectedOptions[0];
                if (!opt || !opt.dataset.harga) { total.value = ''; return; }
                const harga = parseInt(opt.dataset.harga, 10) || 0;
                const qty = parseInt(jumlah.value, 10) || 0;
                total.value = (harga * qty).toLocaleString('id-ID');
            }

            product.addEventListener('change', hitung);
            jumlah.addEventListener('input', hitung);
        });
    </script>
</x-app-layout>
