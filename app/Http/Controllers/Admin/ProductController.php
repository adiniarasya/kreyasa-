<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:150',
            'category'    => 'required|string|max:100',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'dp_percent'  => 'required|integer|min:10|max:100',
            'badge'       => 'nullable|string|max:50',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        // Upload gambar kalau ada
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        } else {
            // Placeholder default
            $validated['image'] = 'https://via.placeholder.com/400x300/0F0F2D/8B5CF6?text=' . urlencode($validated['name']);
        }

        $validated['is_active'] = true;

        Product::create($validated);

        return back()->with('success', "Produk \"{$validated['name']}\" berhasil ditambahkan");
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:150',
            'category'    => 'required|string|max:100',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'dp_percent'  => 'required|integer|min:10|max:100',
            'badge'       => 'nullable|string|max:50',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        // Upload gambar baru kalau ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama (kalau file lokal, bukan URL)
            if ($product->image && !str_starts_with($product->image, 'http')) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }
        // Kalau tidak upload baru, image tetap seperti sebelumnya

        $product->update($validated);

        return back()->with('success', "Produk \"{$product->name}\" berhasil diperbarui");
    }

    public function destroy(Product $product)
    {
        // Hapus gambar lokal
        if ($product->image && !str_starts_with($product->image, 'http')) {
            Storage::disk('public')->delete($product->image);
        }

        $name = $product->name;
        $product->delete();

        return back()->with('success', "Produk \"{$name}\" berhasil dihapus");
    }
}