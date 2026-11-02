<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 py-4 bg-transparent">
  <div class="max-w-6xl mx-auto px-6 flex items-center justify-between">

    <a href="#beranda" class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 tracking-tight">KREYASA</a>

    <ul class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600 dark:text-slate-300">
      <li><a href="#beranda" class="hover:text-indigo-600 dark:hover:text-white transition-colors">Beranda</a></li>
      <li><a href="#produk" class="hover:text-indigo-600 dark:hover:text-white transition-colors">Produk</a></li>
      <li><a href="#custom-request" class="hover:text-indigo-600 dark:hover:text-white transition-colors">Custom
          Request</a></li>
      <li><a href="#kontak" class="hover:text-indigo-600 dark:hover:text-white transition-colors">Kontak</a></li>
    </ul>

    <div class="flex items-center gap-3">
      <a href="{{ route('cart.index') }}"
        class="relative w-10 h-10 flex items-center justify-center rounded-full bg-white/50 dark:bg-slate-800/50 backdrop-blur border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
        aria-label="Keranjang">
        <i class="fa-solid fa-cart-shopping text-lg"></i>
        @php $cartCount = collect(session('cart', []))->sum('qty'); @endphp
        @if($cartCount > 0)
          <span
            class="absolute -top-1 -right-1 bg-indigo-600 text-white text-[10px] font-bold min-w-[18px] h-[18px] flex items-center justify-center rounded-full px-1">{{ $cartCount }}</span>
        @endif
      </a>

      <a href="{{ route('admin.login') }}"
        class="hidden md:inline-flex px-5 py-2 rounded-full border border-indigo-600 text-indigo-600 dark:border-indigo-400 dark:text-indigo-400 text-sm font-semibold hover:bg-indigo-50 dark:hover:bg-indigo-950/50 transition-colors">
        Login Admin
      </a>

      <button id="hamburgerBtn" class="md:hidden flex flex-col gap-1.5 p-2 text-slate-900 dark:text-white"
        aria-label="Buka menu">
        <span class="w-6 h-0.5 bg-current rounded-full"></span>
        <span class="w-6 h-0.5 bg-current rounded-full"></span>
        <span class="w-6 h-0.5 bg-current rounded-full"></span>
      </button>
    </div>
  </div>
</nav>

<div id="mobileMenu"
  class="fixed inset-0 z-[60] bg-slate-900/95 backdrop-blur-md hidden flex-col items-center justify-center gap-8 text-lg font-bold text-white transition-all duration-300">
  <button id="closeMenuBtn" class="absolute top-6 right-6 text-3xl text-slate-400 hover:text-white">&times;</button>
  <a href="#beranda" class="hover:text-indigo-400 menu-link">Beranda</a>
  <a href="#produk" class="hover:text-indigo-400 menu-link">Produk</a>
  <a href="#custom-request" class="hover:text-indigo-400 menu-link">Custom Request</a>
  <a href="#kontak" class="hover:text-indigo-400 menu-link">Kontak</a>
  <a href="{{ route('admin.login') }}"
    class="mt-4 px-8 py-3 rounded-full border-2 border-indigo-500 text-indigo-400 hover:bg-indigo-500 hover:text-white transition-colors">Login
    Admin</a>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.getElementById('navbar');

    window.addEventListener('scroll', function () {
      if (window.scrollY > 20) {
        navbar.classList.remove('bg-transparent', 'py-4');
        navbar.classList.add('bg-white/90', 'dark:bg-slate-950/90', 'backdrop-blur-md', 'shadow-sm', 'py-3', 'border-b', 'border-slate-200', 'dark:border-slate-800');
      } else {
        navbar.classList.add('bg-transparent', 'py-4');
        navbar.classList.remove('bg-white/90', 'dark:bg-slate-950/90', 'backdrop-blur-md', 'shadow-sm', 'py-3', 'border-b', 'border-slate-200', 'dark:border-slate-800');
      }
    });

    const btn = document.getElementById('hamburgerBtn');
    const menu = document.getElementById('mobileMenu');
    const closeBtn = document.getElementById('closeMenuBtn');

    btn.addEventListener('click', () => {
      menu.classList.remove('hidden');
      menu.classList.add('flex');
    });

    closeBtn.addEventListener('click', () => {
      menu.classList.add('hidden');
      menu.classList.remove('flex');
    });

    document.querySelectorAll('.menu-link').forEach(link => {
      link.addEventListener('click', () => {
        menu.classList.add('hidden');
        menu.classList.remove('flex');
      });
    });
  });
</script>