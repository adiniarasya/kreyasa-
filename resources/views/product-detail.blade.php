@extends('layouts.app')

@section('title', $product->name . ' - KREYASA')

@section('content')
<div class="container" style="padding-top:140px;padding-bottom:80px;">
  <a href="{{ route('home') }}#produk" style="color:var(--text-muted);font-size:.9rem;display:inline-flex;align-items:center;gap:6px;margin-bottom:24px;">
    <i class="fa-solid fa-arrow-left"></i> Kembali ke Produk
  </a>

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:40px;max-width:1000px;margin:0 auto;" class="product-detail-grid">
    <img src="{{ $product->image }}" alt="{{ $product->name }}" style="width:100%;border-radius:16px;">
    <div>
      <div class="product-category">{{ $product->category }}</div>
      <h1 style="font-size:1.8rem;font-weight:800;margin:8px 0 16px;">{{ $product->name }}</h1>
      <p style="color:var(--text-muted);margin-bottom:20px;">{{ $product->description }}</p>

      <div class="summary-box">
        <div class="summary-row"><span>Harga Produk</span><span>Rp {{ number_format($product->price,0,',','.') }}</span></div>
        <div class="summary-row"><span>DP Minimal ({{ $product->dp_percent }}%)</span><span>Rp {{ number_format($product->price * $product->dp_percent/100,0,',','.') }}</span></div>
        <div class="summary-row"><span>Bimbingan</span><span>1 Tahun</span></div>
        <div class="summary-row"><span>Buku Panduan</span><span>Termasuk (PDF)</span></div>
      </div>

      <form method="POST" action="{{ route('cart.add', $product->id) }}">
        @csrf
        <button type="submit" class="btn btn-primary btn-block">
          <i class="fa-solid fa-cart-plus"></i> Tambah ke Keranjang
        </button>
      </form>
    </div>
  </div>
</div>

<style>
@media (max-width:768px){ .product-detail-grid{ grid-template-columns:1fr !important; } }
</style>
@endsection