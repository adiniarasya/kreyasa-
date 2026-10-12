<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::active()->get();
        return view('home', compact('products'));
    }
    public function scopeActive($query)
{
    return $query->where('is_active', true);
}
    public function detail(Product $product)
    {
        return view('product-detail', compact('product'));
    }
}