<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Keuangan') }}
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            {{ __('by Pusat Layanan Kemasan Kalimantan Selatan') }}
        </p>
    </x-slot>

    <div class="py-8 print:py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter & Action Buttons (hidden saat print) -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6 print:hidden">
                <form method="GET" action="{{ route('reports.index') }}" class="flex flex-col sm:flex-row gap-3 items-end">
                    <div>
                        <x-input-label for="tanggal_mulai" :value="__('Dari Tanggal')" />
                        <x-text-input id="tanggal_mulai" type="date" name="tanggal_mulai" class="mt-1 block" :value="$start->format('Y-m-d')" />
                    </div>
                    <div>
                        <x-input-label for="tanggal_selesai" :value="__('Sampai Tanggal')" />
                        <x-text-input id="tanggal_selesai" type="date" name="tanggal_selesai" class="mt-1 block" :value="$end->format('Y-m-d')" />
                    </div>
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#148d3a] hover:bg-[#10722f] text-white font-semibold rounded-xl transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Tampilkan</span>
                    </button>
                </form>

                <div class="flex flex-wrap gap-2">
                    <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 font-medium rounded-xl transition-all shadow-sm">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        <span>Cetak</span>
                    </button>
                    <a href="{{ route('reports.export-pdf', request()->query()) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-medium rounded-xl transition-all shadow-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <span>Ekspor PDF</span>
                    </a>
                    <a href="{{ route('reports.export-excel', request()->query()) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#0c6649] hover:bg-[#094d37] text-white font-medium rounded-xl transition-all shadow-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Ekspor Excel</span>
                    </a>
                </div>
            </div>

            <!-- Report Header (tampil saat print) -->
            <div class="hidden print:block mb-6">
                <div class="flex items-center gap-4 border-b-2 border-brand-teal pb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Pusat Layanan Kemasan" class="h-14 w-14 object-contain">
                    <div>
                        <h1 class="text-2xl font-bold text-brand-teal uppercase">Laporan Keuangan UMKM</h1>
                        <p class="mt-0.5 text-sm font-medium text-slate-600">Binaan Pusat Layanan Kemasan Provinsi Kalimantan Selatan</p>
                    </div>
                </div>
                <div class="mt-3 text-sm">
                    @if (auth()->user()->umkm?->nama_usaha)
                        <p><span class="text-slate-500">Nama Usaha:</span> <strong>{{ auth()->user()->umkm->nama_usaha }}</strong></p>
                    @endif
                    @if (auth()->user()->umkm?->pemilik)
                        <p><span class="text-slate-500">Pemilik:</span> <strong>{{ auth()->user()->umkm->pemilik }}</strong></p>
                    @endif
                    <p><span class="text-slate-500">Periode:</span> <strong>{{ $start->translatedFormat('d F Y') }} - {{ $end->translatedFormat('d F Y') }}</strong></p>
                </div>
            </div>

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
                    <p class="text-sm font-medium text-slate-500">Laba Bersih</p>
                    <p class="mt-2 text-3xl font-bold {{ $labaBersih >= 0 ? 'text-brand-primary' : 'text-red-600' }}">Rp {{ number_format($labaBersih, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Chart -->
            <div class="mt-6 bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6 print:hidden">
                <h3 class="font-semibold text-lg text-slate-800 mb-4">Pemasukan vs Pengeluaran</h3>
                <div class="relative h-80">
                        <canvas id="reportChart" data-labels='{{ json_encode($chart['labels']) }}' data-pemasukan='{{ json_encode($chart['pemasukan']) }}' data-pengeluaran='{{ json_encode($chart['pengeluaran']) }}'></canvas>
                </div>
            </div>

            <!-- Detail Table -->
            <div class="mt-6 bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6">
                <h3 class="font-semibold text-lg text-slate-800 mb-4">Detail Arus Kas</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Jenis</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Metode</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($cashes as $cash)
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
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-sm text-slate-500">Belum ada transaksi kas pada periode ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer (tampil saat print) -->
    <div class="hidden print:block mt-8 text-center text-xs text-slate-400 border-t border-slate-200 pt-4">
        <p>Dokumen ini dicetak secara otomatis melalui Sistem Laporan Keuangan UMKM pada {{ date('d-m-Y H:i') }} WITA</p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const el = document.getElementById('reportChart');
            if (el && window.Chart) {
                new Chart(el, {
                    type: 'bar',
                    data: {
                        labels: JSON.parse(el.dataset.labels),
                        datasets: [
                            {
                                label: 'Pemasukan',
                                data: JSON.parse(el.dataset.pemasukan),
                                backgroundColor: 'rgba(20, 141, 58, 0.8)',
                                borderRadius: 8,
                            },
                            {
                                label: 'Pengeluaran',
                                data: JSON.parse(el.dataset.pengeluaran),
                                backgroundColor: 'rgba(239, 68, 68, 0.8)',
                                borderRadius: 8,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { position: 'top' } },
                        scales: { y: { beginAtZero: true, ticks: { callback: (v) => 'Rp ' + v.toLocaleString('id-ID') } } },
                    },
                });
            }
        });
    </script>
</x-app-layout>
