<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order->status = $request->status;

        if ($request->status === 'Lunas & Selesai' && $order->remaining > 0) {
            $order->amount_paid = $order->total;
            $order->remaining = 0;
        }

        if ($request->status === 'Dibatalkan') {
            $order->amount_paid = 0;
            $order->remaining = 0;
        }

        $order->save();

        return back()->with('success', "Status pesanan {$order->order_code} diperbarui menjadi \"{$order->status}\"");
    }

    public function destroy(Order $order)
    {
        $code = $order->order_code;
        $order->delete();

        return back()->with('success', "Pesanan {$code} berhasil dihapus");
    }
}