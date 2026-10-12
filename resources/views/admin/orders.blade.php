@extends('layouts.app')

@section('title', 'Kelola Pesanan - KREYASA')

@push('styles')
<style>
.admin-view{ position:fixed; inset:0; background:var(--black); z-index:900; display:flex; }
.admin-sidebar{ width:250px; background:var(--navy); border-right:1px solid var(--glass-border); padding:28px 20px; display:flex; flex-direction:column; }
.admin-sidebar .logo{ margin-bottom:36px; padding-left:8px; }
.admin-nav{ display:flex; flex-direction:column; gap:6px; flex:1; }
.admin-nav a{ display:flex; align-items:center; gap:12px; padding:12px 14px; border-radius:10px; color:var(--text-muted); font-size:.9rem; font-weight:500; transition:background .3s,color .3s; }
.admin-nav a i{ width:18px; text-align:center; }
.admin-nav a:hover{ background:rgba(255,255,255,.05); color:var(--text-main); }
.admin-nav a.active{ background:linear-gradient(90deg,rgba(108,60,225,.25),rgba(139,92,246,.15)); color:#fff; border:1px solid rgba(139,92,246,.3); }
.admin-main{ flex:1; overflow-y:auto; }
.admin-topbar{ padding:22px 36px; border-bottom:1px solid var(--glass-border); display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; background:rgba(10,10,26,.9); backdrop-filter:blur(10px); z-index:5; }
.admin-topbar h2{ font-size:1.3rem; font-weight:800; }
.admin-content{ padding:32px 36px; }
.admin-table-wrap{ overflow-x:auto; border-radius:var(--radius-md); }
table.admin-table{ width:100%; border-collapse:collapse; min-width:1100px; }
table.admin-table th{ text-align:left; font-size:.75rem; text-transform:uppercase; letter-spacing:.5px; color:var(--text-muted); padding:14px 16px; border-bottom:1px solid var(--glass-border); background:rgba(255,255,255,.03); }
table.admin-table td{ padding:14px 16px; border-bottom:1px solid var(--glass-border); font-size:.87rem; vertical-align:top; }
.status-select{ padding:8px 10px; border-radius:8px; background:rgba(255,255,255,.05); border:1px solid var(--glass-border); color:var(--text-main); font-size:.8rem; }
.pay-tag{ font-size:.72rem; font-weight:700; padding:4px 10px; border-radius:999px; }
.pay-tag.dp{ background:rgba(251,191,36,.15); color:var(--amber); }
.pay-tag.lunas{ background:rgba(34,197,94,.15); color:var(--green); }
.btn-danger{ background:rgba(239,68,68,.15); color:#FCA5A5; border:1px solid rgba(239,68,68,.4); cursor:pointer; padding:7px 14px; border-radius:8px; font-size:.78rem; }
.btn-danger:hover{ background:rgba(239,68,68,.25); }
.proof-thumb{ width:60px;height:60px;object-fit:cover;border-radius:8px;cursor:pointer;border:1px solid var(--glass-border); }
.proof-thumb:hover{ opacity:.85; }
</style>
@endpush

@section('content')
<div class="admin-view">
  <aside class="admin-sidebar">
    <div class="logo">KREYASA</div>
    <nav class="admin-nav">
      <a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
      <a href="{{ route('admin.orders') }}" class="active"><i class="fa-solid fa-receipt"></i><span>Kelola Pesanan</span></a>
      <a href="{{ route('admin.products') }}"><i class="fa-solid fa-box"></i><span>Kelola Produk</span></a>
      <a href="#"><i class="fa-solid fa-book"></i><span>Buku Panduan</span></a>
    </nav>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit" class="btn btn-outline btn-sm btn-block"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
    </form>
  </aside>

  <main class="admin-main">
    <div class="admin-topbar">
      <h2>Kelola Pesanan</h2>
      <div style="color:var(--text-muted);font-size:.9rem;">
        Total: <b style="color:var(--text-main);">{{ $orders->count() }}</b> pesanan
      </div>
    </div>
    <div class="admin-content">
      @if($orders->isEmpty())
        <div class="glass" style="text-align:center;padding:60px 20px;border-radius:16px;color:var(--text-muted);">
          <i class="fa-solid fa-inbox" style="font-size:2.4rem;margin-bottom:14px;opacity:.4;"></i>
          <p>Belum ada pesanan masuk.</p>
        </div>
      @else
        <div class="admin-table-wrap glass">
          <table class="admin-table">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Produk</th>
                <th>Total</th>
                <th>Pembayaran</th>
                <th>Bukti</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $o)
                <tr>
                  <td><b>{{ $o->order_code }}</b></td>
                  <td>{{ $o->created_at->format('d M Y') }}</td>
                  <td>
                    {{ $o->customer_name }}<br>
                    <span style="color:var(--text-muted);font-size:.78rem;">{{ $o->customer_wa }}</span>
                  </td>
                  <td>{!! $o->items->map(fn($i) => e($i->product_name) . ' x' . $i->qty)->join('<br>') !!}</td>
                  <td>
                    Rp {{ number_format($o->total, 0, ',', '.') }}
                    @if($o->remaining > 0)
                      <br><span style="color:var(--text-muted);font-size:.75rem;">Sisa: Rp {{ number_format($o->remaining, 0, ',', '.') }}</span>
                    @endif
                  </td>
                  <td>
                    <span class="pay-tag {{ $o->payment_type }}">{{ $o->payment_type === 'dp' ? 'DP' : 'Lunas' }}</span>
                    @if($o->payment_method)
                      <div style="font-size:.72rem;color:var(--text-muted);margin-top:4px;">{{ strtoupper($o->payment_method) }}</div>
                    @endif
                  </td>

                  {{-- KOLOM BUKTI PEMBAYARAN --}}
                  <td>
                    @if($o->payment_proof)
                      <a href="{{ asset('storage/' . $o->payment_proof) }}" target="_blank">
                        <img src="{{ asset('storage/' . $o->payment_proof) }}" class="proof-thumb" alt="Bukti">
                      </a>
                      <div style="font-size:.7rem;color:var(--text-muted);margin-top:4px;">
                        {{ $o->payment_uploaded_at ? $o->payment_uploaded_at->format('d/m H:i') : '' }}
                      </div>
                    @else
                      <span style="color:var(--text-muted);font-size:.8rem;">Belum ada</span>
                    @endif
                  </td>

                  {{-- STATUS --}}
                  <td>
                    <form method="POST" action="{{ route('admin.orders.status', $o->id) }}">
                      @csrf
                      <select name="status" class="status-select" onchange="this.form.submit()">
                        @foreach(['Menunggu Verifikasi Pembayaran','Dikerjakan','Menunggu Pelunasan','Lunas & Selesai','Masa Bimbingan','Bimbingan Selesai'] as $s)
                          <option value="{{ $s }}" @selected($s === $o->status)>{{ $s }}</option>
                        @endforeach
                      </select>
                    </form>
                  </td>

                  {{-- AKSI --}}
                  <td>
                    <form method="POST" action="{{ route('admin.orders.destroy', $o->id) }}" onsubmit="return confirm('Hapus pesanan {{ $o->order_code }}?')">
                      @csrf
                      <button type="submit" class="btn-danger"><i class="fa-solid fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </main>
</div>
@endsection