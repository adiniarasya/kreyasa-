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
            'file_path'   => 'required|file|mimes:pdf,zip,rar|max:20480', // Max 20MB
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        } else {
            $validated['image'] = 'https://via.placeholder.com/400x300/0F0F2D/8B5CF6?text=' . urlencode($validated['name']);
        }

        // Upload File Produk Digital
        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('product_files', 'public');
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
            'file_path'   => 'nullable|file|mimes:pdf,zip,rar|max:20480',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && !str_starts_with($product->image, 'http')) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Upload File Produk Baru kalau ada
        if ($request->hasFile('file_path')) {
            if ($product->file_path) {
                Storage::disk('public')->delete($product->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('product_files', 'public');
        }

        $product->update($validated);

        return back()->with('success', "Produk \"{$product->name}\" berhasil diperbarui");
    }

    public function destroy(Product $product)
    {
        if ($product->image && !str_starts_with($product->image, 'http')) {
            Storage::disk('public')->delete($product->image);
        }
        
        if ($product->file_path) {
            Storage::disk('public')->delete($product->file_path);
        }

        $name = $product->name;
        $product->delete();

        return back()->with('success', "Produk \"{$name}\" berhasil dihapus");
    }
}