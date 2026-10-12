@extends('layouts.app')

@section('title', 'Checkout - KREYASA')

@section('content')
<div class="container" style="padding-top:140px;padding-bottom:80px;max-width:800px;">
  <h1 style="font-size:1.8rem;font-weight:800;margin-bottom:32px;">Checkout</h1>

  <div class="glass" style="padding:24px;border-radius:16px;margin-bottom:24px;">
    <h3 style="margin-bottom:12px;font-size:1rem;">Ringkasan Pesanan</h3>
    @foreach($cart as $item)
      <div class="summary-row">
        <span>{{ $item['name'] }} x{{ $item['qty'] }}</span>
        <span>Rp {{ number_format($item['price'] * $item['qty'],0,',','.') }}</span>
      </div>
    @endforeach
    <div class="summary-row total">
      <span>Total</span>
      <span>Rp {{ number_format($total,0,',','.') }}</span>
    </div>
  </div>

  <form method="POST" action="{{ route('checkout.store') }}" class="glass" style="padding:24px;border-radius:16px;">
    @csrf

    <div class="form-group">
      <label>Nama Lengkap</label>
      <input type="text" name="customer_name" value="{{ old('customer_name') }}" required>
      @error('customer_name') <div class="form-error" style="display:block;">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
      <label>Nomor WhatsApp</label>
      <input type="tel" name="customer_wa" value="{{ old('customer_wa') }}" placeholder="08xxxxxxxxxx" required>
      @error('customer_wa') <div class="form-error" style="display:block;">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
      <label>Catatan (opsional)</label>
      <textarea name="note">{{ old('note') }}</textarea>
    </div>

    <label style="display:block;font-size:.85rem;font-weight:600;margin-bottom:10px;">Metode Pembayaran</label>
    <div class="pay-options">
      <label class="pay-option selected">
        <input type="radio" name="payment_type" value="dp" checked>
        <div class="pay-option-text">
          <div class="pay-option-title">Bayar DP Dulu</div>
          <div class="pay-option-desc">Bayar sebagian sekarang, sisanya setelah produk selesai.</div>
        </div>
        <div class="pay-option-amount">Rp {{ number_format($dpAmount,0,',','.') }}</div>
      </label>
      <label class="pay-option">
        <input type="radio" name="payment_type" value="lunas">
        <div class="pay-option-text">
          <div class="pay-option-title">Bayar Lunas</div>
          <div class="pay-option-desc">Bayar penuh di awal, proses langsung dimulai.</div>
        </div>
        <div class="pay-option-amount">Rp {{ number_format($total,0,',','.') }}</div>
      </label>
    </div>

    <button type="submit" class="btn btn-primary btn-block" style="margin-top:20px;">
      Buat Pesanan
    </button>
  </form>
</div>
@endsection