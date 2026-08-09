<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Informasi Profil -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6">
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Keamanan / Ubah Password -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Hapus Akun -->
            <div class="bg-white rounded-2xl border border-red-100 shadow-lg shadow-slate-200/50 p-6">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
