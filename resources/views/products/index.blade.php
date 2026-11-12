<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Katalog Produk') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <form method="GET" action="{{ route('products.index') }}" class="w-full sm:w-auto">
                    <div class="flex gap-2">
                        <x-text-input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="w-full sm:w-64" />
                        <button type="submit" class="inline-flex items-center px-4 py-2.5 bg-slate-800 text-white text-sm font-medium rounded-xl hover:bg-slate-700 transition duration-150">
                            Cari
                        </button>
                    </div>
                </form>

                @if (auth()->user()->isAdmin())
                <a href="{{ route('products.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-brand-primary text-white text-sm font-semibold rounded-xl shadow-md hover:bg-brand-primary-hover transition duration-200">
                    + Tambah Produk
                </a>
                @endif
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 overflow-hidden flex flex-col">
                        <div class="aspect-square bg-slate-100 flex items-center justify-center overflow-hidden">
                            @if ($product->foto_produk)
                                <img src="{{ asset('storage/'.$product->foto_produk) }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-5xl">📦</span>
                            @endif
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <p class="text-xs font-semibold text-brand-primary uppercase tracking-wide">{{ $product->kategori_produk ?? 'Umum' }}</p>
                            <h3 class="mt-1 font-semibold text-slate-800">{{ $product->nama_produk }}</h3>
                            <p class="text-sm text-slate-500">{{ $product->nama_brand ?? '' }}</p>
                            <div class="mt-3 flex items-center justify-between">
                                <p class="font-bold text-brand-primary">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                                <p class="text-sm text-slate-500">Stok: <span class="font-semibold {{ $product->stok > 0 ? 'text-emerald-600' : 'text-red-600' }}">{{ $product->stok }}</span></p>
                            </div>
                            <div class="mt-4 flex items-center gap-3 pt-4 border-t border-slate-100">
                                <a href="{{ route('products.show', $product) }}" class="text-sm font-medium text-brand-primary hover:text-brand-primary">Lihat</a>
                                @if (auth()->user()->isAdmin())
                                <a href="{{ route('products.edit', $product) }}" class="text-sm font-medium text-yellow-600 hover:text-yellow-900">Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="ml-auto" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-12 text-center">
                        <p class="text-4xl mb-3">📦</p>
                        <p class="text-slate-500">Belum ada produk. Klik <a href="{{ route('products.create') }}" class="text-brand-primary font-semibold">Tambah Produk</a> untuk memulai.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
