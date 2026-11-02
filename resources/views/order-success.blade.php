@extends('layouts.app')

@section('title', 'Pesanan Berhasil - KREYASA')

@php use SimpleSoftwareIO\QrCode\Facades\QrCode; @endphp

@section('content')
  <div class="max-w-2xl mx-auto px-6 pt-32 pb-20 min-h-screen">

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 md:p-10 shadow-xl shadow-indigo-500/5 text-center">

      <div class="w-20 h-20 mx-auto rounded-full bg-emerald-50 dark:bg-emerald-950/30 flex items-center justify-center text-emerald-500 mb-6">
        <i class="fa-solid fa-check text-3xl"></i>
      </div>

      <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Pesanan Berhasil Dibuat!</h2>
      <p class="text-slate-500 dark:text-slate-400 mb-8">Silakan lakukan pembayaran sesuai nominal di bawah ini.</p>

      <div class="bg-indigo-50 dark:bg-indigo-950/20 border border-indigo-100 dark:border-indigo-900/30 rounded-2xl p-6 mb-6">
        <div class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 mb-1">Nomor Pesanan</div>
        <div class="text-2xl font-black text-slate-900 dark:text-white tracking-widest">{{ $order->order_code }}</div>
      </div>

      <div class="bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 text-left mb-8">
        <div class="space-y-3 text-sm">
          <div class="flex justify-between text-slate-600 dark:text-slate-400">
            <span>Total Pesanan</span>
            <span class="font-medium text-slate-900 dark:text-white">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
          </div>
          <div class="flex justify-between text-slate-600 dark:text-slate-400">
            <span>Metode</span>
            <span class="font-medium text-slate-900 dark:text-white">{{ $order->payment_type === 'dp' ? 'DP (Sebagian)' : 'Lunas (Penuh)' }}</span>
          </div>
          <div class="pt-3 border-t border-slate-200 dark:border-slate-800 flex justify-between items-center">
            <span class="font-bold text-slate-900 dark:text-white">Bayar Sekarang</span>
            <span class="font-bold text-lg text-indigo-600 dark:text-indigo-400">Rp {{ number_format($order->amount_paid, 0, ',', '.') }}</span>
          </div>
          @if($order->remaining > 0)
            <div class="flex justify-between text-amber-600 dark:text-amber-400 pt-2">
              <span>Sisa Setelah Selesai</span>
              <span class="font-medium">Rp {{ number_format($order->remaining, 0, ',', '.') }}</span>
            </div>
          @endif
        </div>
      </div>

      @if($order->payment_proof)
        <div class="text-left p-6 rounded-2xl bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-200 dark:border-emerald-900/30 mb-8">
          <div class="flex items-center gap-3 mb-3">
            <i class="fa-solid fa-circle-check text-emerald-500 text-xl"></i>
            <b class="text-emerald-600 dark:text-emerald-400">Bukti Pembayaran Terkirim</b>
          </div>
          <div class="text-sm text-slate-600 dark:text-slate-400 space-y-1.5">
            <div>Metode: <b class="text-slate-900 dark:text-white">{{ strtoupper($order->payment_method) }}</b></div>
            <div>Dikirim: {{ $order->payment_uploaded_at->format('d M Y, H:i') }}</div>
            <div>Status: <span class="text-amber-500 font-semibold">{{ $order->status }}</span></div>
          </div>
          
          <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="block mt-4 max-w-[200px]">
            <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti" class="w-full h-48 object-cover object-top rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm hover:opacity-80 transition-opacity cursor-pointer">
          </a>
        </div>
      @endif

      @if(!$order->payment_proof)
        <div class="text-left mb-8">
          <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Pilih Metode Pembayaran</h3>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6">
            <label class="pay-method-card flex items-center justify-between gap-3 p-4 rounded-xl border border-slate-200 dark:border-slate-700 cursor-pointer hover:border-indigo-300 dark:hover:border-indigo-700 transition-colors" data-method="qris">
              <input type="radio" name="pm" value="qris" class="hidden">
              <div>
                <div class="font-bold text-slate-900 dark:text-white text-sm">QRIS</div>
                <div class="text-xs text-slate-500 dark:text-slate-400">Scan kode QR</div>
              </div>
              <i class="fa-solid fa-qrcode text-indigo-500 text-2xl"></i>
            </label>

            <label class="pay-method-card flex items-center justify-between gap-3 p-4 rounded-xl border border-slate-200 dark:border-slate-700 cursor-pointer hover:border-indigo-300 dark:hover:border-indigo-700 transition-colors" data-method="dana">
              <input type="radio" name="pm" value="dana" class="hidden">
              <div>
                <div class="font-bold text-slate-900 dark:text-white text-sm">DANA</div>
                <div class="text-xs text-slate-500 dark:text-slate-400">E-wallet</div>
              </div>
              <i class="fa-solid fa-wallet text-blue-500 text-2xl"></i>
            </label>

            <label class="pay-method-card flex items-center justify-between gap-3 p-4 rounded-xl border border-slate-200 dark:border-slate-700 cursor-pointer hover:border-indigo-300 dark:hover:border-indigo-700 transition-colors" data-method="gopay">
              <input type="radio" name="pm" value="gopay" class="hidden">
              <div>
                <div class="font-bold text-slate-900 dark:text-white text-sm">GoPay</div>
                <div class="text-xs text-slate-500 dark:text-slate-400">E-wallet</div>
              </div>
              <i class="fa-solid fa-wallet text-cyan-500 text-2xl"></i>
            </label>

            <label class="pay-method-card flex items-center justify-between gap-3 p-4 rounded-xl border border-slate-200 dark:border-slate-700 cursor-pointer hover:border-indigo-300 dark:hover:border-indigo-700 transition-colors" data-method="ovo">
              <input type="radio" name="pm" value="ovo" class="hidden">
              <div>
                <div class="font-bold text-slate-900 dark:text-white text-sm">OVO</div>
                <div class="text-xs text-slate-500 dark:text-slate-400">E-wallet</div>
              </div>
              <i class="fa-solid fa-wallet text-purple-600 text-2xl"></i>
            </label>

            <label class="pay-method-card flex items-center justify-between gap-3 p-4 rounded-xl border border-slate-200 dark:border-slate-700 cursor-pointer hover:border-indigo-300 dark:hover:border-indigo-700 transition-colors" data-method="bca">
              <input type="radio" name="pm" value="bca" class="hidden">
              <div>
                <div class="font-bold text-slate-900 dark:text-white text-sm">Transfer BCA</div>
                <div class="text-xs text-slate-500 dark:text-slate-400">Bank transfer</div>
              </div>
              <i class="fa-solid fa-building-columns text-blue-800 text-2xl"></i>
            </label>

            <label class="pay-method-card flex items-center justify-between gap-3 p-4 rounded-xl border border-slate-200 dark:border-slate-700 cursor-pointer hover:border-indigo-300 dark:hover:border-indigo-700 transition-colors" data-method="mandiri">
              <input type="radio" name="pm" value="mandiri" class="hidden">
              <div>
                <div class="font-bold text-slate-900 dark:text-white text-sm">Transfer Mandiri</div>
                <div class="text-xs text-slate-500 dark:text-slate-400">Bank transfer</div>
              </div>
              <i class="fa-solid fa-building-columns text-yellow-500 text-2xl"></i>
            </label>
          </div>

          <div id="qrisBox" class="hidden mt-6 p-6 bg-white border border-slate-200 rounded-2xl text-center shadow-sm">
            <div class="text-slate-900 font-bold mb-4 text-sm">Scan QRIS untuk Bayar</div>
            <div class="inline-block bg-white p-2 rounded-xl border border-slate-100">
              {!! QrCode::size(240)->margin(1)->generate($qrData) !!}
            </div>
            <div class="text-slate-900 text-sm mt-4 font-medium">
              Nominal: <b class="text-black">Rp {{ number_format($order->amount_paid, 0, ',', '.') }}</b>
            </div>
            <div class="text-slate-500 text-xs mt-2">Scan dengan aplikasi bank atau e-wallet apapun</div>
          </div>

          <div id="paymentDetail" class="hidden mt-6 p-5 rounded-xl bg-slate-50 dark:bg-slate-950 border border-dashed border-slate-300 dark:border-slate-700 text-sm text-slate-700 dark:text-slate-300"></div>

          <form method="POST" action="{{ route('order.upload', $order->order_code) }}" enctype="multipart/form-data" class="mt-8 space-y-4">
            @csrf
            <input type="hidden" name="payment_method" id="methodInput" value="qris">

            <div>
              <label for="payment_proof" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Upload Bukti Pembayaran (Screenshot)</label>
              <input type="file" name="payment_proof" id="payment_proof" accept="image/*" required class="w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-950/50 dark:file:text-indigo-400 transition-all border border-slate-200 dark:border-slate-700 rounded-xl bg-white dark:bg-slate-900 cursor-pointer">
              <div class="text-xs text-slate-500 mt-2">Format: JPG, PNG, WEBP. Maks 5MB.</div>
            </div>

            @error('payment_proof')
              <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror

            <button type="submit" class="w-full flex items-center justify-center gap-2 py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold transition-colors shadow-lg shadow-indigo-500/30">
              <i class="fa-solid fa-cloud-arrow-up"></i> Kirim Bukti Pembayaran
            </button>
          </form>
        </div>
      @endif

      <div class="space-y-3 mt-8">
        <a href="https://wa.me/6281234567890?text={{ urlencode('Konfirmasi pesanan ' . $order->order_code) }}" target="_blank" class="w-full flex items-center justify-center gap-2 py-3.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold transition-colors">
          <i class="fa-brands fa-whatsapp text-lg"></i> Tanya Admin via WhatsApp
        </a>

        <a href="{{ route('home') }}" class="w-full flex items-center justify-center py-3.5 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-semibold hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
          Kembali ke Beranda
        </a>
      </div>

    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const cards = document.querySelectorAll('.pay-method-card');
      const detail = document.getElementById('paymentDetail');
      const qrisBox = document.getElementById('qrisBox');
      const methodInput = document.getElementById('methodInput');

      const details = {
        dana: '<div class="font-bold text-slate-900 dark:text-white mb-1">DANA</div><div>Kirim ke nomor <b>081234567890</b> a.n. KREYASA DIGITAL.</div>',
        gopay: '<div class="font-bold text-slate-900 dark:text-white mb-1">GoPay</div><div>Kirim ke nomor <b>081234567890</b> a.n. KREYASA DIGITAL.</div>',
        ovo: '<div class="font-bold text-slate-900 dark:text-white mb-1">OVO</div><div>Kirim ke nomor <b>081234567890</b> a.n. KREYASA DIGITAL.</div>',
        bca: '<div class="font-bold text-slate-900 dark:text-white mb-1">Bank BCA</div><div>No. Rek <b>1234567890</b><br>a.n. KREYASA DIGITAL</div>',
        mandiri: '<div class="font-bold text-slate-900 dark:text-white mb-1">Bank Mandiri</div><div>No. Rek <b>1234567890</b><br>a.n. KREYASA DIGITAL</div>',
      };

      function selectMethod(method) {
        methodInput.value = method;

        cards.forEach(c => {
          c.classList.remove('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-950/20');
          c.classList.add('border-slate-200', 'dark:border-slate-700');
        });

        const activeCard = document.querySelector(`.pay-method-card[data-method="${method}"]`);
        if (activeCard) {
          activeCard.classList.remove('border-slate-200', 'dark:border-slate-700');
          activeCard.classList.add('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-950/20');
        }

        if (method === 'qris') {
          qrisBox.classList.remove('hidden');
          detail.classList.add('hidden');
        } else {
          qrisBox.classList.add('hidden');
          detail.innerHTML = details[method] || '';
          detail.classList.remove('hidden');
        }
      }

      cards.forEach(card => {
        card.addEventListener('click', function (e) {
          e.preventDefault();
          selectMethod(this.dataset.method);
        });
      });

      selectMethod('qris');
    });
  </script>
@endsection