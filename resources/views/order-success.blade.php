@extends('layouts.app')

@section('title', 'Pesanan Berhasil - KREYASA')

@php use SimpleSoftwareIO\QrCode\Facades\QrCode; @endphp

@section('content')
<div class="container" style="padding-top:140px;padding-bottom:80px;max-width:700px;">
  <div class="glass" style="padding:32px;border-radius:16px;text-align:center;">
    <div class="confirm-icon"><i class="fa-solid fa-check"></i></div>
    <h2 style="margin-bottom:8px;">Pesanan Berhasil Dibuat!</h2>
    <p style="color:var(--text-muted);margin-bottom:24px;">Silakan lakukan pembayaran sesuai nominal di bawah.</p>

    <div class="order-id-box">
      <div class="label">Nomor Pesanan</div>
      <div class="value">{{ $order->order_code }}</div>
    </div>

    <div class="summary-box" style="text-align:left;">
      <div class="summary-row"><span>Total Pesanan</span><span>Rp {{ number_format($order->total,0,',','.') }}</span></div>
      <div class="summary-row"><span>Metode</span><span>{{ $order->payment_type === 'dp' ? 'DP (Sebagian)' : 'Lunas (Penuh)' }}</span></div>
      <div class="summary-row total"><span>Bayar Sekarang</span><span>Rp {{ number_format($order->amount_paid,0,',','.') }}</span></div>
      @if($order->remaining > 0)
        <div class="summary-row"><span>Sisa Setelah Selesai</span><span>Rp {{ number_format($order->remaining,0,',','.') }}</span></div>
      @endif
    </div>

    {{-- ========== STATUS PEMBAYARAN (sudah upload) ========== --}}
    @if($order->payment_proof)
      <div style="text-align:left;padding:16px;border-radius:12px;background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.3);margin-bottom:20px;">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
          <i class="fa-solid fa-circle-check" style="color:var(--green);font-size:1.2rem;"></i>
          <b style="color:var(--green);">Bukti Pembayaran Terkirim</b>
        </div>
        <div style="font-size:.85rem;color:var(--text-muted);">
          Metode: <b style="color:var(--text-main);">{{ strtoupper($order->payment_method) }}</b><br>
          Dikirim: {{ $order->payment_uploaded_at->format('d M Y, H:i') }}<br>
          Status: <span style="color:var(--amber);">{{ $order->status }}</span>
        </div>
        <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti" style="width:100%;max-width:200px;margin-top:12px;border-radius:10px;">
      </div>
    @endif

    {{-- ========== METODE PEMBAYARAN (belum upload) ========== --}}
    @if(!$order->payment_proof)
      <div style="text-align:left;margin-bottom:20px;">
        <h3 style="font-size:1rem;margin-bottom:14px;">Pilih Metode Pembayaran</h3>

        <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:10px;">
          {{-- QRIS --}}
          <label class="pay-method-card" data-method="qris">
            <input type="radio" name="pm" value="qris">
            <div>
              <div style="font-weight:700;font-size:.9rem;">QRIS</div>
              <div style="color:var(--text-muted);font-size:.75rem;">Scan kode QR</div>
            </div>
            <i class="fa-solid fa-qrcode" style="color:var(--purple-light);font-size:1.4rem;"></i>
          </label>

          {{-- DANA --}}
          <label class="pay-method-card" data-method="dana">
            <input type="radio" name="pm" value="dana">
            <div>
              <div style="font-weight:700;font-size:.9rem;">DANA</div>
              <div style="color:var(--text-muted);font-size:.75rem;">E-wallet</div>
            </div>
            <i class="fa-solid fa-wallet" style="color:#118EEA;font-size:1.4rem;"></i>
          </label>

          {{-- GoPay --}}
          <label class="pay-method-card" data-method="gopay">
            <input type="radio" name="pm" value="gopay">
            <div>
              <div style="font-weight:700;font-size:.9rem;">GoPay</div>
              <div style="color:var(--text-muted);font-size:.75rem;">E-wallet</div>
            </div>
            <i class="fa-solid fa-wallet" style="color:#00AED6;font-size:1.4rem;"></i>
          </label>

          {{-- OVO --}}
          <label class="pay-method-card" data-method="ovo">
            <input type="radio" name="pm" value="ovo">
            <div>
              <div style="font-weight:700;font-size:.9rem;">OVO</div>
              <div style="color:var(--text-muted);font-size:.75rem;">E-wallet</div>
            </div>
            <i class="fa-solid fa-wallet" style="color:#4C3494;font-size:1.4rem;"></i>
          </label>

          {{-- BCA --}}
          <label class="pay-method-card" data-method="bca">
            <input type="radio" name="pm" value="bca">
            <div>
              <div style="font-weight:700;font-size:.9rem;">Transfer BCA</div>
              <div style="color:var(--text-muted);font-size:.75rem;">Bank transfer</div>
            </div>
            <i class="fa-solid fa-building-columns" style="color:#0057B8;font-size:1.4rem;"></i>
          </label>

          {{-- Mandiri --}}
          <label class="pay-method-card" data-method="mandiri">
            <input type="radio" name="pm" value="mandiri">
            <div>
              <div style="font-weight:700;font-size:.9rem;">Transfer Mandiri</div>
              <div style="color:var(--text-muted);font-size:.75rem;">Bank transfer</div>
            </div>
            <i class="fa-solid fa-building-columns" style="color:#F9A01B;font-size:1.4rem;"></i>
          </label>
        </div>

        {{-- ========== QRIS BOX (muncul kalau pilih QRIS) ========== --}}
        <div id="qrisBox" style="display:none;margin-top:20px;padding:24px;background:#fff;border-radius:12px;text-align:center;">
          <div style="color:#000;font-weight:700;margin-bottom:14px;font-size:.95rem;">Scan QRIS untuk Bayar</div>
          <div style="display:inline-block;background:#fff;padding:8px;">
            {!! QrCode::size(240)->margin(1)->generate($qrData) !!}
          </div>
          <div style="color:#000;font-size:.9rem;margin-top:14px;">
            Nominal: <b style="color:#0a0a1a;">Rp {{ number_format($order->amount_paid,0,',','.') }}</b>
          </div>
          <div style="color:#666;font-size:.75rem;margin-top:6px;">
            Scan dengan aplikasi bank atau e-wallet apapun
          </div>
        </div>

        {{-- ========== DETAIL METODE NON-QRIS ========== --}}
        <div id="paymentDetail" style="margin-top:20px;padding:16px;border-radius:12px;background:rgba(255,255,255,.04);border:1px dashed var(--glass-border);display:none;">
          <!-- Diisi oleh JS -->
        </div>

        {{-- ========== FORM UPLOAD BUKTI ========== --}}
        <form method="POST" action="{{ route('order.upload', $order->order_code) }}" enctype="multipart/form-data" style="margin-top:24px;">
          @csrf
          <input type="hidden" name="payment_method" id="methodInput" value="qris">

          <div class="form-group" style="text-align:left;">
            <label for="payment_proof">Upload Bukti Pembayaran (Screenshot)</label>
            <input type="file" name="payment_proof" id="payment_proof" accept="image/*" required
                   style="padding:10px;background:rgba(255,255,255,.05);border:1px solid var(--glass-border);border-radius:10px;color:var(--text-main);width:100%;">
            <div style="font-size:.75rem;color:var(--text-muted);margin-top:6px;">
              Format: JPG, PNG, WEBP. Maks 5MB.
            </div>
          </div>

          @error('payment_proof')
            <div class="form-error" style="display:block;text-align:left;">{{ $message }}</div>
          @enderror

          <button type="submit" class="btn btn-primary btn-block" style="margin-top:12px;">
            <i class="fa-solid fa-cloud-arrow-up"></i> Kirim Bukti Pembayaran
          </button>
        </form>
      </div>
    @endif

    <a href="https://wa.me/6281234567890?text={{ urlencode('Konfirmasi pesanan ' . $order->order_code) }}" target="_blank" class="btn btn-wa btn-block" style="margin-top:12px;">
      <i class="fa-brands fa-whatsapp"></i> Tanya Admin via WhatsApp
    </a>

    <a href="{{ route('home') }}" class="btn btn-outline btn-block" style="margin-top:12px;">
      Kembali ke Beranda
    </a>
  </div>
