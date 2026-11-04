<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $total    = 0;
        $dpAmount = 0;

        foreach ($cart as $item) {
            $total    += $item['price'] * $item['qty'];
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

        $total    = 0;
        $dpAmount = 0;

        foreach ($cart as $item) {
            $total    += $item['price'] * $item['qty'];
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
        $order  = Order::with('items')->where('order_code', $code)->firstOrFail();
        $qrData = 'KREYASA-' . $order->order_code . '-Rp' . number_format($order->amount_paid, 0, '', '');
        return view('order-success', compact('order', 'qrData'));
    }

    public function uploadProof(Request $request, $code)
    {
        $request->validate([
            'payment_method' => 'required|in:qris,dana,gopay,ovo,bca,bri,bni,mandiri',
            'payment_proof'  => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $order = Order::where('order_code', $code)->firstOrFail();

        if ($request->hasFile('payment_proof')) {
            if ($order->payment_proof) {
                Storage::disk('public')->delete($order->payment_proof);
            }
            $path                 = $request->file('payment_proof')->store('payment_proofs', 'public');
            $order->payment_proof = $path;
        }

        $order->payment_method      = $request->payment_method;
        $order->payment_uploaded_at = now();
        $order->status              = 'Menunggu Verifikasi Pembayaran';
        $order->save();

        return redirect()->route('order.success', $code)
            ->with('success', 'Bukti pembayaran berhasil diunggah! Admin akan segera memverifikasi.');
    }

    public function download($order_code)
    {
        $order = Order::with('items.product')->where('order_code', $order_code)->firstOrFail();

        if (auth()->check() && auth()->id() !== $order->user_id) {
            abort(403, 'Akses ditolak.');
        }

        if (! in_array($order->status, ['Lunas', 'Lunas & Selesai', 'completed'])) {
            return back()->with('error', 'Pesanan belum lunas. Silakan selesaikan pembayaran Anda.');
        }

        $item    = $order->items->first();
        $product = $item->product;

        if (! $product || ! $product->file_path) {
            return back()->with('error', 'File produk belum tersedia atau sudah dihapus admin.');
        }

        $filePath = storage_path('app/public/' . $product->file_path);

        if (! file_exists($filePath)) {
            return back()->with('error', 'File tidak ditemukan di server.');
        }

        return response()->download($filePath);
    }
}
