<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $total = 0;
        $dpAmount = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
            $dpAmount += ($item['price'] * $item['dp_percent'] / 100) * $item['qty'];
        }

        return view('checkout', compact('cart', 'total', 'dpAmount'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_wa'   => 'required|string|max:20',
            'note'          => 'nullable|string',
            'payment_type'  => 'required|in:dp,lunas',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $total = 0;
        $dpAmount = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
            $dpAmount += ($item['price'] * $item['dp_percent'] / 100) * $item['qty'];
        }

        $amountPaid = $validated['payment_type'] === 'dp' ? $dpAmount : $total;
        $remaining  = $total - $amountPaid;

        DB::transaction(function () use ($validated, $cart, $total, $amountPaid, $remaining, &$order) {
            $order = Order::create([
                'order_code'    => Order::generateCode(),
                'customer_name' => $validated['customer_name'],
                'customer_wa'   => $validated['customer_wa'],
                'note'          => $validated['note'] ?? null,
                'total'         => $total,
                'payment_type'  => $validated['payment_type'],
                'amount_paid'   => $amountPaid,
                'remaining'     => $remaining,
                'status'        => 'Menunggu Verifikasi Pembayaran',
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item['id'],
                    'product_name' => $item['name'],
                    'price'        => $item['price'],
                    'qty'          => $item['qty'],
                    'subtotal'     => $item['price'] * $item['qty'],
                ]);
            }
        });

        session()->forget('cart');

        return redirect()->route('order.success', $order->order_code);
    }

public function success($code)
{
    $order = Order::with('items')->where('order_code', $code)->firstOrFail();
    $qrData = 'KREYASA-' . $order->order_code . '-Rp' . number_format($order->amount_paid, 0, '', '');
    return view('order-success', compact('order', 'qrData'));
}
    public function uploadProof(Request $request, $code)
{
    $request->validate([
        'payment_method' => 'required|in:qris,dana,gopay,ovo,bca,bri,bni,mandiri',
        'payment_proof'  => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // max 5MB
    ]);

    $order = Order::where('order_code', $code)->firstOrFail();

    // Simpan file
    $path = $request->file('payment_proof')->store('payment_proofs', 'public');

    // Update order
    $order->update([
        'payment_method'      => $request->payment_method,
        'payment_proof'       => $path,
        'payment_uploaded_at' => now(),
        'status'              => 'Menunggu Verifikasi Pembayaran',
    ]);

    return redirect()->route('order.success', $code)
        ->with('success', 'Bukti pembayaran berhasil diunggah! Admin akan segera memverifikasi.');
}
}