</div>

<style>
.pay-method-card{
  display:flex;align-items:center;justify-content:space-between;gap:12px;
  padding:14px 16px;border-radius:12px;border:1.5px solid var(--glass-border);
  cursor:pointer;background:rgba(255,255,255,.03);
  transition:border-color .3s,background .3s;
}
.pay-method-card input{ display:none; }
.pay-method-card:has(input:checked){
  border-color:var(--purple-light);
  background:rgba(139,92,246,.12);
}
</style>

<script>
document.querySelectorAll('.pay-method-card').forEach(card => {
  card.addEventListener('click', () => {
    const method = card.dataset.method;
    document.getElementById('methodInput').value = method;

    const detail = document.getElementById('paymentDetail');
    const qrisBox = document.getElementById('qrisBox');

    // Sembunyikan dua-duanya dulu
    detail.style.display = 'none';
    qrisBox.style.display = 'none';

    const details = {
      dana:    '<b>DANA</b><br>Kirim ke nomor <b>081234567890</b> a.n. KREYASA DIGITAL.',
      gopay:   '<b>GoPay</b><br>Kirim ke nomor <b>081234567890</b> a.n. KREYASA DIGITAL.',
      ovo:     '<b>OVO</b><br>Kirim ke nomor <b>081234567890</b> a.n. KREYASA DIGITAL.',
      bca:     '<b>Bank BCA</b><br>No. Rek <b>1234567890</b><br>a.n. KREYASA DIGITAL',
      mandiri: '<b>Bank Mandiri</b><br>No. Rek <b>1234567890</b><br>a.n. KREYASA DIGITAL',
    };

    if (method === 'qris') {
      qrisBox.style.display = 'block';
    } else {
      detail.innerHTML = details[method] || '';
      detail.style.display = 'block';
    }
  });
});

// Default: QRIS terpilih saat halaman dibuka
document.querySelector('.pay-method-card[data-method="qris"]').click();
</script>
@endsection