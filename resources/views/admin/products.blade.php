@extends('layouts.app')

@section('title', 'Kelola Produk - KREYASA')

@section('content')
    <div class="fixed inset-0 bg-slate-50 dark:bg-slate-950 z-40 flex overflow-hidden">

        {{-- SIDEBAR --}}
        <aside
            class="w-64 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 p-6 flex flex-col shrink-0 transition-all duration-300">

            {{-- 1. LOGO --}}
            <div class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 tracking-tight mb-6 pl-2">
                KREYASA
            </div>

            {{-- 2. PROFIL ADMIN --}}
            <div class="flex items-center gap-3 px-2 mb-4 pb-4 border-b border-slate-100 dark:border-slate-800">
                <div
                    class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold shrink-0">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="min-w-0">
                    <div class="text-sm font-bold text-slate-900 dark:text-white truncate">
                        {{ auth()->user()->name }}
                    </div>
                    <div class="text-xs text-slate-500 dark:text-slate-400 truncate">
                        Administrator
                    </div>
                </div>
            </div>

            {{-- 3. LOGOUT (ATAS) --}}
            <div class="mb-6">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-red-50 hover:text-red-600 hover:border-red-200 dark:hover:bg-red-950/30 dark:hover:text-red-400 dark:hover:border-red-900/50 text-slate-700 dark:text-slate-300 text-sm font-medium transition-colors">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </button>
                </form>
            </div>

            {{-- 4. MENU NAVIGASI --}}
            <nav class="flex flex-col gap-1.5 flex-1 border-t border-slate-100 dark:border-slate-800 pt-4">
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
                    class="flex items-center gap-3 px-4 py-3 rounded-lg bg-indigo-50 dark:bg-indigo-950/30 text-indigo-600 dark:text-indigo-400 font-semibold text-sm">
                    <i class="fa-solid fa-box w-5 text-center"></i>
                    <span>Kelola Produk</span>
                </a>
                <a href="{{ route('admin.guides') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium text-sm transition-colors">
                    <i class="fa-solid fa-book w-5 text-center"></i>
                    <span>Buku Panduan</span>
                </a>
            </nav>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 overflow-y-auto">

            <header
                class="sticky top-0 z-10 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 px-8 py-5 flex items-center justify-between">
                <h1 class="text-xl font-bold text-slate-900 dark:text-white">Kelola Produk</h1>
                <div class="text-sm text-slate-500 dark:text-slate-400">
                    Total: <strong class="text-slate-900 dark:text-white">{{ $products->count() }}</strong> produk
                </div>
            </header>

            <div class="p-8 max-w-7xl mx-auto">

                @if (session('success'))
                    <div
                        class="mb-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-200 dark:border-emerald-900/50 text-emerald-600 dark:text-emerald-400 text-sm flex items-start gap-3">
                        <i class="fa-solid fa-circle-check mt-0.5"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <div
                    class="mb-10 p-6 md:p-8 bg-indigo-50/50 dark:bg-indigo-950/10 border border-indigo-100 dark:border-indigo-900/30 rounded-2xl">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-plus-circle text-indigo-500"></i> Tambah Produk Baru
                    </h3>

                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data"
                        class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama
                                    Produk *</label>
                                <input type="text" name="name" placeholder="Contoh: Paket Modul Ajar" required
                                    class="w-full px-4 py-2.5 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Kategori
                                    *</label>
                                <input type="text" name="category" placeholder="Contoh: Design Pendidikan" required
                                    class="w-full px-4 py-2.5 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Deskripsi</label>
                            <textarea name="description" rows="2" placeholder="Deskripsi singkat produk..."
                                class="w-full px-4 py-2.5 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Harga
                                    (Rp) *</label>
                                <input type="number" name="price" placeholder="500000" min="0" required
                                    class="w-full px-4 py-2.5 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">DP (%)
                                    *</label>
                                <input type="number" name="dp_percent" value="50" min="10" max="100"
                                    required
                                    class="w-full px-4 py-2.5 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Badge</label>
                                <input type="text" name="badge" placeholder="Ready / Custom" value="Ready"
                                    class="w-full px-4 py-2.5 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Foto
                                Produk</label>
                            <input type="file" name="image" accept="image/*"
                                class="w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-950/50 dark:file:text-indigo-400 transition-all border border-slate-200 dark:border-slate-700 rounded-xl bg-white dark:bg-slate-900 cursor-pointer">
                            <div class="text-xs text-slate-500 mt-2">Format: JPG, PNG, WEBP. Maks 5MB.</div>
                        </div>

                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition-colors shadow-lg shadow-indigo-500/30">
                            <i class="fa-solid fa-plus"></i> Tambah Produk
                        </button>
                    </form>
                </div>

                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6">Daftar Produk ({{ $products->count() }})
                </h3>

                <div class="space-y-6">
                    @forelse($products as $p)
                        <div
                            class="flex flex-col lg:flex-row gap-6 p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">

                            <div
                                class="w-full lg:w-32 h-32 shrink-0 rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-800">
                                @if (str_starts_with($p->image, 'http'))
                                    <img src="{{ $p->image }}" alt="{{ $p->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}"
                                        class="w-full h-full object-cover">
                                @endif
                            </div>

                            <form method="POST" action="{{ route('admin.products.update', $p->id) }}"
                                enctype="multipart/form-data" id="form-{{ $p->id }}" class="flex-1 space-y-4">
                                @csrf
                                @method('PUT')

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label
                                            class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider">Nama</label>
                                        <input type="text" name="name" value="{{ $p->name }}" required
                                            class="w-full px-3 py-2 rounded-lg bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider">Kategori</label>
                                        <input type="text" name="category" value="{{ $p->category }}" required
                                            class="w-full px-3 py-2 rounded-lg bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider">Deskripsi</label>
                                    <textarea name="description" rows="2"
                                        class="w-full px-3 py-2 rounded-lg bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">{{ $p->description }}</textarea>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label
                                            class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider">Harga
                                            (Rp)
                                        </label>
                                        <input type="number" name="price" value="{{ $p->price }}" min="0"
                                            required
                                            class="w-full px-3 py-2 rounded-lg bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider">DP
                                            (%)</label>
                                        <input type="number" name="dp_percent" value="{{ $p->dp_percent }}"
                                            min="10" max="100" required
                                            class="w-full px-3 py-2 rounded-lg bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider">Badge</label>
                                        <input type="text" name="badge" value="{{ $p->badge }}"
                                            class="w-full px-3 py-2 rounded-lg bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider">Ganti
                                        Foto (opsional)</label>
                                    <input type="file" name="image" accept="image/*"
                                        class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 dark:file:bg-slate-800 dark:file:text-slate-300 transition-all border border-slate-200 dark:border-slate-700 rounded-lg bg-slate-50 dark:bg-slate-950 cursor-pointer">
                                </div>
                            </form>

                            <div class="flex flex-row lg:flex-col gap-3 shrink-0 lg:w-32 lg:self-start">
                                <button type="submit" form="form-{{ $p->id }}"
                                    class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold transition-colors">
                                    <i class="fa-solid fa-save"></i> Simpan
                                </button>
                                <form method="POST" action="{{ route('admin.products.destroy', $p->id) }}"
                                    onsubmit="return confirm('Hapus produk {{ $p->name }}?')" class="flex-1 flex">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-red-50 dark:bg-red-950/30 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-900/50 hover:bg-red-100 dark:hover:bg-red-900/50 text-sm font-semibold transition-colors">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>

                        </div>
                    @empty
                        <div
                            class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-16 text-center shadow-sm">
                            <div
                                class="w-16 h-16 mx-auto rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-4">
                                <i class="fa-solid fa-box-open text-2xl text-slate-400"></i>
                            </div>
                            <p class="text-slate-500 dark:text-slate-400 font-medium">Belum ada produk. Tambahkan produk
                                pertama di atas!
                            </p>
                        </div>
                    @endforelse
                </div>

            </div>
        </main>
    </div>
@endsection
