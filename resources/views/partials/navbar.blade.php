<nav class="navbar" id="navbar">
  <div class="container">
    <a href="#beranda" class="logo">KREYASA</a>
    <ul class="nav-menu">
      <li><a href="#beranda">Beranda</a></li>
      <li><a href="#produk">Produk</a></li>
      <li><a href="#custom-request">Custom Request</a></li>
      <li><a href="#kontak">Kontak</a></li>
    </ul>
    <div class="nav-actions">
      <a href="{{ route('cart.index') }}" class="icon-btn" aria-label="Keranjang">
        <i class="fa-solid fa-cart-shopping"></i>
        @php $cartCount = collect(session('cart', []))->sum('qty'); @endphp
        @if($cartCount > 0)
          <span class="cart-count">{{ $cartCount }}</span>
        @endif
      </a>
      <a href="{{ route('admin.login') }}" class="btn btn-outline btn-sm">Login Admin</a>
      <button class="hamburger" id="hamburgerBtn" aria-label="Buka menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</nav>

<div class="mobile-menu" id="mobileMenu">
  <a href="#beranda">Beranda</a>
  <a href="#produk">Produk</a>
  <a href="#custom-request">Custom Request</a>
  <a href="#kontak">Kontak</a>
  <a href="{{ route('admin.login') }}" class="btn btn-outline">Login Admin</a>
</div>