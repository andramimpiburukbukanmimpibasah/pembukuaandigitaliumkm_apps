<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kas') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6">
                    <p class="text-sm font-medium text-slate-500">Total Pemasukan</p>
                    <p class="mt-2 text-3xl font-bold text-brand-secondary">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6">
                    <p class="text-sm font-medium text-slate-500">Total Pengeluaran</p>
                    <p class="mt-2 text-3xl font-bold text-red-600">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6">
                    <p class="text-sm font-medium text-slate-500">Saldo Kas</p>
                    <p class="mt-2 text-3xl font-bold text-brand-teal">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Form Tambah -->
            <div class="mt-6 bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6">
                <h3 class="font-semibold text-lg text-slate-800 mb-4">Catat Transaksi Kas</h3>

                <form method="POST" action="{{ route('cashes.store') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @csrf

                    <div>
                        <x-input-label for="tanggal" :value="__('Tanggal')" />
                        <x-text-input id="tanggal" type="date" name="tanggal" class="mt-1 block w-full" :value="old('tanggal', now()->format('Y-m-d'))" required />
                        <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="jenis" :value="__('Jenis')" />
                        <select id="jenis" name="jenis" class="mt-1 block w-full border-gray-300 focus:border-brand-primary focus:ring-2 focus:ring-brand-primary rounded-xl py-2.5 px-3.5 shadow-sm" required>
                            <option value="pemasukan" {{ old('jenis') === 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                            <option value="pengeluaran" {{ old('jenis') === 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                        </select>
                        <x-input-error :messages="$errors->get('jenis')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="kategori" :value="__('Kategori')" />
                        <x-text-input id="kategori" type="text" name="kategori" class="mt-1 block w-full" :value="old('kategori')" placeholder="Contoh: Penjualan, Pembelian, Gaji" required />
                        <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="nominal" :value="__('Nominal (Rp)')" />
                        <x-text-input id="nominal" type="number" name="nominal" class="mt-1 block w-full" :value="old('nominal')" min="1" required />
                        <x-input-error :messages="$errors->get('nominal')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="metode" :value="__('Metode')" />
                        <select id="metode" name="metode" class="mt-1 block w-full border-gray-300 focus:border-brand-primary focus:ring-2 focus:ring-brand-primary rounded-xl py-2.5 px-3.5 shadow-sm" required>
                            <option value="Tunai" {{ old('metode') == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                            <option value="Transfer" {{ old('metode') == 'Transfer' ? 'selected' : '' }}>Transfer Bank</option>
                            <option value="QRIS" {{ old('metode') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                        </select>
                        <x-input-error :messages="$errors->get('metode')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="keterangan" :value="__('Keterangan')" />
                        <x-text-input id="keterangan" type="text" name="keterangan" class="mt-1 block w-full" :value="old('keterangan')" />
                        <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                    </div>

                    <div class="md:col-span-3">
                        <x-primary-button>
                            {{ __('Simpan Transaksi Kas') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Riwayat -->
            <div class="mt-6 bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6">
                <h3 class="font-semibold text-lg text-slate-800 mb-4">Riwayat Transaksi Kas</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Jenis</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Metode</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Nominal</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Saldo Berjalan</th>
                                @if (auth()->user()->isAdmin())
                                <th class="px-4 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($rows as $cash)
                                <tr>
                                    <td class="px-4 py-3 text-sm text-slate-700">{{ $cash->tanggal->translatedFormat('d M Y') }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        <span class="px-2 py-1 rounded-lg text-xs font-semibold {{ $cash->jenis === 'pemasukan' ? 'bg-brand-secondary/15 text-brand-secondary' : 'bg-red-100 text-red-700' }}">
                                            {{ ucfirst($cash->jenis) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-slate-700">{{ $cash->kategori }}</td>
                                    <td class="px-4 py-3 text-sm text-slate-500">{{ $cash->metode ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm font-semibold text-right {{ $cash->jenis === 'pemasukan' ? 'text-brand-secondary' : 'text-red-600' }}">
                                        {{ $cash->jenis === 'pemasukan' ? '+' : '-' }} Rp {{ number_format($cash->nominal, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3 text-sm font-medium text-right text-slate-700">Rp {{ number_format($cash->saldo_berjalan, 0, ',', '.') }}</td>
                                    @if (auth()->user()->isAdmin())
                                    <td class="px-4 py-3 text-right whitespace-nowrap">
                                        <a href="{{ route('cashes.edit', $cash) }}" class="text-yellow-600 hover:text-yellow-900 text-sm font-medium mr-2">Edit</a>
                                        <form action="{{ route('cashes.destroy', $cash) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus transaksi kas ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">Hapus</button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-6 text-center text-sm text-slate-500">Belum ada transaksi kas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
