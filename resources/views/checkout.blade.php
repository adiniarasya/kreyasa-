@extends('layouts.app')

@section('title', 'Checkout - KREYASA')

@section('content')
  <div class="max-w-3xl mx-auto px-6 pt-32 pb-20 min-h-screen">

    <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-8">Checkout</h1>

    <div
      class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 shadow-sm mb-6">
      <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Ringkasan Pesanan</h3>
      <div class="space-y-3 text-sm">
        @foreach($cart as $item)
          <div class="flex justify-between items-center text-slate-600 dark:text-slate-400">
            <span>{{ $item['name'] }} <span class="text-slate-400 ml-1">x{{ $item['qty'] }}</span></span>
            <span class="font-medium text-slate-900 dark:text-white">Rp
              {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</span>
          </div>
        @endforeach
      </div>
      <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-between items-center">
        <span class="font-bold text-slate-900 dark:text-white">Total</span>
        <span class="font-bold text-lg text-indigo-600 dark:text-indigo-400">Rp
          {{ number_format($total, 0, ',', '.') }}</span>
      </div>
    </div>

    <form method="POST" action="{{ route('checkout.store') }}"
      class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 shadow-sm">
      @csrf

      <div class="space-y-5 mb-8">
        <div>
          <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama Lengkap</label>
          <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
          @error('customer_name')
          <div class="text-red-500 text-xs mt-2">{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nomor WhatsApp</label>
          <input type="tel" name="customer_wa" value="{{ old('customer_wa') }}" placeholder="08xxxxxxxxxx" required
            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
          @error('customer_wa')
          <div class="text-red-500 text-xs mt-2">{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Catatan (opsional)</label>
          <textarea name="note" rows="3"
            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">{{ old('note') }}</textarea>
        </div>
      </div>

      <div class="mb-8">
        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">Metode Pembayaran</label>

        <div class="space-y-3">
          <label
            class="flex items-center gap-4 p-4 rounded-xl border-2 border-indigo-600 bg-indigo-50/50 dark:bg-indigo-950/20 cursor-pointer transition-all">
            <input type="radio" name="payment_type" value="dp" checked
              class="w-5 h-5 text-indigo-600 focus:ring-indigo-500">
            <div class="flex-1">
              <div class="font-bold text-slate-900 dark:text-white text-sm">Bayar DP Dulu</div>
              <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">Bayar sebagian sekarang, sisanya setelah produk
                selesai.</div>
            </div>
            <div class="font-bold text-indigo-600 dark:text-indigo-400">Rp {{ number_format($dpAmount, 0, ',', '.') }}
            </div>
          </label>

          <label
            class="flex items-center gap-4 p-4 rounded-xl border border-slate-200 dark:border-slate-700 hover:border-indigo-300 dark:hover:border-indigo-700 cursor-pointer transition-all">
            <input type="radio" name="payment_type" value="lunas" class="w-5 h-5 text-indigo-600 focus:ring-indigo-500">
            <div class="flex-1">
              <div class="font-bold text-slate-900 dark:text-white text-sm">Bayar Lunas</div>
              <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">Bayar penuh di awal, proses langsung dimulai.
              </div>
            </div>
            <div class="font-bold text-slate-900 dark:text-white">Rp {{ number_format($total, 0, ',', '.') }}</div>
          </label>
        </div>
      </div>

      <button type="submit"
        class="w-full py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold transition-colors shadow-lg shadow-indigo-500/30">
        Buat Pesanan
      </button>
    </form>
  </div>
@endsection