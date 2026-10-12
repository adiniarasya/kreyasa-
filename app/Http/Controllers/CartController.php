<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        $dpAmount = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
            $dpAmount += ($item['price'] * $item['dp_percent'] / 100) * $item['qty'];
        }

        return view('cart', compact('cart', 'total', 'dpAmount'));
    }

    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty']++;
        } else {
            $cart[$product->id] = [
                'id'         => $product->id,
                'name'       => $product->name,
                'price'      => $product->price,
                'image'      => $product->image,
                'dp_percent' => $product->dp_percent,
                'qty'        => 1,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', "\"{$product->name}\" ditambahkan ke keranjang");
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = (int) $request->qty;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Jumlah produk diperbarui');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return back()->with('success', 'Produk dihapus dari keranjang');
    }
}