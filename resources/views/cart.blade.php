@extends('layouts.app')

@section('title', 'Keranjang - KREYASA')

@section('content')
    <div class="max-w-6xl mx-auto px-6 pt-32 pb-20 min-h-screen">

        <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-8">Keranjang Saya</h1>

        @if (empty($cart))
            <div
                class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-16 text-center shadow-sm">
                <div
                    class="w-20 h-20 mx-auto rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-5">
                    <i class="fa-solid fa-cart-shopping text-3xl text-slate-400"></i>
                </div>
                <p class="text-slate-500 dark:text-slate-400 font-medium mb-6">Keranjang Anda masih kosong.</p>
                <a href="{{ route('home') }}#produk"
                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition-colors shadow-lg shadow-indigo-500/30">
                    Belanja Sekarang
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                <div
                    class="lg:col-span-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-6 md:p-8 space-y-6">
                        @foreach ($cart as $item)
                            <div
                                class="flex flex-col sm:flex-row gap-5 pb-6 border-b border-slate-100 dark:border-slate-800 last:border-0 last:pb-0">

                                <div
                                    class="w-24 h-24 shrink-0 rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700">
                                    @if (str_starts_with($item['image'], 'http'))
                                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                            class="w-full h-full object-cover">
                                    @endif
                                </div>

                                <div class="flex-1 flex flex-col">
                                    <div class="font-bold text-lg text-slate-900 dark:text-white">{{ $item['name'] }}</div>
                                    <div class="text-sm text-slate-500 dark:text-slate-400 mt-1">Rp
                                        {{ number_format($item['price'], 0, ',', '.') }}
                                    </div>

                                    <div class="mt-4 flex items-center gap-3">
                                        <form method="POST" action="{{ route('cart.update', $item['id']) }}"
                                            class="flex items-center gap-2">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="qty" value="{{ $item['qty'] }}" min="1"
                                                class="w-16 px-2 py-1.5 rounded-lg bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-sm text-center text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                                            <button type="submit"
                                                class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-xs font-semibold text-slate-700 dark:text-slate-300 transition-colors">Update</button>
                                        </form>

                                        <form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-1.5 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition-colors text-sm font-medium flex items-center gap-1.5">
                                                <i class="fa-solid fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="text-right sm:text-left self-start sm:self-center">
                                    <div class="text-xs text-slate-400 mb-1">Subtotal</div>
                                    <div class="font-bold text-lg text-slate-900 dark:text-white">Rp
                                        {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 shadow-sm lg:sticky lg:top-24">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6">Ringkasan Belanja</h3>

                    <div class="space-y-4 text-sm mb-6">
                        <div class="flex justify-between items-center text-slate-600 dark:text-slate-400">
                            <span>Total Harga</span>
                            <span class="font-semibold text-slate-900 dark:text-white">Rp
                                {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div
                            class="flex justify-between items-center text-slate-600 dark:text-slate-400 pt-4 border-t border-slate-100 dark:border-slate-800">
                            <span>DP Minimal</span>
                            <span class="font-bold text-indigo-600 dark:text-indigo-400">Rp
                                {{ number_format($dpAmount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <a href="{{ route('checkout') }}"
                        class="w-full flex items-center justify-center px-6 py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold transition-colors shadow-lg shadow-indigo-500/30">
                        Lanjut ke Checkout
                    </a>
                </div>

            </div>
        @endif
    </div>
@endsection
