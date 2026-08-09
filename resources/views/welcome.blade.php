<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laporan Keuangan') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-slate-50 via-brand-light to-slate-100">
        <!-- Header Navigation -->
        <header class="sticky top-0 z-20 bg-white/80 backdrop-blur border-b border-slate-200">
            <div class="max-w-7xl mx-auto flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Pusat Layanan Kemasan" class="w-10 h-10 object-contain">
                        <div>
                            <h1 class="font-bold text-lg text-gray-900 leading-tight">Laporan <span class="text-brand-primary">Keuangan</span></h1>
                            <p class="text-[10px] text-gray-500 leading-tight">Pusat Layanan Kemasan Kalimantan Selatan</p>
                        </div>
                    </div>
                </a>

                <!-- Auth Buttons -->
                <nav class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-brand-primary hover:bg-brand-primary-hover text-white text-sm font-semibold rounded-xl shadow-md transition duration-200">
                            {{ __('Ke Dashboard') }}
                        </a>
                    @else
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-slate-700 hover:text-brand-primary text-sm font-semibold rounded-xl transition duration-200">
                                {{ __('Masuk') }}
                            </a>
                        @endif

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-brand-primary hover:bg-brand-primary-hover text-white text-sm font-semibold rounded-xl shadow-md transition duration-200">
                                {{ __('Daftar Sekarang') }}
                            </a>
                        @endif
                    @endauth
                </nav>
            </div>
        </header>

        <!-- Hero Section -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28 flex flex-col items-center text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-brand-light border border-brand-primary/20 text-brand-primary text-xs font-semibold rounded-full mb-6">
                <svg class="w-4 h-4 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <span>Pembukuan Digital untuk UMKM Provinsi Kalimantan Selatan</span>
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 max-w-4xl leading-tight">
                Sistem Pembukuan &amp; Keuangan Digital
                untuk <span class="text-brand-primary">UMKM</span>
            </h1>

            <p class="mt-6 text-lg text-slate-600 max-w-2xl leading-relaxed">
                Kelola transaksi, kas, stok produk, dan laporan keuangan usaha Anda dengan mudah dalam satu aplikasi.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-8 py-4 bg-brand-primary hover:bg-brand-primary-hover text-white text-base font-semibold rounded-xl shadow-lg shadow-brand-primary/20 transition duration-200">
                        {{ __('Buka Dashboard') }}
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-brand-primary hover:bg-brand-primary-hover text-white text-base font-semibold rounded-xl shadow-lg shadow-brand-primary/20 transition duration-200">
                        {{ __('Mulai Pembukuan Gratis') }}
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white border border-slate-200 text-slate-700 hover:text-brand-primary text-base font-semibold rounded-xl shadow-sm transition duration-200">
                        {{ __('Masuk') }}
                    </a>
                @endauth
            </div>

            <!-- Feature Highlights -->
            <div class="mt-16 grid grid-cols-1 sm:grid-cols-3 gap-6 w-full max-w-4xl">
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 text-left">
                    <div class="inline-flex items-center justify-center h-12 w-12 rounded-2xl bg-brand-light text-brand-primary">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>
                    </div>
                    <h3 class="mt-3 font-semibold text-slate-800">Kelola Stok Produk</h3>
                    <p class="mt-1 text-sm text-slate-500">Catat dan pantau ketersediaan produk usaha Anda.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 text-left">
                    <div class="inline-flex items-center justify-center h-12 w-12 rounded-2xl bg-brand-secondary/15 text-brand-secondary">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                        </svg>
                    </div>
                    <h3 class="mt-3 font-semibold text-slate-800">Catat Pemasukan &amp; Pengeluaran</h3>
                    <p class="mt-1 text-sm text-slate-500">Rekam arus kas masuk dan keluar setiap transaksi.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 text-left">
                    <div class="inline-flex items-center justify-center h-12 w-12 rounded-2xl bg-brand-light text-brand-primary">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                        </svg>
                    </div>
                    <h3 class="mt-3 font-semibold text-slate-800">Laporan Keuangan</h3>
                    <p class="mt-1 text-sm text-slate-500">Pantau performa usaha lewat laporan yang rapi.</p>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="border-t border-slate-200 bg-white/60">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-2 text-sm text-slate-500">
                <p>&copy; 2026 Pusat Layanan Kemasan Provinsi Kalimantan Selatan. Hak cipta dilindungi.</p>
                <p>Pembukuan Digital untuk UMKM Provinsi Kalimantan Selatan.</p>
            </div>
        </footer>
    </body>
</html>
