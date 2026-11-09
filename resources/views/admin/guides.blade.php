@extends('layouts.app')

@section('title', 'Buku Panduan - KREYASA')

@push('styles')
<style>
.admin-view{ position:fixed; inset:0; background:var(--black); z-index:900; display:flex; }
.admin-sidebar{ width:250px; background:var(--navy); border-right:1px solid var(--glass-border); padding:28px 20px; display:flex; flex-direction:column; }
.admin-sidebar .logo{ margin-bottom:36px; padding-left:8px; }
.admin-nav{ display:flex; flex-direction:column; gap:6px; flex:1; }
.admin-nav a{ display:flex; align-items:center; gap:12px; padding:12px 14px; border-radius:10px; color:var(--text-muted); font-size:.9rem; font-weight:500; }
.admin-nav a i{ width:18px; text-align:center; }
.admin-nav a:hover{ background:rgba(255,255,255,.05); color:var(--text-main); }
.admin-nav a.active{ background:linear-gradient(90deg,rgba(108,60,225,.25),rgba(139,92,246,.15)); color:#fff; border:1px solid rgba(139,92,246,.3); }
.admin-main{ flex:1; overflow-y:auto; }
.admin-topbar{ padding:22px 36px; border-bottom:1px solid var(--glass-border); display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; background:rgba(10,10,26,.9); backdrop-filter:blur(10px); z-index:5; }
.admin-topbar h2{ font-size:1.3rem; font-weight:800; }
.admin-content{ padding:32px 36px; }
.guide-card {
  display: flex; align-items: center; gap: 16px; padding: 20px;
  border-radius: 16px; margin-bottom: 16px;
}
.guide-icon { font-size: 2rem; width: 60px; text-align: center; }
</style>
@endpush

@section('content')
<div class="admin-view">
  <aside class="admin-sidebar">
    <div class="logo">KREYASA</div>
    <nav class="admin-nav">
      <a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
      <a href="{{ route('admin.orders') }}"><i class="fa-solid fa-receipt"></i><span>Kelola Pesanan</span></a>
      <a href="{{ route('admin.products') }}"><i class="fa-solid fa-box"></i><span>Kelola Produk</span></a>
      <a href="{{ route('admin.guides') }}" class="active"><i class="fa-solid fa-book"></i><span>Buku Panduan</span></a>
    </nav>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit" class="btn btn-outline btn-sm btn-block"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
    </form>
  </aside>

  <main class="admin-main">
    <div class="admin-topbar">
      <h2>Buku Panduan & Materi</h2>
    </div>
    <div class="admin-content">
      
      <div class="glass" style="padding:28px;border-radius:16px;max-width:700px;margin-bottom:24px;">
        <h3 style="margin-bottom:14px;">Panduan Penggunaan Aplikasi</h3>
        <p style="color:var(--text-muted);font-size:.9rem;margin-bottom:24px;line-height:1.6;">
          Setiap pesanan yang berstatus <b>Lunas & Selesai</b> otomatis memasuki masa <b>Bimbingan 1 Tahun</b>.
          Buku panduan digital (PDF) dikirimkan ke WhatsApp/email pelanggan bersamaan dengan produk akhir.
        </p>

        <div style="display:flex;flex-direction:column;gap:14px;">
          <div class="glass guide-card">
            <i class="fa-solid fa-file-pdf guide-icon" style="color:#EF4444;"></i>
            <div style="flex:1;">
              <div style="font-weight:700;font-size:.95rem;margin-bottom:4px;">Buku Panduan Umum KREYASA.pdf</div>
              <div style="color:var(--text-muted);font-size:.82rem;">Berisi cara penggunaan produk, bimbingan, & kontak admin.</div>
            </div>
            <button class="btn btn-outline btn-sm" onclick="alert('File dummy. Di produksi, sambungkan ke file PDF asli.')">Unduh</button>
          </div>

          <div class="glass guide-card">
            <i class="fa-solid fa-video guide-icon" style="color:#8B5CF6;"></i>
            <div style="flex:1;">
              <div style="font-weight:700;font-size:.95rem;margin-bottom:4px;">Video Tutorial Onboarding</div>
              <div style="color:var(--text-muted);font-size:.82rem;">Dikirim otomatis di awal masa bimbingan pelanggan.</div>
            </div>
            <button class="btn btn-outline btn-sm" onclick="alert('File dummy. Di produksi, sambungkan ke link YouTube/Drive.')">Lihat</button>
          </div>

          <div class="glass guide-card">
            <i class="fa-brands fa-whatsapp guide-icon" style="color:#22C55E;"></i>
            <div style="flex:1;">
              <div style="font-weight:700;font-size:.95rem;margin-bottom:4px;">Layanan Konsultasi 1 Tahun</div>
              <div style="color:var(--text-muted);font-size:.82rem;">Pelanggan bisa hubungi admin via WA selama masa garansi.</div>
            </div>
            <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-outline btn-sm">Chat Admin</a>
          </div>
        </div>
      </div>

    </div>
  </main>
</div>
@endsection