@extends('layouts.app')

@section('title', 'Dashboard Admin - KREYASA')

@section('content')
  <div class="fixed inset-0 bg-slate-50 dark:bg-slate-950 z-40 flex overflow-hidden">

    <aside
      class="w-64 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 p-6 flex flex-col shrink-0 transition-all duration-300">
      <div class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 tracking-tight mb-8 pl-2">
        KREYASA
      </div>

      <nav class="flex flex-col gap-1.5 flex-1">
        <a href="{{ route('admin.dashboard') }}"
          class="flex items-center gap-3 px-4 py-3 rounded-lg bg-indigo-50 dark:bg-indigo-950/30 text-indigo-600 dark:text-indigo-400 font-semibold text-sm">
          <i class="fa-solid fa-chart-line w-5 text-center"></i>
          <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.orders') }}"
          class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium text-sm transition-colors">
          <i class="fa-solid fa-receipt w-5 text-center"></i>
          <span>Kelola Pesanan</span>
        </a>
        <a href="{{ route('admin.products') }}"
          class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium text-sm transition-colors">
          <i class="fa-solid fa-box w-5 text-center"></i>
          <span>Kelola Produk</span>
        </a>
        <a href="#"
          class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium text-sm transition-colors">
          <i class="fa-solid fa-book w-5 text-center"></i>
          <span>Buku Panduan</span>
        </a>
      </nav>

      <form method="POST" action="{{ route('admin.logout') }}" class="mt-6">
        @csrf
        <button type="submit"
          class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 text-sm font-medium transition-colors">
          <i class="fa-solid fa-right-from-bracket"></i> Logout
        </button>
      </form>
    </aside>

    <main class="flex-1 overflow-y-auto">

      <header
        class="sticky top-0 z-10 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 px-8 py-5 flex items-center justify-between">
        <h1 class="text-xl font-bold text-slate-900 dark:text-white">Dashboard</h1>
        <div class="text-sm text-slate-500 dark:text-slate-400">
          Halo, <strong class="text-slate-900 dark:text-white">{{ auth()->user()->name }}</strong>
        </div>
      </header>

      <div class="p-8 max-w-7xl mx-auto">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

          <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
            <div
              class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-950/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400 mb-4">
              <i class="fa-solid fa-receipt"></i>
            </div>
            <div class="text-2xl font-bold text-slate-900 dark:text-white">{{ $totalOrders }}</div>
            <div class="text-sm text-slate-500 dark:text-slate-400 mt-1">Total Pesanan</div>
          </div>

          <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
            <div
              class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950/30 flex items-center justify-center text-amber-600 dark:text-amber-400 mb-4">
              <i class="fa-solid fa-spinner"></i>
            </div>
            <div class="text-2xl font-bold text-slate-900 dark:text-white">{{ $activeOrders }}</div>
            <div class="text-sm text-slate-500 dark:text-slate-400 mt-1">Pesanan Aktif</div>
          </div>

          <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
            <div
              class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400 mb-4">
              <i class="fa-solid fa-sack-dollar"></i>
            </div>
            <div class="text-xl font-bold text-slate-900 dark:text-white truncate"
              title="Rp {{ number_format($revenue, 0, ',', '.') }}">
              Rp {{ number_format($revenue, 0, ',', '.') }}
            </div>
            <div class="text-sm text-slate-500 dark:text-slate-400 mt-1">Pendapatan Diterima</div>
          </div>

          <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
            <div
              class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-950/30 flex items-center justify-center text-blue-600 dark:text-blue-400 mb-4">
              <i class="fa-solid fa-user-shield"></i>
            </div>
            <div class="text-2xl font-bold text-slate-900 dark:text-white">{{ $inGuidance }}</div>
            <div class="text-sm text-slate-500 dark:text-slate-400 mt-1">Dalam Masa Bimbingan</div>
          </div>
        </div>

        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm">
          <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Pesanan Terbaru</h3>

          <div class="flex flex-col divide-y divide-slate-100 dark:divide-slate-800">
            @forelse($recentOrders as $o)
              <div class="py-4 flex items-center justify-between">
                <div>
                  <div class="font-semibold text-slate-900 dark:text-white text-sm">{{ $o->order_code }} —
                    {{ $o->customer_name }}</div>
                  <div class="text-slate-500 dark:text-slate-400 text-xs mt-1">
                    {{ $o->items->pluck('product_name')->join(', ') }}</div>
                </div>
                <span
                  class="px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-900/50">
                  {{ $o->status }}
                </span>
              </div>
            @empty
              <p class="text-slate-500 dark:text-slate-400 py-4 text-sm">Belum ada pesanan.</p>
            @endforelse
          </div>
        </div>

      </div>
    </main>
  </div>
@endsection