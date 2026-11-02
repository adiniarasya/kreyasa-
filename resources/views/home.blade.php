@extends('layouts.app')

@section('title', 'KREYASA - Platform Digital Pendidikan & Bisnis')

@section('content')

  <header
    class="sticky top-0 z-50 w-full bg-white/80 dark:bg-slate-950/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
    <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
      <a href="/" class="text-xl font-bold text-indigo-600 dark:text-indigo-400 tracking-tight">KREYASA</a>

      <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600 dark:text-slate-400">
        <a href="#beranda" class="hover:text-indigo-600 dark:hover:text-white transition-colors">Beranda</a>
        <a href="#produk" class="hover:text-indigo-600 dark:hover:text-white transition-colors">Produk</a>
        <a href="#custom-request" class="hover:text-indigo-600 dark:hover:text-white transition-colors">Custom Request</a>
        <a href="#kontak" class="hover:text-indigo-600 dark:hover:text-white transition-colors">Kontak</a>
      </nav>

      <div class="flex items-center gap-3">
        <a href="{{ route('cart.index') }}"
          class="relative w-10 h-10 flex items-center justify-center rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400 transition-colors">
          <i class="fa-solid fa-cart-shopping text-lg"></i>
        </a>
        <a href="{{ route('admin.login') }}"
          class="px-4 py-2 rounded-lg border border-indigo-600 text-indigo-600 dark:border-indigo-400 dark:text-indigo-400 text-sm font-medium hover:bg-indigo-50 dark:hover:bg-indigo-950 transition-colors">
          Login Admin
        </a>
      </div>
    </div>
  </header>

  <main id="publicView">

    <section class="relative overflow-hidden py-24 lg:py-32" id="beranda">
      <div
        class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl -translate-y-1/2 pointer-events-none">
      </div>
      <div
        class="absolute bottom-0 right-1/4 w-96 h-96 bg-violet-500/10 rounded-full blur-3xl translate-y-1/2 pointer-events-none">
      </div>
      <div class="relative max-w-6xl mx-auto px-6 text-center">
        <span
          class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold bg-indigo-50 dark:bg-indigo-950/50 text-indigo-700 dark:text-indigo-300 border border-indigo-100 dark:border-indigo-900/50">
          <i class="fa-solid fa-rocket"></i> Platform Digital Terpercaya
        </span>
        <h1
          class="mt-8 text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-slate-900 dark:text-white leading-tight">
          Solusi Digital untuk <br class="hidden md:block">
          <span class="bg-gradient-to-r from-indigo-500 to-violet-500 bg-clip-text text-transparent">
            Pendidikan & Bisnis
          </span>
        </h1>
        <p class="mt-6 max-w-2xl mx-auto text-base md:text-lg text-slate-600 dark:text-slate-400 leading-relaxed">
          Dari desain hingga aplikasi, kami wujudkan ide Anda menjadi produk digital berkualitas tinggi — lengkap dengan
          bimbingan 1 tahun & buku panduan.
        </p>
        <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
          <a href="#produk"
            class="inline-flex items-center px-8 py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition-all shadow-lg shadow-indigo-500/30 hover:-translate-y-0.5">
            Belanja Produk
          </a>
          <a href="#custom-request"
            class="inline-flex items-center px-8 py-3.5 rounded-xl border-2 border-slate-200 dark:border-slate-800 hover:border-slate-300 dark:hover:border-slate-700 text-slate-700 dark:text-slate-300 font-semibold transition-all">
            Custom Request
          </a>
        </div>
        <div class="mt-16 grid grid-cols-3 gap-4 max-w-2xl mx-auto border-t border-slate-200 dark:border-slate-800 pt-8">
          <div>
            <div class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white">50+</div>
            <div class="mt-1 text-sm font-medium text-slate-500 dark:text-slate-400">Produk Digital</div>
          </div>
          <div class="border-x border-slate-200 dark:border-slate-800">
            <div class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white">200+</div>
            <div class="mt-1 text-sm font-medium text-slate-500 dark:text-slate-400">Klien Puas</div>
          </div>
          <div>
            <div class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white">98%</div>
            <div class="mt-1 text-sm font-medium text-slate-500 dark:text-slate-400">Kepuasan</div>
          </div>
        </div>
      </div>
    </section>

    <section id="layanan" class="py-24 bg-white dark:bg-slate-900 border-y border-slate-200 dark:border-slate-800">
      <div class="max-w-6xl mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16">
          <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">Layanan
            Kami</span>
          <h2 class="mt-3 text-3xl md:text-4xl font-bold text-slate-900 dark:text-white">Apa yang Bisa Kami Bantu?</h2>
          <p class="mt-4 text-slate-600 dark:text-slate-400 text-lg">Beragam layanan digital yang dirancang untuk
            kebutuhan pendidikan maupun bisnis Anda.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @php
            $services = [
              ['fa-graduation-cap', 'Design Pendidikan', 'Materi ajar, modul, dan media pembelajaran yang menarik dan mudah dipahami.'],
              ['fa-palette', 'Custom Design', 'Desain grafis sesuai kebutuhan spesifik brand atau proyek Anda.'],
              ['fa-mobile-screen', 'Aplikasi Mobile', 'Pengembangan aplikasi Android & iOS yang cepat, aman, dan mudah digunakan.'],
              ['fa-globe', 'Website', 'Website profesional, responsif, dan siap mendukung pertumbuhan bisnis Anda.'],
              ['fa-table-cells-large', 'Produk Digital', 'Template, e-book, dan aset digital siap pakai untuk berbagai keperluan.'],
              ['fa-headset', 'Konsultasi', 'Diskusi kebutuhan proyek Anda bersama tim kami sebelum memulai pengerjaan.'],
            ];
          @endphp
          @foreach($services as $s)
            <div
              class="group p-8 rounded-2xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 hover:border-indigo-200 dark:hover:border-indigo-800 hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-300">
              <div
                class="w-14 h-14 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-2xl group-hover:scale-110 transition-transform">
                <i class="fa-solid {{ $s[0] }}"></i>
              </div>
              <h3 class="mt-6 text-xl font-bold text-slate-900 dark:text-white">{{ $s[1] }}</h3>
              <p class="mt-3 text-slate-600 dark:text-slate-400 leading-relaxed">{{ $s[2] }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <section class="py-24" id="produk">
      <div class="max-w-6xl mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16">
          <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">Produk
            Unggulan</span>
          <h2 class="mt-3 text-3xl md:text-4xl font-bold text-slate-900 dark:text-white">Belanja Langsung di Sini</h2>
          <p class="mt-4 text-slate-600 dark:text-slate-400 text-lg">Pilih produk, bayar DP untuk mulai pengerjaan, lalu
            lunasi setelah produk selesai.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="productsGrid">
          @forelse($products as $p)
            <div
              class="group flex flex-col rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:shadow-2xl hover:shadow-indigo-500/10 transition-all duration-300 overflow-hidden">

              <a href="{{ route('product.detail', $p->id) }}"
                class="block relative aspect-[4/3] bg-slate-100 dark:bg-slate-800 overflow-hidden">
                @if(str_starts_with($p->image, 'http'))
                  <img src="{{ $p->image }}" alt="{{ $p->name }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                  <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @endif
                <span
                  class="absolute top-4 left-4 px-3 py-1 rounded-lg text-xs font-bold bg-indigo-600 text-white shadow-sm">{{ $p->badge }}</span>
              </a>

              <div class="p-6 flex flex-col flex-1">
                <div class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">
                  {{ $p->category }}
                </div>
                <a href="{{ route('product.detail', $p->id) }}"
                  class="mt-2 text-xl font-bold text-slate-900 dark:text-white hover:text-indigo-600 transition-colors line-clamp-2">{{ $p->name }}</a>
                <div class="mt-4 text-2xl font-black text-slate-900 dark:text-white">Rp
                  {{ number_format($p->price, 0, ',', '.') }}
                </div>
                <div class="mt-5 space-y-2 text-sm text-slate-600 dark:text-slate-400">
                  <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-500"></i> Bimbingan 1
                    tahun</div>
                  <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-green-500"></i> Buku panduan
                    digital</div>
                </div>
                <div
                  class="mt-5 p-3 rounded-xl bg-amber-50 dark:bg-amber-950/30 border border-amber-100 dark:border-amber-900/50 flex items-start gap-2.5 text-xs text-amber-700 dark:text-amber-400">
                  <i class="fa-solid fa-circle-info mt-0.5"></i>
                  <span>DP {{ $p->dp_percent }}% (Rp {{ number_format($p->price * $p->dp_percent / 100, 0, ',', '.') }}),
                    sisanya dibayar setelah selesai</span>
                </div>
                <div class="mt-6 pt-6 border-t border-slate-100 dark:border-slate-800 flex gap-3 mt-auto">
                  <a href="{{ route('product.detail', $p->id) }}"
                    class="flex-1 inline-flex items-center justify-center px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-sm font-semibold text-slate-700 dark:text-slate-300 transition-colors">Detail</a>
                  <form method="POST" action="{{ route('cart.add', $p->id) }}" class="flex-1 flex">
                    @csrf
                    <button type="submit"
                      class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold transition-colors">
                      <i class="fa-solid fa-cart-plus"></i> Keranjang
                    </button>
                  </form>
                </div>
              </div>
            </div>
          @empty
            <div class="col-span-full py-12 text-center text-slate-500 dark:text-slate-400">
              <i class="fa-solid fa-box-open text-4xl mb-4 opacity-50"></i>
              <p>Belum ada produk.</p>
            </div>
          @endforelse
        </div>
      </div>
    </section>

    <section class="py-24 bg-white dark:bg-slate-900 border-y border-slate-200 dark:border-slate-800" id="garansi">
      <div class="max-w-6xl mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16">
          <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">Garansi
            Kami</span>
          <h2 class="mt-3 text-3xl md:text-4xl font-bold text-slate-900 dark:text-white">Bimbingan 1 Tahun & Buku Panduan
          </h2>
          <p class="mt-4 text-slate-600 dark:text-slate-400 text-lg">Bukan cuma menjual produk, kami mendampingi Anda
            memakainya.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div
            class="p-8 rounded-3xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-center">
            <div
              class="w-16 h-16 mx-auto rounded-2xl bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-2xl">
              <i class="fa-solid fa-user-shield"></i>
            </div>
            <h3 class="mt-6 text-lg font-bold text-slate-900 dark:text-white">Bimbingan Penggunaan 1 Tahun</h3>
            <p class="mt-3 text-sm text-slate-600 dark:text-slate-400 leading-relaxed">Setelah produk selesai, tim kami
              mendampingi Anda selama 1 tahun penuh untuk memastikan produk digunakan secara optimal.</p>
          </div>
          <div
            class="p-8 rounded-3xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-center">
            <div
              class="w-16 h-16 mx-auto rounded-2xl bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-2xl">
              <i class="fa-solid fa-book"></i>
            </div>
            <h3 class="mt-6 text-lg font-bold text-slate-900 dark:text-white">Buku Panduan Lengkap</h3>
            <p class="mt-3 text-sm text-slate-600 dark:text-slate-400 leading-relaxed">Setiap produk dilengkapi buku
              panduan digital (PDF) berisi langkah penggunaan, tips, dan solusi masalah umum.</p>
          </div>
          <div
            class="p-8 rounded-3xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-center">
            <div
              class="w-16 h-16 mx-auto rounded-2xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400 text-2xl">
              <i class="fa-brands fa-whatsapp"></i>
            </div>
            <h3 class="mt-6 text-lg font-bold text-slate-900 dark:text-white">Konsultasi Kapan Saja</h3>
            <p class="mt-3 text-sm text-slate-600 dark:text-slate-400 leading-relaxed">Ada kendala saat pemakaian? Hubungi
              tim kami via WhatsApp, kami siap membantu selama masa garansi berlaku.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="py-24" id="custom-request">
      <div class="max-w-5xl mx-auto px-6">
        <div
          class="relative rounded-3xl p-10 md:p-16 bg-indigo-600 overflow-hidden text-center shadow-2xl shadow-indigo-600/30">
          <div
            class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-2xl -translate-y-1/2 translate-x-1/2">
          </div>
          <div
            class="absolute bottom-0 left-0 w-64 h-64 bg-white/10 rounded-full blur-2xl translate-y-1/2 -translate-x-1/2">
          </div>
          <div class="relative">
            <h2 class="text-3xl md:text-4xl font-bold text-white">Butuh Produk Sesuai Kebutuhan?</h2>
            <p class="mt-4 max-w-2xl mx-auto text-indigo-100 text-lg leading-relaxed">Kirimkan permintaan custom Anda dan
              tim kami akan membantu mewujudkan produk digital yang sesuai dengan kebutuhan spesifik Anda. Skema
              pembayaran tetap DP dulu, lunas setelah selesai.</p>
            <a href="https://wa.me/6281234567890" target="_blank"
              class="mt-8 inline-flex items-center gap-2 px-8 py-3.5 rounded-xl bg-white text-indigo-700 hover:bg-slate-50 font-bold transition-colors shadow-lg">
              <i class="fa-brands fa-whatsapp text-xl"></i> Ajukan Custom Request
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="py-24 bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800" id="testimoni">
      <div class="max-w-6xl mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16">
          <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">Testimoni</span>
          <h2 class="mt-3 text-3xl md:text-4xl font-bold text-slate-900 dark:text-white">Apa Kata Mereka?</h2>
          <p class="mt-4 text-slate-600 dark:text-slate-400 text-lg">Kepercayaan klien adalah prioritas utama kami.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="p-8 rounded-3xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800">
            <div class="flex gap-1 text-amber-400 text-sm">
              <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            </div>
            <p class="mt-5 text-slate-700 dark:text-slate-300 leading-relaxed">"Modul ajar yang dibuat KREYASA sangat
              membantu proses belajar mengajar di kelas saya. Rapi dan mudah dipahami siswa."</p>
            <div class="mt-8 flex items-center gap-4">
              <div
                class="w-12 h-12 rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-400 flex items-center justify-center font-bold text-lg">
                AS</div>
              <div>
                <div class="font-bold text-slate-900 dark:text-white">Andi Saputra</div>
                <div class="text-sm text-slate-500 dark:text-slate-400">Guru SDN 01 Jakarta</div>
              </div>
            </div>
          </div>
          <div class="p-8 rounded-3xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800">
            <div class="flex gap-1 text-amber-400 text-sm">
              <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            </div>
            <p class="mt-5 text-slate-700 dark:text-slate-300 leading-relaxed">"Sistem DP dulu baru lunas sangat membantu
              cashflow bisnis kami. Hasilnya juga sangat profesional."</p>
            <div class="mt-8 flex items-center gap-4">
              <div
                class="w-12 h-12 rounded-full bg-violet-100 dark:bg-violet-900/50 text-violet-700 dark:text-violet-400 flex items-center justify-center font-bold text-lg">
                BR</div>
              <div>
                <div class="font-bold text-slate-900 dark:text-white">Budi Raharjo</div>
                <div class="text-sm text-slate-500 dark:text-slate-400">Owner CV Digital Mandiri</div>
              </div>
            </div>
          </div>
          <div class="p-8 rounded-3xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800">
            <div class="flex gap-1 text-amber-400 text-sm">
              <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            </div>
            <p class="mt-5 text-slate-700 dark:text-slate-300 leading-relaxed">"Bimbingan 1 tahunnya beneran dipakai, tim
              KREYASA selalu responsif tiap kami ada pertanyaan soal aplikasi."</p>
            <div class="mt-8 flex items-center gap-4">
              <div
                class="w-12 h-12 rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-400 flex items-center justify-center font-bold text-lg">
                SW</div>
              <div>
                <div class="font-bold text-slate-900 dark:text-white">Siti Wulandari</div>
                <div class="text-sm text-slate-500 dark:text-slate-400">Founder Startup EduTech</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>

  <footer class="bg-slate-950 text-slate-400 py-12 border-t border-slate-900">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <div class="text-2xl font-bold text-white mb-4">KREYASA</div>
      <p class="text-sm">Platform Digital Pendidikan & Bisnis.</p>
      <div class="mt-8 pt-8 border-t border-slate-800 text-xs">
        &copy; {{ date('Y') }} KREYASA. All rights reserved.
      </div>
    </div>
  </footer>

@endsection