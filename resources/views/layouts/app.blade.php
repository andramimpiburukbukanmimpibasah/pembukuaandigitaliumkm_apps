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
        <div x-data="{ sidebarOpen: false }" class="min-h-screen bg-[#F8FAFC]">

            <!-- Mobile overlay -->
            <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false" class="fixed inset-0 z-30 bg-slate-900/50 lg:hidden"></div>

            <!-- Sidebar -->
            <aside :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }" class="fixed inset-y-0 left-0 z-40 w-72 bg-gradient-to-b from-[#115468] via-[#0c6649] to-[#0c6649] text-white border-r border-[#0d4252] flex flex-col transition-transform duration-200 ease-in-out lg:translate-x-0 print:hidden">

                <!-- Sidebar Header / Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-6 h-20 border-b border-[#0d4252]">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Pusat Layanan Kemasan" class="w-10 h-10 object-contain bg-white rounded-2xl p-1 shadow-sm">
                        <div>
                            <h1 class="font-bold text-lg text-white leading-tight">Laporan <span class="text-white">Keuangan</span></h1>
                            <p class="text-[10px] text-teal-100/70 leading-tight">Pusat Layanan Kemasan Kalimantan Selatan</p>
                        </div>
                    </div>
                </a>

                <!-- Sidebar Menu -->
                <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                    <a href="{{ route('dashboard') }}" class="group flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition duration-150 {{ request()->routeIs('dashboard') ? 'bg-white text-[#115468] font-bold shadow-md' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('dashboard') ? 'text-[#115468]' : 'text-white/60 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('products.index') }}" class="group flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition duration-150 {{ request()->routeIs('products.*') ? 'bg-white text-[#115468] font-bold shadow-md' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('products.*') ? 'text-[#115468]' : 'text-white/60 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                        </svg>
                        Produk (Katalog)
                    </a>

                    <a href="{{ route('transactions.index') }}" class="group flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition duration-150 {{ request()->routeIs('transactions.*') ? 'bg-white text-[#115468] font-bold shadow-md' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('transactions.*') ? 'text-[#115468]' : 'text-white/60 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                        </svg>
                        Transaksi
                    </a>

                    <a href="{{ route('cashes.index') }}" class="group flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition duration-150 {{ request()->routeIs('cashes.*') ? 'bg-white text-[#115468] font-bold shadow-md' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('cashes.*') ? 'text-[#115468]' : 'text-white/60 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                        </svg>
                        Kas
                    </a>

                    <a href="{{ route('reports.index') }}" class="group flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition duration-150 {{ request()->routeIs('reports.*') ? 'bg-white text-[#115468] font-bold shadow-md' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('reports.*') ? 'text-[#115468]' : 'text-white/60 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                        </svg>
                        Laporan
                    </a>

                    <a href="{{ route('umkm-profile.index') }}" class="group flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition duration-150 {{ request()->routeIs('umkm-profile.*') ? 'bg-white text-[#115468] font-bold shadow-md' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('umkm-profile.*') ? 'text-[#115468]' : 'text-white/60 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                        </svg>
                        Profil Usaha
                    </a>

                    <a href="{{ route('settings.index') }}" class="group flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition duration-150 {{ request()->routeIs('settings.*') ? 'bg-white text-[#115468] font-bold shadow-md' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('settings.*') ? 'text-[#115468]' : 'text-white/60 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.24-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.992a7.723 7.723 0 0 1 0-.255c.007-.378-.138-.75-.43-.991l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        Pengaturan
                    </a>
                </nav>

                <!-- Sidebar Footer / Logout -->
                <div class="px-4 pt-4 pb-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 px-4 py-3 text-white hover:bg-[#0d4252] rounded-xl w-full transition-colors">
                            <svg class="w-5 h-5 text-white shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>
                            <span class="font-medium text-white">Keluar</span>
                        </button>
                    </form>
                </div>

                <!-- Sidebar Branding -->
                <div class="px-4 py-3 text-xs text-white/70 mt-auto">
                    <p class="font-medium text-white/60">Didukung Oleh:</p>
                    <p class="font-semibold text-white">Pusat Layanan Kemasan</p>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="lg:pl-72 flex flex-col min-h-screen print:pl-0">
                <!-- Top Navbar -->
                <header class="sticky top-0 z-20 bg-gradient-to-r from-[#115468] via-[#0c6649] to-[#148d3a] shadow-sm print:hidden">
                    <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center gap-4">
                            <!-- Mobile hamburger -->
                            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden inline-flex items-center justify-center p-2 rounded-md text-white/90 hover:text-white hover:bg-white/10 focus:outline-none">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>

                            <div class="hidden sm:block text-sm text-white/90 font-medium">
                                {{ __('Pembukuan Digital UMKM') }}
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="text-right">
                                <p class="text-sm font-semibold text-white leading-tight">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-white/80 leading-tight">{{ auth()->user()->umkm?->nama_usaha }}</p>
                            </div>
                            <div class="h-10 w-10 rounded-full bg-white/20 text-white border border-white/30 backdrop-blur-sm flex items-center justify-center font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white border-b border-slate-200 print:hidden">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="flex-1">
                    {{ $slot }}
                </main>

                <!-- Copyright Footer -->
                <footer class="px-4 sm:px-6 lg:px-8 py-4 text-center text-xs text-slate-400 print:hidden">
                    <p>&copy; 2026 Pusat Layanan Kemasan Provinsi Kalimantan Selatan. Hak cipta dilindungi.</p>
                </footer>
            </div>
        </div>
    </body>
</html>
