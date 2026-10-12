@extends('layouts.app')

@section('title', 'Kelola Produk - KREYASA')

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

/* Card produk */
.product-admin-card{
  display:grid;
  grid-template-columns:120px 1fr auto;
  gap:20px;
  align-items:start;
  padding:20px;
  border-radius:16px;
  margin-bottom:16px;
}
.product-admin-card img{
  width:120px; height:120px; object-fit:cover; border-radius:12px;
  background:rgba(255,255,255,.05);
}
.form-row{ display:grid; grid-template-columns:2fr 1fr 1fr; gap:12px; margin-bottom:12px; }
.form-row-2{ display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:12px; }
.mini-label{ font-size:.72rem; color:var(--text-muted); margin-bottom:4px; display:block; }
.mini-input{ width:100%; padding:8px 10px; border-radius:8px; background:rgba(255,255,255,.05); border:1px solid var(--glass-border); color:var(--text-main); font-size:.85rem; font-family:inherit; }
.mini-input:focus{ outline:none; border-color:var(--purple-light); }
.file-input{ font-size:.78rem; color:var(--text-muted); }
.file-input::file-selector-button{
  background:rgba(139,92,246,.15); color:var(--purple-light); border:1px solid rgba(139,92,246,.3);
  padding:6px 12px; border-radius:6px; cursor:pointer; font-size:.78rem; font-weight:600; margin-right:10px;
}
.btn-danger{ background:rgba(239,68,68,.15); color:#FCA5A5; border:1px solid rgba(239,68,68,.4); cursor:pointer; padding:8px 14px; border-radius:8px; font-size:.78rem; }
.btn-danger:hover{ background:rgba(239,68,68,.25); }
.btn-icon{ padding:8px 14px; font-size:.78rem; }

/* Form tambah */
.add-form-box{
  padding:24px;
  border-radius:16px;
  margin-bottom:24px;
  background:rgba(139,92,246,.06);
  border:1px dashed rgba(139,92,246,.3);
}
.add-form-box h3{ font-size:1rem; margin-bottom:16px; display:flex; align-items:center; gap:8px; }
</style>
@endpush

@section('content')
<div class="admin-view">
  <aside class="admin-sidebar">
    <div class="logo">KREYASA</div>
    <nav class="admin-nav">
      <a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
      <a href="{{ route('admin.orders') }}"><i class="fa-solid fa-receipt"></i><span>Kelola Pesanan</span></a>
      <a href="{{ route('admin.products') }}" class="active"><i class="fa-solid fa-box"></i><span>Kelola Produk</span></a>
      <a href="#"><i class="fa-solid fa-book"></i><span>Buku Panduan</span></a>
    </nav>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit" class="btn btn-outline btn-sm btn-block"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
    </form>
  </aside>

  <main class="admin-main">
    <div class="admin-topbar">
      <h2>Kelola Produk</h2>
      <div style="color:var(--text-muted);font-size:.9rem;">
        Total: <b style="color:var(--text-main);">{{ $products->count() }}</b> produk
      </div>
    </div>

    <div class="admin-content">

      {{-- Flash message --}}
      @if(session('success'))
        <div class="flash-message" style="position:static;margin-bottom:20px;transform:none;">
          <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
      @endif

      {{-- ==================== FORM TAMBAH PRODUK ==================== --}}
      <div class="add-form-box">
        <h3><i class="fa-solid fa-plus-circle" style="color:var(--purple-light);"></i> Tambah Produk Baru</h3>

        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
          @csrf

          <div class="form-row-2">
            <div>
              <label class="mini-label">Nama Produk *</label>
              <input type="text" name="name" class="mini-input" placeholder="Contoh: Paket Modul Ajar" required>
            </div>
            <div>
              <label class="mini-label">Kategori *</label>
              <input type="text" name="category" class="mini-input" placeholder="Contoh: Design Pendidikan" required>
            </div>
          </div>

          <div style="margin-bottom:12px;">
            <label class="mini-label">Deskripsi</label>
            <textarea name="description" class="mini-input" rows="2" placeholder="Deskripsi singkat produk..."></textarea>
          </div>

          <div class="form-row">
            <div>
              <label class="mini-label">Harga (Rp) *</label>
              <input type="number" name="price" class="mini-input" placeholder="500000" min="0" required>
            </div>
            <div>
              <label class="mini-label">DP (%) *</label>
              <input type="number" name="dp_percent" class="mini-input" value="50" min="10" max="100" required>
            </div>
            <div>
              <label class="mini-label">Badge</label>
              <input type="text" name="badge" class="mini-input" placeholder="Ready / Custom" value="Ready">
            </div>
          </div>

          <div style="margin-bottom:16px;">
            <label class="mini-label">Foto Produk</label>
            <input type="file" name="image" class="mini-input file-input" accept="image/*">
            <div style="font-size:.72rem;color:var(--text-muted);margin-top:4px;">
              Format: JPG, PNG, WEBP. Maks 5MB. Kalau kosong, akan pakai placeholder otomatis.
            </div>
          </div>

          <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-plus"></i> Tambah Produk
          </button>
        </form>
      </div>

      {{-- ==================== DAFTAR PRODUK ==================== --}}
      <h3 style="font-size:1rem;margin-bottom:16px;">Daftar Produk ({{ $products->count() }})</h3>

      @forelse($products as $p)
        <div class="product-admin-card glass">
          <img src="{{ $p->image }}" alt="{{ $p->name }}">

          <form method="POST" action="{{ route('admin.products.update', $p->id) }}" enctype="multipart/form-data" id="form-{{ $p->id }}">
            @csrf

            <div class="form-row-2">
              <div>
                <label class="mini-label">Nama</label>
                <input type="text" name="name" class="mini-input" value="{{ $p->name }}" required>
              </div>
              <div>
                <label class="mini-label">Kategori</label>
                <input type="text" name="category" class="mini-input" value="{{ $p->category }}" required>
              </div>
            </div>

            <div style="margin-bottom:12px;">
              <label class="mini-label">Deskripsi</label>
              <textarea name="description" class="mini-input" rows="2">{{ $p->description }}</textarea>
            </div>

            <div class="form-row">
              <div>
                <label class="mini-label">Harga (Rp)</label>
                <input type="number" name="price" class="mini-input" value="{{ $p->price }}" min="0" required>
              </div>
              <div>
                <label class="mini-label">DP (%)</label>
                <input type="number" name="dp_percent" class="mini-input" value="{{ $p->dp_percent }}" min="10" max="100" required>
              </div>
              <div>
                <label class="mini-label">Badge</label>
                <input type="text" name="badge" class="mini-input" value="{{ $p->badge }}">
              </div>
            </div>

            <div style="margin-bottom:12px;">
              <label class="mini-label">Ganti Foto (opsional)</label>
              <input type="file" name="image" class="mini-input file-input" accept="image/*">
              <div style="font-size:.72rem;color:var(--text-muted);margin-top:4px;">
                Biarkan kosong jika tidak mau ganti foto.
              </div>
            </div>
          </form>

          <div style="display:flex;flex-direction:column;gap:8px;">
            <button type="submit" form="form-{{ $p->id }}" class="btn btn-primary btn-icon">
              <i class="fa-solid fa-save"></i> Simpan
            </button>

            <form method="POST" action="{{ route('admin.products.destroy', $p->id) }}" onsubmit="return confirm('Hapus produk {{ $p->name }}?')">
              @csrf
              <button type="submit" class="btn-danger" style="width:100%;">
                <i class="fa-solid fa-trash"></i> Hapus
              </button>
            </form>
          </div>
        </div>
      @empty
        <div class="glass" style="text-align:center;padding:60px 20px;border-radius:16px;color:var(--text-muted);">
          <i class="fa-solid fa-box-open" style="font-size:2.4rem;margin-bottom:14px;opacity:.4;"></i>
          <p>Belum ada produk. Tambahkan produk pertama di atas!</p>
        </div>
      @endforelse

    </div>
  </main>
</div>
@endsection