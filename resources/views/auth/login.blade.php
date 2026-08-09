<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Masuk ke Akun</h1>
        <p class="mt-1 text-sm text-slate-500">Kelola pembukuan UMKM Anda dengan mudah.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email / No. WhatsApp -->
        <div>
            <x-input-label for="email" :value="__('Email atau No. WhatsApp')" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" placeholder="Contoh: 08123456789 atau user@gmail.com" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative mt-1" x-data="{ show: false }">
                <input
                    id="password"
                    name="password"
                    x-bind:type="show ? 'text' : 'password'"
                    required
                    autocomplete="current-password"
                    placeholder="Masukkan kata sandi"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 pr-10"
                />

                <button type="button"
                        @click="show = !show"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-[#115468] focus:outline-none"
                        :aria-label="show ? 'Sembunyikan password' : 'Tampilkan password'">
                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.025 10.025 0 0110.123 2.937m-2.152 2.152a10.05 10.05 0 011.545 3.848C19.732 16.057 15.942 19 11.5 19c-1.12 0-2.2-.185-3.218-.525" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#115468] shadow-sm focus:ring-[#115468] focus:border-[#115468]" name="remember">
                <span class="ms-2 text-sm text-slate-600">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-[#115468] hover:text-[#0d4252] font-semibold" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>

        <div class="mt-6 text-center text-sm text-slate-600">
            {{ __('Belum punya akun?') }}
            <a class="font-semibold text-[#115468] hover:text-[#0d4252]" href="{{ route('register') }}">
                {{ __('Daftar Sekarang') }}
            </a>
        </div>
    </form>
</x-guest-layout>
