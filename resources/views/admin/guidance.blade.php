@extends('layouts.app')

@section('title', 'Manajemen Bimbingan - KREYASA')

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
                    class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium text-sm transition-colors">
                    <i class="fa-solid fa-receipt w-5 text-center"></i>
                    <span>Kelola Pesanan</span>
                </a>
                <a href="{{ route('admin.products') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium text-sm transition-colors">
                    <i class="fa-solid fa-box w-5 text-center"></i>
                    <span>Kelola Produk</span>
                </a>
                <a href="{{ route('admin.guidance') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg bg-indigo-50 dark:bg-indigo-950/30 text-indigo-600 dark:text-indigo-400 font-semibold text-sm">
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
                <h1 class="text-xl font-bold text-slate-900 dark:text-white">Manajemen Bimbingan</h1>
                <div class="text-sm text-slate-500 dark:text-slate-400">
                    Total Klien: <strong class="text-slate-900 dark:text-white">{{ $orders->count() }}</strong>
                </div>
            </header>

            <div class="p-8 max-w-7xl mx-auto">

                @if (session('success'))
                    <div
                        class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($orders->isEmpty())
                    <div
                        class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-16 text-center shadow-sm">
                        <div
                            class="w-16 h-16 mx-auto rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-book-open text-2xl text-slate-400"></i>
                        </div>
                        <p class="text-slate-500 dark:text-slate-400 font-medium">Belum ada klien yang masuk masa bimbingan.
                        </p>
                    </div>
                @else
                    <div
                        class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse min-w-[900px]">
                                <thead>
                                    <tr
                                        class="bg-slate-50 dark:bg-slate-800/50 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                        <th class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">Kode Pesanan
                                        </th>
                                        <th class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">Nama Klien
                                        </th>
                                        <th class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">Produk</th>
                                        <th class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">Tgl Lunas</th>
                                        <th class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">Status
                                            Bimbingan</th>
                                        <th class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                                    @foreach ($orders as $o)
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                            <td
                                                class="px-6 py-4 font-bold text-slate-900 dark:text-white whitespace-nowrap">
                                                {{ $o->order_code }}</td>
                                            <td class="px-6 py-4">
                                                <div class="font-semibold text-slate-900 dark:text-white">
                                                    {{ $o->customer_name }}</div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                                    {{ $o->customer_wa }}</div>
                                            </td>
                                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                                {!! $o->items->map(fn($i) => e($i->product_name))->join('<br>') !!}
                                            </td>
                                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400 whitespace-nowrap">
                                                {{ $o->updated_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="inline-block px-2.5 py-1 rounded-full text-xs font-bold {{ $o->status === 'Bimbingan Selesai' ? 'bg-emerald-100 text-emerald-700' : 'bg-blue-100 text-blue-700' }}">
                                                    {{ $o->status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <form method="POST" action="{{ route('admin.guidance.status', $o->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="status" onchange="this.form.submit()"
                                                        class="w-full max-w-[200px] appearance-none bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-white text-xs font-medium rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 cursor-pointer shadow-sm">
                                                        @foreach (['Masa Bimbingan', 'Bimbingan Selesai'] as $s)
                                                            <option value="{{ $s }}"
                                                                @selected($s === $o->status)>{{ $s }}</option>
                                                        @endforeach
                                                    </select>
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
