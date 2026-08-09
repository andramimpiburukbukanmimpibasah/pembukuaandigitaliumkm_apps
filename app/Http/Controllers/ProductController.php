<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $products = Product::when($request->search, function ($query, $search) {
            return $query->where('nama_produk', 'like', '%'.$search.'%')
                ->orWhere('nama_brand', 'like', '%'.$search.'%')
                ->orWhere('kategori_produk', 'like', '%'.$search.'%')
                ->orWhere('deskripsi', 'like', '%'.$search.'%');
        })->latest()->paginate(12)->withQueryString();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'foto_produk' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'nama_produk' => ['required', 'string', 'max:255'],
            'nama_brand' => ['nullable', 'string', 'max:255'],
            'kategori_produk' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'harga' => ['required', 'integer', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('foto_produk')) {
            $file = $request->file('foto_produk');
            $filename = 'produk/'.Str::uuid().'.'.$file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('produk', $file, basename($filename));
            $validated['foto_produk'] = $filename;
        }

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'foto_produk' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'nama_produk' => ['required', 'string', 'max:255'],
            'nama_brand' => ['nullable', 'string', 'max:255'],
            'kategori_produk' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'harga' => ['required', 'integer', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('foto_produk')) {
            if ($product->foto_produk) {
                Storage::disk('public')->delete($product->foto_produk);
            }

            $file = $request->file('foto_produk');
            $filename = 'produk/'.Str::uuid().'.'.$file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('produk', $file, basename($filename));
            $validated['foto_produk'] = $filename;
        }

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        if ($product->foto_produk) {
            Storage::disk('public')->delete($product->foto_produk);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
