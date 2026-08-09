<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6">
                <h3 class="text-lg font-semibold text-slate-800">
                    Selamat datang, {{ Auth::user()->name }}!
                </h3>
                <p class="mt-1 text-sm text-slate-500">
                    {{ auth()->user()->umkm?->nama_usaha ? 'Ringkasan keuangan usaha '.auth()->user()->umkm->nama_usaha.'.' : 'Kelola pembukuan usaha Anda dari sini.' }}
                </p>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 flex items-center gap-4">
                    <div class="h-12 w-12 shrink-0 rounded-xl bg-brand-light flex items-center justify-center">
                        <svg class="w-6 h-6 text-brand-teal" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-slate-500">Saldo</p>
                        <p class="mt-1 text-2xl font-bold text-brand-teal truncate">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 flex items-center gap-4">
                    <div class="h-12 w-12 shrink-0 rounded-xl bg-brand-secondary/15 flex items-center justify-center">
                        <svg class="w-6 h-6 text-brand-secondary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-slate-500">Pendapatan</p>
                        <p class="mt-1 text-2xl font-bold text-brand-secondary truncate">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 flex items-center gap-4">
                    <div class="h-12 w-12 shrink-0 rounded-xl bg-rose-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-rose-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0 3.182-5.511m-3.182 5.51-5.511-3.181" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-slate-500">Pengeluaran</p>
                        <p class="mt-1 text-2xl font-bold text-rose-600 truncate">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 flex items-center gap-4">
                    <div class="h-12 w-12 shrink-0 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.031.352 5.988 5.988 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971Zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 0 1-2.031.352 5.989 5.989 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971Z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-slate-500">Laba</p>
                        <p class="mt-1 text-2xl font-bold truncate {{ $laba >= 0 ? 'text-slate-800' : 'text-red-600' }}">Rp {{ number_format($laba, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Chart + Stats -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6">
                    <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
                        <h3 class="font-semibold text-lg text-slate-800">Pemasukan vs Pengeluaran ({{ $periodLabel }})</h3>
                        <form method="GET" action="{{ route('dashboard') }}" class="flex items-center gap-2">
                            <label for="filter" class="sr-only">Filter Rentang Waktu</label>
                            <div class="relative">
                                <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                                <select name="filter" id="filter" onchange="this.form.submit()" class="pl-9 pr-3 py-2 text-sm rounded-xl border-gray-300 shadow-sm focus:border-brand-primary focus:ring-brand-primary bg-white">
                                    <option value="today" {{ $filter === 'today' ? 'selected' : '' }}>Hari Ini</option>
                                    <option value="7_days" {{ $filter === '7_days' ? 'selected' : '' }}>7 Hari Terakhir</option>
                                    <option value="this_month" {{ $filter === 'this_month' ? 'selected' : '' }}>Bulan Ini</option>
                                    <option value="6_months" {{ $filter === '6_months' ? 'selected' : '' }}>6 Bulan Terakhir</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="relative h-80">
                        <canvas id="dashboardChart" data-labels='{{ json_encode($chart['labels']) }}' data-pemasukan='{{ json_encode($chart['pemasukan']) }}' data-pengeluaran='{{ json_encode($chart['pengeluaran']) }}'></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6">
                    <h3 class="font-semibold text-lg text-slate-800 mb-4">Statistik Usaha</h3>
                    <dl class="space-y-4 text-sm">
                        <div class="flex items-center justify-between">
                            <dt class="flex items-center gap-2.5 text-slate-500">
                                <span class="h-10 w-10 shrink-0 rounded-lg bg-brand-secondary/15 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-brand-secondary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                    </svg>
                                </span>
                                Total Produk
                            </dt>
                            <dd class="font-bold text-slate-800">{{ number_format($totalProduk, 0, ',', '.') }}</dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt class="flex items-center gap-2.5 text-slate-500">
                                <span class="h-10 w-10 shrink-0 rounded-lg bg-brand-secondary/15 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-brand-secondary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-4.5h.008v.008H7.5V13.5Zm0 3h.008v.008H7.5V16.5Zm0-6h.008v.008H7.5V10.5Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3h10.5a2.25 2.25 0 0 1 2.25 2.25v16.5L18 20.25l-1.5 1.5-1.5-1.5-1.5 1.5-1.5-1.5-1.5 1.5-1.5-1.5-1.5 1.5L4.5 5.25A2.25 2.25 0 0 1 6.75 3Z" />
                                    </svg>
                                </span>
                                Total Transaksi
                            </dt>
                            <dd class="font-bold text-slate-800">{{ number_format($totalTransaksi, 0, ',', '.') }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6 space-y-3">
                        <a href="{{ route('transactions.index') }}" class="block w-full text-center px-4 py-2.5 bg-brand-primary hover:bg-brand-primary-hover text-white text-sm font-semibold rounded-xl shadow-md transition duration-200">
                            + Catat Transaksi
                        </a>
                        <a href="{{ route('cashes.index') }}" class="block w-full text-center px-4 py-2.5 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-sm font-semibold rounded-xl transition duration-200">
                            Kelola Kas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const el = document.getElementById('dashboardChart');
            if (el && window.Chart) {
                new Chart(el, {
                    type: 'line',
                    data: {
                        labels: JSON.parse(el.dataset.labels),
                        datasets: [
                            {
                                label: 'Pemasukan',
                                data: JSON.parse(el.dataset.pemasukan),
                                borderColor: 'rgb(20, 141, 58)',
                                backgroundColor: 'rgba(20, 141, 58, 0.1)',
                                fill: true,
                                tension: 0.4,
                            },
                            {
                                label: 'Pengeluaran',
                                data: JSON.parse(el.dataset.pengeluaran),
                                borderColor: 'rgb(239, 68, 68)',
                                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                                fill: true,
                                tension: 0.4,
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
