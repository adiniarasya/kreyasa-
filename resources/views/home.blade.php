@extends('layouts.app')

@section('title', 'KREYASA - Platform Digital Pendidikan & Bisnis')

@section('content')
<div id="publicView">
  @include('partials.navbar')

  <!-- HERO -->
  <section class="hero" id="beranda">
    <div class="glow glow-1"></div>
    <div class="glow glow-2"></div>
    <div class="container hero-content">
      <div class="badge glass"><i class="fa-solid fa-rocket"></i> Platform Digital Terpercaya</div>
      <h1>Solusi Digital untuk <span class="gradient-text">Pendidikan & Bisnis</span></h1>
      <p class="subtitle">Dari desain hingga aplikasi, kami wujudkan ide Anda menjadi produk digital berkualitas tinggi — lengkap dengan bimbingan 1 tahun & buku panduan.</p>
      <div class="hero-cta">
        <a href="#produk" class="btn btn-primary">Belanja Produk</a>
        <a href="#custom-request" class="btn btn-outline">Custom Request</a>
      </div>
      <div class="hero-stats">
        <div class="stat-item"><div class="stat-number">50+</div><div class="stat-label">Produk Digital</div></div>
        <div class="stat-item"><div class="stat-number">200+</div><div class="stat-label">Klien Puas</div></div>
        <div class="stat-item"><div class="stat-number">98%</div><div class="stat-label">Kepuasan</div></div>
      </div>
    </div>
  </section>

  <!-- LAYANAN -->
  <section id="layanan">
    <div class="container">
      <span class="section-tag reveal">Layanan Kami</span>
      <h2 class="section-heading reveal">Apa yang Bisa Kami Bantu?</h2>
      <p class="section-sub reveal">Beragam layanan digital yang dirancang untuk kebutuhan pendidikan maupun bisnis Anda.</p>
      <div class="services-grid">
        @php
          $services = [
            ['fa-graduation-cap', 'Design Pendidikan', 'Materi ajar, modul, dan media pembelajaran yang menarik dan mudah dipahami.'],
            ['fa-palette', 'Custom Design', 'Desain grafis sesuai kebutuhan spesifik brand atau proyek Anda.'],
            ['fa-mobile-alt', 'Aplikasi Mobile', 'Pengembangan aplikasi Android & iOS yang cepat, aman, dan mudah digunakan.'],
            ['fa-globe', 'Website', 'Website profesional, responsif, dan siap mendukung pertumbuhan bisnis Anda.'],
            ['fa-table-cells', 'Produk Digital', 'Template, e-book, dan aset digital siap pakai untuk berbagai keperluan.'],
            ['fa-headset', 'Konsultasi', 'Diskusi kebutuhan proyek Anda bersama tim kami sebelum memulai pengerjaan.'],
          ];
        @endphp
        @foreach($services as $s)
          <div class="service-card glass reveal">
            <div class="service-icon"><i class="fa-solid {{ $s[0] }}"></i></div>
            <h3>{{ $s[1] }}</h3>
            <p>{{ $s[2] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- PRODUK -->
  <section class="products" id="produk">
    <div class="container">
      <span class="section-tag reveal">Produk Unggulan</span>
      <h2 class="section-heading reveal">Belanja Langsung di Sini</h2>
      <p class="section-sub reveal">Pilih produk, bayar DP untuk mulai pengerjaan, lalu lunasi setelah produk selesai. Semua produk sudah termasuk bimbingan 1 tahun & buku panduan.</p>
      <div class="products-grid" id="productsGrid">
        @forelse($products as $p)
          <div class="product-card glass reveal visible">
            <a href="{{ route('product.detail', $p->id) }}" class="product-img" style="display:block;">
              <img src="{{ $p->image }}" alt="{{ $p->name }}">
              <span class="product-badge">{{ $p->badge }}</span>
            </a>
            <div class="product-body">
              <div class="product-category">{{ $p->category }}</div>
              <a href="{{ route('product.detail', $p->id) }}" class="product-name" style="color:inherit;">{{ $p->name }}</a>
              <div class="product-price">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
              <div class="product-perks">
                <span><i class="fa-solid fa-check"></i> Bimbingan 1 tahun</span>
                <span><i class="fa-solid fa-check"></i> Buku panduan digital</span>
              </div>
              <div class="dp-note">
                <i class="fa-solid fa-circle-info"></i>
                DP {{ $p->dp_percent }}% (Rp {{ number_format($p->price * $p->dp_percent / 100, 0, ',', '.') }}), sisanya dibayar setelah selesai
              </div>
              <div class="product-actions" style="margin-top:12px;">
                <a href="{{ route('product.detail', $p->id) }}" class="btn btn-outline" style="flex:1;">Detail</a>
                <form method="POST" action="{{ route('cart.add', $p->id) }}" style="flex:1;display:flex;">
                  @csrf
                  <button type="submit" class="btn btn-primary" style="width:100%;">
                    <i class="fa-solid fa-cart-plus"></i> Keranjang
                  </button>
                </form>
              </div>
            </div>
          </div>
        @empty
          <p style="color:var(--text-muted);grid-column:1/-1;text-align:center;">Belum ada produk.</p>
        @endforelse
      </div>
    </div>
  </section>

  <!-- GARANSI -->
  <section class="guarantee" id="garansi">
    <div class="container">
      <span class="section-tag reveal">Garansi Kami</span>
      <h2 class="section-heading reveal">Bimbingan 1 Tahun & Buku Panduan</h2>
      <p class="section-sub reveal">Bukan cuma menjual produk, kami mendampingi Anda memakainya.</p>
      <div class="guarantee-grid">
        <div class="guarantee-card glass reveal">
          <div class="g-icon"><i class="fa-solid fa-user-shield"></i></div>
          <h3>Bimbingan Penggunaan 1 Tahun</h3>
          <p>Setelah produk selesai, tim kami mendampingi Anda selama 1 tahun penuh untuk memastikan produk digunakan secara optimal.</p>
        </div>
        <div class="guarantee-card glass reveal">
          <div class="g-icon"><i class="fa-solid fa-book"></i></div>
          <h3>Buku Panduan Lengkap</h3>
          <p>Setiap produk dilengkapi buku panduan digital (PDF) berisi langkah penggunaan, tips, dan solusi masalah umum.</p>
        </div>
        <div class="guarantee-card glass reveal">
          <div class="g-icon"><i class="fa-brands fa-whatsapp"></i></div>
          <h3>Konsultasi Kapan Saja</h3>
          <p>Ada kendala saat pemakaian? Hubungi tim kami via WhatsApp, kami siap membantu selama masa garansi berlaku.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CUSTOM REQUEST -->
  <section class="custom-request" id="custom-request">
    <div class="container">
      <div class="cr-box glass reveal">
        <h2>Butuh Produk Sesuai Kebutuhan?</h2>
        <p>Kirimkan permintaan custom Anda dan tim kami akan membantu mewujudkan produk digital yang sesuai dengan kebutuhan spesifik Anda. Skema pembayaran tetap DP dulu, lunas setelah selesai.</p>
        <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-primary"><i class="fa-brands fa-whatsapp"></i> Ajukan Custom Request</a>
      </div>
    </div>
  </section>

  <!-- TESTIMONI -->
  <section id="testimoni">
    <div class="container">
      <span class="section-tag reveal">Testimoni</span>
      <h2 class="section-heading reveal">Apa Kata Mereka?</h2>
      <p class="section-sub reveal">Kepercayaan klien adalah prioritas utama kami.</p>
      <div class="testimonials-grid">
        <div class="testimonial-card glass reveal">
          <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
          <p class="testimonial-text">"Modul ajar yang dibuat KREYASA sangat membantu proses belajar mengajar di kelas saya. Rapi dan mudah dipahami siswa."</p>
          <div class="testimonial-author">
            <img src="https://via.placeholder.com/48/6C3CE1/ffffff?text=AS" alt="Andi Saputra">
            <div><div class="author-name">Andi Saputra</div><div class="author-role">Guru SDN 01 Jakarta</div></div>
          </div>
        </div>
        <div class="testimonial-card glass reveal">
          <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
          <p class="testimonial-text">"Sistem DP dulu baru lunas sangat membantu cashflow bisnis kami. Hasilnya juga sangat profesional."</p>
          <div class="testimonial-author">
            <img src="https://via.placeholder.com/48/8B5CF6/ffffff?text=BR" alt="Budi Raharjo">
            <div><div class="author-name">Budi Raharjo</div><div class="author-role">Owner CV Digital Mandiri</div></div>
          </div>
        </div>
        <div class="testimonial-card glass reveal">
          <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
          <p class="testimonial-text">"Bimbingan 1 tahunnya beneran dipakai, tim KREYASA selalu responsif tiap kami ada pertanyaan soal aplikasi."</p>
          <div class="testimonial-author">
            <img src="https://via.placeholder.com/48/6C3CE1/ffffff?text=SW" alt="Siti Wulandari">
            <div><div class="author-name">Siti Wulandari</div><div class="author-role">Founder Startup EduTech</div></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('partials.footer')
</div>
@endsection