<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->nama_produk }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6">
                <div class="flex flex-col sm:flex-row gap-6">
                    <div class="shrink-0">
                        <div class="h-48 w-48 rounded-2xl bg-slate-100 flex items-center justify-center overflow-hidden">
                            @if ($product->foto_produk)
                                <img src="{{ asset('storage/'.$product->foto_produk) }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-6xl">📦</span>
                            @endif
                        </div>
                    </div>

                    <dl class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Nama Produk</dt>
                            <dd class="mt-1 text-sm text-slate-900 font-semibold">{{ $product->nama_produk }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Nama Brand</dt>
                            <dd class="mt-1 text-sm text-slate-900">{{ $product->nama_brand ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Kategori</dt>
                            <dd class="mt-1 text-sm text-slate-900">{{ $product->kategori_produk ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Harga</dt>
                            <dd class="mt-1 text-sm text-brand-primary font-bold">Rp {{ number_format($product->harga, 0, ',', '.') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Stok</dt>
                            <dd class="mt-1 text-sm text-slate-900 font-semibold">{{ $product->stok }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Deskripsi</dt>
                            <dd class="mt-1 text-sm text-slate-900">{{ $product->deskripsi ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="mt-6 flex items-center gap-4">
                    @if (auth()->user()->isAdmin())
                    <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center px-5 py-2.5 bg-yellow-500 hover:bg-yellow-400 text-white text-sm font-semibold rounded-xl shadow-md transition duration-200">
                        Edit
                    </a>
                    @endif
                    <a href="{{ route('products.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
