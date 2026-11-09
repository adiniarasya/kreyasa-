@extends('layouts.app')

@section('title', 'Kelola Pesanan - KREYASA')

@section('content')
  <div class="fixed inset-0 bg-slate-50 dark:bg-slate-950 z-40 flex overflow-hidden">

    <aside
      class="w-64 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 p-6 flex flex-col shrink-0 transition-all duration-300">
      <div class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 tracking-tight mb-8 pl-2">
        KREYASA
      </div>

      <nav class="flex flex-col gap-1.5 flex-1">
        <a href="{{ route('admin.dashboard') }}"
          class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium text-sm transition-colors">
          <i class="fa-solid fa-chart-line w-5 text-center"></i>
          <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.orders') }}"
          class="flex items-center gap-3 px-4 py-3 rounded-lg bg-indigo-50 dark:bg-indigo-950/30 text-indigo-600 dark:text-indigo-400 font-semibold text-sm">
          <i class="fa-solid fa-receipt w-5 text-center"></i>
          <span>Kelola Pesanan</span>
        </a>
        <a href="{{ route('admin.products') }}"
          class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium text-sm transition-colors">
          <i class="fa-solid fa-box w-5 text-center"></i>
          <span>Kelola Produk</span>
        </a>
<a href="{{ route('admin.guides') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium text-sm transition-colors">
  <i class="fa-solid fa-book w-5 text-center"></i>
  <span>Buku Panduan</span>
</a>
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
        <h1 class="text-xl font-bold text-slate-900 dark:text-white">Kelola Pesanan</h1>
        <div class="text-sm text-slate-500 dark:text-slate-400">
          Total: <strong class="text-slate-900 dark:text-white">{{ $orders->count() }}</strong> pesanan
        </div>
      </header>

      <div class="p-8 max-w-7xl mx-auto">

        @if($orders->isEmpty())
          <div
            class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-16 text-center shadow-sm">
            <div
              class="w-16 h-16 mx-auto rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-4">
              <i class="fa-solid fa-inbox text-2xl text-slate-400"></i>
            </div>
            <p class="text-slate-500 dark:text-slate-400 font-medium">Belum ada pesanan masuk.</p>
          </div>
        @else
          <div
            class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
              <table class="w-full text-left border-collapse min-w-[1100px]">
                <thead>
                  <tr
                    class="bg-slate-50 dark:bg-slate-800/50 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                    <th class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">Order ID</th>
                    <th class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">Tanggal</th>
                    <th class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">Pelanggan</th>
                    <th class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">Produk</th>
                    <th class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">Total</th>
                    <th class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">Pembayaran</th>
                    <th class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">Bukti</th>
                    <th class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">Ubah Status</th>
                    <th class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">Aksi</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                  @foreach($orders as $o)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                      <td class="px-6 py-4 font-bold text-slate-900 dark:text-white whitespace-nowrap">{{ $o->order_code }}
                      </td>
                      <td class="px-6 py-4 text-slate-600 dark:text-slate-400 whitespace-nowrap">
                        {{ $o->created_at->format('d M Y') }}</td>
                      <td class="px-6 py-4">
                        <div class="font-semibold text-slate-900 dark:text-white">{{ $o->customer_name }}</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">{{ $o->customer_wa }}</div>
                      </td>
                      <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                        {!! $o->items->map(fn($i) => e($i->product_name) . ' <span class="text-slate-400">x' . $i->qty . '</span>')->join('<br>') !!}
                      </td>
                      <td class="px-6 py-4">
                        <div class="font-bold text-slate-900 dark:text-white">Rp {{ number_format($o->total, 0, ',', '.') }}
                        </div>
                        @if($o->remaining > 0)
                          <div class="text-xs text-amber-600 dark:text-amber-400 mt-1">Sisa: Rp
                            {{ number_format($o->remaining, 0, ',', '.') }}</div>
                        @endif
                      </td>
                      <td class="px-6 py-4">
                        <span
                          class="inline-block px-2.5 py-1 rounded-full text-xs font-bold {{ $o->payment_type === 'dp' ? 'bg-amber-100 text-amber-700 dark:bg-amber-950/50 dark:text-amber-400' : 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-400' }}">
                          {{ $o->payment_type === 'dp' ? 'DP' : 'Lunas' }}
                        </span>
                        @if($o->payment_method)
                          <div class="text-xs text-slate-500 mt-1 uppercase">{{ $o->payment_method }}</div>
                        @endif
                      </td>
                      <td class="px-6 py-4">
                        @if($o->payment_proof)
                          <a href="{{ asset('storage/' . $o->payment_proof) }}" target="_blank" class="block group">
                            <img src="{{ asset('storage/' . $o->payment_proof) }}"
                              class="w-14 h-14 object-cover rounded-lg border border-slate-200 dark:border-slate-700 group-hover:opacity-80 transition-opacity"
                              alt="Bukti">
                          </a>
                          <div class="text-[10px] text-slate-400 mt-1 whitespace-nowrap">
                            {{ $o->payment_uploaded_at ? $o->payment_uploaded_at->format('d/m H:i') : '' }}</div>
                        @else
                          <span class="text-xs text-slate-400 italic whitespace-nowrap">Belum ada</span>
                        @endif
                      </td>

                      {{-- DROPDOWN STATUS YANG SUDAH DIPERBAIKI --}}
                      <td class="px-6 py-4">
                        <form method="POST" action="{{ route('admin.orders.status', $o->id) }}">
                          @csrf
                          <select name="status" onchange="this.form.submit()"
                            class="w-full max-w-[250px] appearance-none bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-white text-xs font-medium rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 cursor-pointer shadow-sm transition-colors hover:bg-slate-100 dark:hover:bg-slate-900">
                            @foreach(['Menunggu Verifikasi Pembayaran', 'Dikerjakan', 'Menunggu Pelunasan', 'Lunas & Selesai', 'Masa Bimbingan', 'Bimbingan Selesai'] as $s)
                              <option value="{{ $s }}" @selected($s === $o->status)>{{ $s }}</option>
                            @endforeach
                          </select>
                        </form>
                      </td>

                      <td class="px-6 py-4">
                        <form method="POST" action="{{ route('admin.orders.destroy', $o->id) }}"
                          onsubmit="return confirm('Hapus pesanan {{ $o->order_code }}?')">
                          @csrf
                          <button type="submit"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-950/30 dark:text-red-400 dark:hover:bg-red-900/50 transition-colors">
                            <i class="fa-solid fa-trash text-xs"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        @endif
      </div>
    </main>
  </div>
@endsection