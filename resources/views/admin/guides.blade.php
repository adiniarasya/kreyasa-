@extends('layouts.app')

@section('title', 'Buku Panduan - KREYASA')

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
                    class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium text-sm transition-colors">
                    <i class="fa-solid fa-box w-5 text-center"></i>
                    <span>Kelola Produk</span>
                </a>
                <a href="{{ route('admin.guides') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg bg-indigo-50 dark:bg-indigo-950/30 text-indigo-600 dark:text-indigo-400 font-semibold text-sm">
                    <i class="fa-solid fa-book w-5 text-center"></i>
                    <span>Buku Panduan</span>
                </a>
            </nav>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 overflow-y-auto">

            <header
                class="sticky top-0 z-10 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 px-8 py-5 flex items-center justify-between">
                <h1 class="text-xl font-bold text-slate-900 dark:text-white">Buku Panduan & Materi</h1>
                <div class="text-sm text-slate-500 dark:text-slate-400">
                    Halo, <strong class="text-slate-900 dark:text-white">{{ auth()->user()->name }}</strong>
                </div>
            </header>

            <div class="p-8 max-w-4xl mx-auto">

                {{-- Info Card --}}
                <div
                    class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm mb-6">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3">Panduan Penggunaan Aplikasi</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">
                        Setiap pesanan yang berstatus <b class="text-emerald-600 dark:text-emerald-400">Lunas & Selesai</b>
                        otomatis memasuki masa <b>Bimbingan 1 Tahun</b>.
                        Buku panduan digital (PDF) dikirimkan ke WhatsApp/email pelanggan bersamaan dengan produk akhir.
                    </p>
                </div>

                {{-- Daftar Materi --}}
                <div class="flex flex-col gap-4">

                    {{-- PDF --}}
                    <div
                        class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 shadow-sm flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-rose-50 dark:bg-rose-950/30 flex items-center justify-center text-rose-600 dark:text-rose-400 shrink-0">
                            <i class="fa-solid fa-file-pdf text-xl"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold text-slate-900 dark:text-white text-sm mb-1">
                                Buku Panduan Umum KREYASA.pdf
                            </div>
                            <div class="text-slate-500 dark:text-slate-400 text-xs">
                                Berisi cara penggunaan produk, bimbingan, & kontak admin.
                            </div>
                        </div>
                        <a href="{{ route('admin.guides.download', 'panduan-umum-kreyasa.pdf') }}"
                            class="shrink-0 inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 text-sm font-medium transition-colors">
                            <i class="fa-solid fa-download"></i> Unduh
                        </a>
                    </div>

                    {{-- Video --}}
                    <div
                        class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 shadow-sm flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-violet-50 dark:bg-violet-950/30 flex items-center justify-center text-violet-600 dark:text-violet-400 shrink-0">
                            <i class="fa-solid fa-video text-xl"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold text-slate-900 dark:text-white text-sm mb-1">
                                Video Tutorial Onboarding
                            </div>
                            <div class="text-slate-500 dark:text-slate-400 text-xs">
                                Dikirim otomatis di awal masa bimbingan pelanggan.
                            </div>
                        </div>
                        <a href="https://www.youtube.com/@kreyasa" target="_blank" rel="noopener"
                            class="shrink-0 inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 text-sm font-medium transition-colors">
                            <i class="fa-solid fa-play"></i> Lihat
                        </a>
                    </div>

                    {{-- WhatsApp --}}
                    <div
                        class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 shadow-sm flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-950/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shrink-0">
                            <i class="fa-brands fa-whatsapp text-xl"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold text-slate-900 dark:text-white text-sm mb-1">
                                Layanan Konsultasi 1 Tahun
                            </div>
                            <div class="text-slate-500 dark:text-slate-400 text-xs">
                                Pelanggan bisa hubungi admin via WA selama masa garansi.
                            </div>
                        </div>
                        <a href="https://wa.me/6281234567890" target="_blank" rel="noopener"
                            class="shrink-0 inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 text-sm font-medium transition-colors">
                            <i class="fa-brands fa-whatsapp"></i> Chat Admin
                        </a>
                    </div>

                </div>

            </div>
        </main>
    </div>
@endsection
