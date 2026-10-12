@extends('layouts.app')

@section('title', 'Keranjang - KREYASA')

@section('content')
<div class="container" style="padding-top:140px;padding-bottom:80px;">
  <h1 style="font-size:1.8rem;font-weight:800;margin-bottom:32px;">Keranjang Saya</h1>

  @if(empty($cart))
    <div class="glass" style="text-align:center;padding:60px 20px;border-radius:16px;">
      <i class="fa-solid fa-cart-shopping" style="font-size:2.4rem;color:var(--text-muted);margin-bottom:14px;"></i>
      <p style="color:var(--text-muted);">Keranjang Anda masih kosong.</p>
      <a href="{{ route('home') }}#produk" class="btn btn-primary" style="margin-top:16px;">Belanja Sekarang</a>
    </div>
  @else
    <div class="cart-grid">
      <div class="glass" style="padding:24px;border-radius:16px;">
        @foreach($cart as $item)
          <div style="display:flex;gap:16px;padding:16px 0;border-bottom:1px solid var(--glass-border);">
            <img src="{{ $item['image'] }}" style="width:80px;height:80px;border-radius:10px;object-fit:cover;">
            <div style="flex:1;">
              <div style="font-weight:700;">{{ $item['name'] }}</div>
              <div style="color:var(--text-muted);font-size:.88rem;">Rp {{ number_format($item['price'],0,',','.') }}</div>

              <form method="POST" action="{{ route('cart.update', $item['id']) }}" style="display:flex;align-items:center;gap:8px;margin-top:10px;">
                @csrf
                <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" style="width:70px;padding:6px;border-radius:6px;background:rgba(255,255,255,.05);border:1px solid var(--glass-border);color:var(--text-main);">
                <button type="submit" class="btn btn-outline btn-xs">Update</button>
              </form>

              <form method="POST" action="{{ route('cart.remove', $item['id']) }}" style="margin-top:6px;">
                @csrf
                <button type="submit" style="background:none;border:none;color:var(--red);font-size:.82rem;cursor:pointer;">
                  <i class="fa-solid fa-trash"></i> Hapus
                </button>
              </form>
            </div>
            <div style="font-weight:700;">Rp {{ number_format($item['price'] * $item['qty'],0,',','.') }}</div>
          </div>
        @endforeach
      </div>

      <div class="glass" style="padding:24px;border-radius:16px;height:fit-content;">
        <h3 style="margin-bottom:16px;">Ringkasan</h3>
        <div class="summary-row"><span>Total</span><span>Rp {{ number_format($total,0,',','.') }}</span></div>
        <div class="summary-row"><span>DP Minimal</span><span>Rp {{ number_format($dpAmount,0,',','.') }}</span></div>
        <a href="{{ route('checkout') }}" class="btn btn-primary btn-block" style="margin-top:16px;">
          Lanjut ke Checkout
        </a>
      </div>
    </div>
  @endif
</div>
@endsection