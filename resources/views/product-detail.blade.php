@extends('layouts.app')

@section('title', $product->name . ' - KREYASA')

@section('content')
    <div class="max-w-6xl mx-auto px-6 pt-32 pb-20 min-h-screen">

        <a href="{{ route('home') }}#produk"
            class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-400 mb-8 transition-colors">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Produk
        </a>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 lg:gap-16 items-start">

            <div
                class="rounded-3xl overflow-hidden bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-800 shadow-sm aspect-square md:aspect-auto md:h-[500px]">
                @if (str_starts_with($product->image, 'http'))
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @else
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-full object-cover">
                @endif
            </div>

            <div class="flex flex-col h-full py-2">

                <div class="text-sm font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-3">
                    {{ $product->category }}
                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white leading-tight mb-4">
                    {{ $product->name }}
                </h1>

                <p class="text-slate-600 dark:text-slate-400 leading-relaxed mb-8">
                    {{ $product->description }}
                </p>

                <div
                    class="bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 mb-8">
                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between items-center pb-4 border-b border-slate-200 dark:border-slate-800">
                            <span class="text-slate-600 dark:text-slate-400">Harga Produk</span>
                            <span class="font-bold text-lg text-slate-900 dark:text-white">Rp
                                {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-4 border-b border-slate-200 dark:border-slate-800">
                            <span class="text-slate-600 dark:text-slate-400">DP Minimal ({{ $product->dp_percent }}%)</span>
                            <span class="font-bold text-indigo-600 dark:text-indigo-400">Rp
                                {{ number_format(($product->price * $product->dp_percent) / 100, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-600 dark:text-slate-400">Bimbingan</span>
                            <span class="font-semibold text-slate-900 dark:text-white">1 Tahun</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-600 dark:text-slate-400">Buku Panduan</span>
                            <span class="font-semibold text-slate-900 dark:text-white">Termasuk (PDF)</span>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('cart.add', $product->id) }}" class="mt-auto">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 py-4 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-lg transition-colors shadow-lg shadow-indigo-500/30">
                        <i class="fa-solid fa-cart-plus"></i> Tambah ke Keranjang
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection
