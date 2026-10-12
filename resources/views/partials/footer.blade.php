<footer id="kontak">
  <div class="container">
    <div class="footer-grid">
      <div>
        <div class="logo">KREYASA</div>
        <p class="footer-desc">Platform digital yang menghadirkan solusi desain, aplikasi, dan produk digital untuk kebutuhan pendidikan maupun bisnis.</p>
        <div class="social-links">
          <a href="#" class="glass" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
          <a href="#" class="glass" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
          <a href="#" class="glass" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
          <a href="#" class="glass" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
        </div>
      </div>
      <div class="footer-col">
        <h4>Menu</h4>
        <ul>
          <li><a href="#beranda">Beranda</a></li>
          <li><a href="#produk">Produk</a></li>
          <li><a href="#custom-request">Custom Request</a></li>
          <li><a href="{{ route('admin.login') }}">Login Admin</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Layanan</h4>
        <ul>
          <li><a href="#layanan">Design Pendidikan</a></li>
          <li><a href="#layanan">Custom Design</a></li>
          <li><a href="#layanan">Aplikasi Mobile</a></li>
          <li><a href="#layanan">Website</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Kontak</h4>
        <ul class="footer-contact">
          <li><i class="fa-solid fa-envelope"></i> halo@kreyasa.id</li>
          <li><i class="fa-solid fa-phone"></i> +62 812-3456-7890</li>
          <li><i class="fa-solid fa-location-dot"></i> Bandung, Jawa Barat, Indonesia</li>
        </ul>
        <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-wa btn-sm" style="margin-top:8px;"><i class="fa-brands fa-whatsapp"></i> Chat WhatsApp</a>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; {{ date('Y') }} KREYASA. Seluruh hak cipta dilindungi.</p>
      <p>Dibuat dengan <i class="fa-solid fa-heart" style="color:var(--purple-light);"></i> di Indonesia</p>
    </div>
  </div>
</footer>