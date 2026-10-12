@extends('layouts.app')

@section('title', 'Dashboard Admin - KREYASA')

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
.stat-cards{ display:grid; grid-template-columns:repeat(4,1fr); gap:20px; margin-bottom:32px; }
.stat-card{ padding:22px; border-radius:var(--radius-md); }
.stat-card .sc-icon{ width:42px; height:42px; border-radius:10px; display:flex; align-items:center; justify-content:center; background:rgba(139,92,246,.15); color:var(--purple-light); margin-bottom:14px; }
.stat-card .sc-value{ font-size:1.5rem; font-weight:800; }
.stat-card .sc-label{ color:var(--text-muted); font-size:.82rem; margin-top:4px; }
.status-pill{ display:inline-block; padding:5px 12px; border-radius:999px; font-size:.72rem; font-weight:700; white-space:nowrap; }
@media (max-width:768px){
  .admin-sidebar{ width:74px; padding:20px 10px; }
  .admin-sidebar .logo{ font-size:0; }
  .admin-sidebar .logo::after{ content:"K"; font-size:1.4rem; }
  .admin-nav a span{ display:none; }
  .admin-content{ padding:22px 16px; }
  .stat-cards{ grid-template-columns:1fr 1fr; }
}
</style>
@endpush

@section('content')
<div class="admin-view">
  <aside class="admin-sidebar">
    <div class="logo">KREYASA</div>
    <nav class="admin-nav">
      <a href="{{ route('admin.dashboard') }}" class="active"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
      <a href="{{ route('admin.orders') }}"><i class="fa-solid fa-receipt"></i><span>Kelola Pesanan</span></a>
      <a href="{{ route('admin.products') }}"><i class="fa-solid fa-box"></i><span>Kelola Produk</span></a>
      <a href="#"><i class="fa-solid fa-book"></i><span>Buku Panduan</span></a>
    </nav>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit" class="btn btn-outline btn-sm btn-block">
        <i class="fa-solid fa-right-from-bracket"></i> Logout
      </button>
    </form>
  </aside>

  <main class="admin-main">
    <div class="admin-topbar">
      <h2>Dashboard</h2>
      <div style="color:var(--text-muted);font-size:.9rem;">
        Halo, <b style="color:var(--text-main);">{{ auth()->user()->name }}</b>
      </div>
    </div>
    <div class="admin-content">
      <div class="stat-cards">
        <div class="stat-card glass">
          <div class="sc-icon"><i class="fa-solid fa-receipt"></i></div>
          <div class="sc-value">{{ $totalOrders }}</div>
          <div class="sc-label">Total Pesanan</div>
        </div>
        <div class="stat-card glass">
          <div class="sc-icon"><i class="fa-solid fa-spinner"></i></div>
          <div class="sc-value">{{ $activeOrders }}</div>
          <div class="sc-label">Pesanan Aktif</div>
        </div>
        <div class="stat-card glass">
          <div class="sc-icon"><i class="fa-solid fa-sack-dollar"></i></div>
          <div class="sc-value" style="font-size:1.15rem;">Rp {{ number_format($revenue, 0, ',', '.') }}</div>
          <div class="sc-label">Pendapatan Diterima</div>
        </div>
        <div class="stat-card glass">
          <div class="sc-icon"><i class="fa-solid fa-user-shield"></i></div>
          <div class="sc-value">{{ $inGuidance }}</div>
          <div class="sc-label">Dalam Masa Bimbingan</div>
        </div>
      </div>

      <div class="glass" style="padding:24px;border-radius:16px;">
        <h3 style="margin-bottom:16px;font-size:1.05rem;">Pesanan Terbaru</h3>
        @forelse($recentOrders as $o)
          <div style="display:flex;justify-content:space-between;align-items:center;padding:12px 0;border-bottom:1px solid var(--glass-border);">
            <div>
              <div style="font-weight:600;font-size:.9rem;">{{ $o->order_code }} — {{ $o->customer_name }}</div>
              <div style="color:var(--text-muted);font-size:.8rem;">{{ $o->items->pluck('product_name')->join(', ') }}</div>
            </div>
            <span class="status-pill" style="background:rgba(139,92,246,.15);color:#8B5CF6;">{{ $o->status }}</span>
          </div>
        @empty
          <p style="color:var(--text-muted);">Belum ada pesanan.</p>
        @endforelse
      </div>
    </div>
  </main>
</div>
@endsection