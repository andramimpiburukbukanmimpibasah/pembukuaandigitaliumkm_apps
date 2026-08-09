<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laporan Keuangan') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-[#115468]/5 via-white to-[#148d3a]/10">
            <div class="flex flex-col items-center justify-center mb-4">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Pusat Layanan Kemasan" class="w-16 h-16 object-contain mb-2">
                </a>
                <h2 class="text-xl font-bold text-[#115468]">Laporan Keuangan</h2>
                <p class="text-xs text-gray-500">Pusat Layanan Kemasan Provinsi Kalimantan Selatan</p>
            </div>

            <div class="w-full sm:max-w-md px-8 py-8 bg-white shadow-xl shadow-slate-200/50 border border-slate-100 rounded-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>