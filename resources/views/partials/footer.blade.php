<footer id="kontak" class="bg-slate-950 border-t border-slate-900 pt-16 pb-8">
  <div class="max-w-6xl mx-auto px-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12 mb-12">

      <div>
        <div class="text-2xl font-bold text-indigo-500 tracking-tight mb-4">KREYASA</div>
        <p class="text-slate-400 text-sm leading-relaxed mb-6 max-w-xs">
          Platform digital yang menghadirkan solusi desain, aplikasi, dan produk digital untuk kebutuhan pendidikan
          maupun bisnis.
        </p>
        <div class="flex items-center gap-3">
          <a href="#"
            class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-indigo-400 hover:border-indigo-900/50 hover:bg-indigo-950/30 transition-all"
            aria-label="Instagram">
            <i class="fa-brands fa-instagram"></i>
          </a>
          <a href="#"
            class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-indigo-400 hover:border-indigo-900/50 hover:bg-indigo-950/30 transition-all"
            aria-label="YouTube">
            <i class="fa-brands fa-youtube"></i>
          </a>
          <a href="#"
            class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-indigo-400 hover:border-indigo-900/50 hover:bg-indigo-950/30 transition-all"
            aria-label="TikTok">
            <i class="fa-brands fa-tiktok"></i>
          </a>
          <a href="#"
            class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-indigo-400 hover:border-indigo-900/50 hover:bg-indigo-950/30 transition-all"
            aria-label="LinkedIn">
            <i class="fa-brands fa-linkedin-in"></i>
          </a>
        </div>
      </div>

      <div>
        <h4 class="text-white font-bold mb-5">Menu</h4>
        <ul class="space-y-3 text-sm">
          <li><a href="#beranda" class="text-slate-400 hover:text-indigo-400 transition-colors">Beranda</a></li>
          <li><a href="#produk" class="text-slate-400 hover:text-indigo-400 transition-colors">Produk</a></li>
          <li><a href="#custom-request" class="text-slate-400 hover:text-indigo-400 transition-colors">Custom
              Request</a></li>
          <li><a href="{{ route('admin.login') }}" class="text-slate-400 hover:text-indigo-400 transition-colors">Login
              Admin</a></li>
        </ul>
      </div>

      <div>
        <h4 class="text-white font-bold mb-5">Layanan</h4>
        <ul class="space-y-3 text-sm">
          <li><a href="#layanan" class="text-slate-400 hover:text-indigo-400 transition-colors">Design Pendidikan</a>
          </li>
          <li><a href="#layanan" class="text-slate-400 hover:text-indigo-400 transition-colors">Custom Design</a></li>
          <li><a href="#layanan" class="text-slate-400 hover:text-indigo-400 transition-colors">Aplikasi Mobile</a></li>
          <li><a href="#layanan" class="text-slate-400 hover:text-indigo-400 transition-colors">Website</a></li>
        </ul>
      </div>

      <div>
        <h4 class="text-white font-bold mb-5">Kontak</h4>
        <ul class="space-y-4 text-sm text-slate-400 mb-6">
          <li class="flex items-start gap-3">
            <i class="fa-solid fa-envelope mt-1 text-indigo-500"></i>
            <span>halo@kreyasa.id</span>
          </li>
          <li class="flex items-start gap-3">
            <i class="fa-solid fa-phone mt-1 text-indigo-500"></i>
            <span>+62 812-3456-7890</span>
          </li>
          <li class="flex items-start gap-3">
            <i class="fa-solid fa-location-dot mt-1 text-indigo-500"></i>
            <span>Bandung, Jawa Barat, Indonesia</span>
          </li>
        </ul>
        <a href="https://wa.me/6281234567890" target="_blank"
          class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold transition-colors w-full sm:w-auto">
          <i class="fa-brands fa-whatsapp text-lg"></i> Chat WhatsApp
        </a>
      </div>

    </div>

    <div class="pt-8 border-t border-slate-800 flex flex-col md:flex-row items-center justify-between gap-4">
      <p class="text-sm text-slate-500">&copy; {{ date('Y') }} KREYASA. Seluruh hak cipta dilindungi.</p>
      <p class="text-sm text-slate-500 flex items-center gap-1">
        Dibuat dengan <i class="fa-solid fa-heart text-indigo-500"></i> di Indonesia
      </p>
    </div>
  </div>
</footer>