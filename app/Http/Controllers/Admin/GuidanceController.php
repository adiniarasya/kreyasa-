<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuidanceController extends Controller
{
    public function index()
    {
        $orders = Order::whereIn('status', ['Lunas & Selesai', 'Masa Bimbingan', 'Bimbingan Selesai'])
                    ->latest()
                    ->get();

        return view('admin.guidance', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order->status = $request->status;
        $order->save();

        return back()->with('success', "Status bimbingan {$order->order_code} diperbarui menjadi \"{$order->status}\"");
    }
}