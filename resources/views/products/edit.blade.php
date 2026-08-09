<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6">
                <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if ($product->foto_produk)
                        <div class="mb-4">
                            <img src="{{ asset('storage/'.$product->foto_produk) }}" alt="{{ $product->nama_produk }}" class="h-32 w-32 rounded-xl object-cover border border-slate-200">
                        </div>
                    @endif

                    <div>
                        <x-input-label for="foto_produk" :value="__('Foto Produk')" />
                        <input id="foto_produk" type="file" name="foto_produk" class="mt-1 block w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-brand-light file:text-brand-primary hover:file:bg-brand-primary/10" accept="image/*">
                        <x-input-error :messages="$errors->get('foto_produk')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="nama_produk" :value="__('Nama Produk')" />
                        <x-text-input id="nama_produk" class="block mt-1 w-full" type="text" name="nama_produk" :value="old('nama_produk', $product->nama_produk)" required autofocus />
                        <x-input-error :messages="$errors->get('nama_produk')" class="mt-2" />
                    </div>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="nama_brand" :value="__('Nama Brand')" />
                            <x-text-input id="nama_brand" class="block mt-1 w-full" type="text" name="nama_brand" :value="old('nama_brand', $product->nama_brand)" />
                            <x-input-error :messages="$errors->get('nama_brand')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="kategori_produk" :value="__('Kategori Produk')" />
                            <select name="kategori_produk" id="kategori_produk" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-brand-primary focus:ring-brand-primary">
                                <option value="" disabled {{ old('kategori_produk', $product->kategori_produk ?? '') == '' ? 'selected' : '' }}>-- Pilih Kategori --</option>
                                <option value="Makanan" {{ old('kategori_produk', $product->kategori_produk ?? '') == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="Minuman" {{ old('kategori_produk', $product->kategori_produk ?? '') == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                                <option value="Kerajinan" {{ old('kategori_produk', $product->kategori_produk ?? '') == 'Kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                                <option value="Fashion" {{ old('kategori_produk', $product->kategori_produk ?? '') == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                                <option value="Kosmetik" {{ old('kategori_produk', $product->kategori_produk ?? '') == 'Kosmetik' ? 'selected' : '' }}>Kosmetik</option>
                                <option value="Oleh-oleh" {{ old('kategori_produk', $product->kategori_produk ?? '') == 'Oleh-oleh' ? 'selected' : '' }}>Oleh-oleh</option>
                                <option value="Pertanian" {{ old('kategori_produk', $product->kategori_produk ?? '') == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                                <option value="Perikanan" {{ old('kategori_produk', $product->kategori_produk ?? '') == 'Perikanan' ? 'selected' : '' }}>Perikanan</option>
                            </select>
                            <x-input-error :messages="$errors->get('kategori_produk')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                        <textarea id="deskripsi" name="deskripsi" rows="3" class="block mt-1 w-full border-gray-300 focus:border-brand-primary focus:ring-2 focus:ring-brand-primary rounded-xl py-2.5 px-3.5 shadow-sm">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                    </div>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="harga" :value="__('Harga (Rp)')" />
                            <x-text-input id="harga" class="block mt-1 w-full" type="number" name="harga" :value="old('harga', $product->harga)" min="0" required />
                            <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="stok" :value="__('Stok')" />
                            <x-text-input id="stok" class="block mt-1 w-full" type="number" name="stok" :value="old('stok', $product->stok)" min="0" required />
                            <x-input-error :messages="$errors->get('stok')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6 gap-4">
                        <a href="{{ route('products.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">Batal</a>
                        <x-primary-button>{{ __('Perbarui Produk') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
