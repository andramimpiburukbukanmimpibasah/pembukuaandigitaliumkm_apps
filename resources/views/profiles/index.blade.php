<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil Usaha') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Ringkasan Card -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6 lg:col-span-1">
                    <div class="flex items-center gap-4">
                        @if ($umkm && $umkm->logo)
                            <img src="{{ asset('storage/'.$umkm->logo) }}" alt="Logo Usaha" class="h-16 w-16 rounded-xl object-cover border border-slate-200">
                        @else
                            <div class="h-16 w-16 rounded-xl bg-brand-light flex items-center justify-center text-2xl">
                                🏢
                            </div>
                        @endif
                        <div>
                            <h3 class="font-bold text-lg text-slate-800">{{ $umkm->nama_usaha }}</h3>
                            <p class="text-sm text-slate-500">{{ $umkm->nama_brand ?? $umkm->pemilik ?? '-' }}</p>
                        </div>
                    </div>

                    <dl class="mt-6 space-y-4 text-sm">
                        <div class="flex items-center justify-between">
                            <dt class="text-slate-500">Bergabung sejak</dt>
                            <dd class="font-semibold text-slate-800">{{ $stats['bergabung']?->translatedFormat('d F Y') ?? '-' }}</dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt class="text-slate-500">Total Transaksi</dt>
                            <dd class="font-semibold text-slate-800">{{ number_format($stats['total_transaksi'], 0, ',', '.') }}</dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt class="text-slate-500">Total Produk</dt>
                            <dd class="font-semibold text-slate-800">{{ number_format($stats['total_produk'], 0, ',', '.') }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Form Edit Profil -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6 lg:col-span-2">
                    <h3 class="font-semibold text-lg text-slate-800 mb-4">Edit Profil Usaha</h3>

                    <form method="POST" action="{{ route('umkm-profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <x-input-label for="logo" :value="__('Logo Usaha')" />
                                <input id="logo" type="file" name="logo" class="mt-1 block w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-brand-light file:text-brand-primary hover:file:bg-brand-primary/10" accept="image/*">
                                <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="nama_usaha" :value="__('Nama Usaha')" />
                                <x-text-input id="nama_usaha" class="block mt-1 w-full" type="text" name="nama_usaha" :value="old('nama_usaha', $umkm->nama_usaha)" required />
                                <x-input-error :messages="$errors->get('nama_usaha')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="nama_brand" :value="__('Nama Brand')" />
                                <x-text-input id="nama_brand" class="block mt-1 w-full" type="text" name="nama_brand" :value="old('nama_brand', $umkm->nama_brand)" />
                                <x-input-error :messages="$errors->get('nama_brand')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="pemilik" :value="__('Nama Pemilik')" />
                                <x-text-input id="pemilik" class="block mt-1 w-full" type="text" name="pemilik" :value="old('pemilik', $umkm->pemilik)" />
                                <x-input-error :messages="$errors->get('pemilik')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="no_hp" :value="__('Kontak (No WhatsApp)')" />
                                <x-text-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp" :value="old('no_hp', $umkm->no_hp)" required />
                                <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="jenis_usaha" :value="__('Jenis Usaha')" />
                                <x-text-input id="jenis_usaha" class="block mt-1 w-full" type="text" name="jenis_usaha" :value="old('jenis_usaha', $umkm->jenis_usaha)" placeholder="Contoh: Kuliner, Fashion, Jasa, dll." />
                                <x-input-error :messages="$errors->get('jenis_usaha')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="alamat" :value="__('Alamat')" />
                                <textarea id="alamat" name="alamat" rows="2" class="block mt-1 w-full border-gray-300 focus:border-brand-primary focus:ring-2 focus:ring-brand-primary rounded-xl py-2.5 px-3.5 shadow-sm">{{ old('alamat', $umkm->alamat) }}</textarea>
                                <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="deskripsi_usaha" :value="__('Deskripsi Usaha')" />
                                <textarea id="deskripsi_usaha" name="deskripsi_usaha" rows="3" class="block mt-1 w-full border-gray-300 focus:border-brand-primary focus:ring-2 focus:ring-brand-primary rounded-xl py-2.5 px-3.5 shadow-sm">{{ old('deskripsi_usaha', $umkm->deskripsi_usaha) }}</textarea>
                                <x-input-error :messages="$errors->get('deskripsi_usaha')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-6">
                            <x-primary-button class="w-full md:w-auto">
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
