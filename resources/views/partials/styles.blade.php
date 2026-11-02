<style>
  :root {
    --black: #F8FAFC;
    --navy: #FFFFFF;
    --purple: #2563EB;
    --purple-light: #3B82F6;
    --text-main: #0F172A;
    --text-muted: #64748B;
    --glass-bg: rgba(255, 255, 255, 0.9);
    --glass-border: rgba(15, 23, 42, 0.1);
    --green: #10B981;
    --amber: #F59E0B;
    --red: #EF4444;
    --radius-md: 16px;
    --radius-sm: 10px;
    --transition: 0.3s ease;
  }

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  html {
    scroll-behavior: smooth;
  }

  body {
    font-family: 'Inter', sans-serif;
    background: var(--black);
    color: var(--text-main);
    line-height: 1.6;
    overflow-x: hidden;
  }

  a {
    text-decoration: none;
    color: inherit;
  }

  ul {
    list-style: none;
  }

  img {
    max-width: 100%;
    display: block;
  }

  button {
    font-family: inherit;
  }

  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
  }

  section {
    position: relative;
    padding: 100px 0;
  }

  .section-tag {
    display: inline-block;
    color: var(--purple);
    font-weight: 600;
    font-size: .95rem;
    margin-bottom: 12px;
  }

  .section-heading {
    font-size: clamp(1.8rem, 3vw, 2.6rem);
    font-weight: 800;
    max-width: 640px;
    margin-bottom: 16px;
  }

  .section-sub {
    color: var(--text-muted);
    max-width: 580px;
    font-size: 1.05rem;
    margin-bottom: 56px;
  }

  .gradient-text {
    color: var(--purple);
  }

  .glass {
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
  }

  .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 14px 28px;
    border-radius: 999px;
    font-weight: 600;
    font-size: .95rem;
    cursor: pointer;
    border: none;
    transition: transform var(--transition), box-shadow var(--transition), background var(--transition);
    white-space: nowrap;
  }

  .btn-primary {
    background: var(--purple);
    color: #fff;
    box-shadow: 0 4px 12px rgba(37, 99, 235, .2);
  }

  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(37, 99, 235, .3);
    background: var(--purple-light);
  }

  .btn-outline {
    background: transparent;
    color: var(--purple);
    border: 1.5px solid var(--purple);
  }

  .btn-outline:hover {
    background: rgba(37, 99, 235, .05);
    transform: translateY(-2px);
  }

  .btn-sm {
    padding: 10px 18px;
    font-size: .85rem;
  }

  .btn-xs {
    padding: 7px 14px;
    font-size: .78rem;
    border-radius: 8px;
  }

  .btn-wa {
    background: var(--green);
    color: #fff;
    box-shadow: 0 8px 20px rgba(16, 185, 129, .2);
  }

  .btn-wa:hover {
    transform: translateY(-2px);
  }

  .btn-danger {
    background: rgba(239, 68, 68, .1);
    color: var(--red);
    border: 1px solid rgba(239, 68, 68, .3);
    cursor: pointer;
    padding: 7px 14px;
    border-radius: 8px;
    font-size: .78rem;
  }

  .btn-danger:hover {
    background: rgba(239, 68, 68, .2);
  }

  .btn-block {
    width: 100%;
  }

  .btn:disabled {
    opacity: .5;
    cursor: not-allowed;
    transform: none !important;
  }

  .navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    padding: 20px 0;
    background: transparent;
    transition: background var(--transition), padding var(--transition), border var(--transition);
    border-bottom: 1px solid transparent;
  }

  .navbar.scrolled {
    background: rgba(255, 255, 255, .9);
    backdrop-filter: blur(14px);
    border-bottom: 1px solid var(--glass-border);
    padding: 14px 0;
  }

  .navbar .container {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .logo {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--purple);
    letter-spacing: .5px;
    cursor: pointer;
  }

  .nav-menu {
    display: flex;
    align-items: center;
    gap: 36px;
  }

  .nav-menu a {
    font-weight: 500;
    font-size: .95rem;
    color: var(--text-muted);
    transition: color var(--transition);
  }

  .nav-menu a:hover {
    color: var(--text-main);
  }

  .nav-actions {
    display: flex;
    align-items: center;
    gap: 16px;
  }

  .icon-btn {
    position: relative;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    cursor: pointer;
    color: var(--text-main);
    font-size: 1.05rem;
    transition: background var(--transition);
  }

  .icon-btn:hover {
    background: rgba(37, 99, 235, .1);
  }

  .cart-count {
    position: absolute;
    top: -4px;
    right: -4px;
    background: var(--purple);
    color: #fff;
    font-size: .68rem;
    font-weight: 700;
    min-width: 18px;
    height: 18px;
    border-radius: 999px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 4px;
  }

  .hamburger {
    display: none;
    flex-direction: column;
    gap: 5px;
    cursor: pointer;
    background: none;
    border: none;
    padding: 6px;
  }

  .hamburger span {
    width: 24px;
    height: 2px;
    background: var(--text-main);
    border-radius: 2px;
  }

  .mobile-menu {
    display: none;
    position: fixed;
    top: 0;
    right: 0;
    width: 78%;
    max-width: 320px;
    height: 100vh;
    background: rgba(255, 255, 255, .98);
    backdrop-filter: blur(16px);
    border-left: 1px solid var(--glass-border);
    padding: 100px 32px 40px;
    z-index: 1400;
    flex-direction: column;
    gap: 26px;
  }

  .mobile-menu a {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-main);
  }

  .hero {
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding-top: 140px;
    background: radial-gradient(ellipse 60% 50% at 20% 20%, rgba(37, 99, 235, .05), transparent 60%), radial-gradient(ellipse 60% 50% at 80% 10%, rgba(59, 130, 246, .05), transparent 60%), var(--black);
    overflow: hidden;
    position: relative;
  }

  .glow {
    display: none;
  }

  .hero-content {
    position: relative;
    z-index: 1;
    max-width: 760px;
    margin: 0 auto;
    text-align: center;
  }

  .badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 18px;
    border-radius: 999px;
    font-size: .85rem;
    font-weight: 600;
    color: var(--purple);
    margin-bottom: 28px;
    background: rgba(37, 99, 235, .08);
    border: 1px solid rgba(37, 99, 235, .15);
  }

  .hero h1 {
    font-size: clamp(2.2rem, 5vw, 3.6rem);
    font-weight: 800;
    line-height: 1.15;
    margin-bottom: 24px;
  }

  .hero p.subtitle {
    color: var(--text-muted);
    font-size: 1.15rem;
    max-width: 560px;
    margin: 0 auto 40px;
  }

  .hero-cta {
    display: flex;
    justify-content: center;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 72px;
  }

  .hero-stats {
    display: flex;
    justify-content: center;
    gap: 56px;
    flex-wrap: wrap;
  }

  .stat-item {
    text-align: center;
  }

  .stat-number {
    font-size: 2rem;
    font-weight: 800;
    color: var(--purple);
  }

  .stat-label {
    color: var(--text-muted);
    font-size: .9rem;
    margin-top: 4px;
  }

  .services-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
  }

  .service-card {
    padding: 32px 28px;
    border-radius: var(--radius-md);
    transition: transform var(--transition), border-color var(--transition), background var(--transition);
  }

  .service-card:hover {
    transform: translateY(-5px);
    border-color: rgba(37, 99, 235, .3);
    background: #fff;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
  }

  .service-icon {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(37, 99, 235, .1);
    font-size: 1.4rem;
    color: var(--purple);
    margin-bottom: 20px;
  }

  .service-card h3 {
    font-size: 1.15rem;
    margin-bottom: 10px;
    font-weight: 700;
  }

  .service-card p {
    color: var(--text-muted);
    font-size: .92rem;
  }

  .products {
    background: var(--navy);
  }

  .products-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
  }

  .product-card {
    border-radius: var(--radius-md);
    overflow: hidden;
    transition: transform var(--transition), box-shadow var(--transition);
    display: flex;
    flex-direction: column;
    background: #fff;
    border: 1px solid var(--glass-border);
  }

  .product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
  }

  .product-img {
    position: relative;
    display: block;
  }

  .product-img img {
    width: 100%;
    height: 190px;
    object-fit: cover;
  }

  .product-badge {
    position: absolute;
    top: 14px;
    right: 14px;
    background: var(--purple);
    color: #fff;
    font-size: .75rem;
    font-weight: 700;
    padding: 5px 14px;
    border-radius: 999px;
  }

  .product-body {
    padding: 22px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    flex: 1;
  }

  .product-category {
    color: var(--purple);
    font-size: .8rem;
    font-weight: 600;
  }

  .product-name {
    font-size: 1.1rem;
    font-weight: 700;
  }

  .product-price {
    font-size: 1.25rem;
    font-weight: 800;
    margin-top: 2px;
  }

  .product-perks {
    display: flex;
    flex-direction: column;
    gap: 4px;
    color: var(--text-muted);
    font-size: .78rem;
    margin: 6px 0 12px;
  }

  .product-perks span {
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .product-perks i {
    color: var(--green);
    font-size: .75rem;
  }

  .product-actions {
    display: flex;
    gap: 10px;
    margin-top: auto;
  }

  .product-actions .btn {
    flex: 1;
    padding: 11px;
    font-size: .85rem;
  }

  .dp-note {
    font-size: .75rem;
    color: var(--text-muted);
    background: rgba(37, 99, 235, .05);
    border: 1px solid rgba(37, 99, 235, .15);
    padding: 6px 10px;
    border-radius: 8px;
    margin-top: 4px;
  }

  .guarantee {
    background: var(--black);
  }

  .guarantee-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
  }

  .guarantee-card {
    padding: 32px 28px;
    border-radius: var(--radius-md);
  }

  .guarantee-card .g-icon {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: rgba(37, 99, 235, .1);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--purple);
    font-size: 1.3rem;
    margin-bottom: 18px;
  }

  .guarantee-card h3 {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 8px;
  }

  .guarantee-card p {
    color: var(--text-muted);
    font-size: .9rem;
  }

  .custom-request {
    background: var(--navy);
  }

  .cr-box {
    max-width: 820px;
    margin: 0 auto;
    text-align: center;
    padding: 64px 40px;
    border-radius: 24px;
    background: linear-gradient(135deg, rgba(37, 99, 235, .05), rgba(59, 130, 246, .05));
    border: 1px solid rgba(37, 99, 235, .1);
  }

  .cr-box h2 {
    font-size: clamp(1.6rem, 3vw, 2.2rem);
    font-weight: 800;
    margin-bottom: 16px;
  }

  .cr-box p {
    color: var(--text-muted);
    max-width: 520px;
    margin: 0 auto 32px;
  }

  .testimonials-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
  }

  .testimonial-card {
    padding: 32px 28px;
    border-radius: var(--radius-md);
  }

  .stars {
    color: var(--amber);
    font-size: .9rem;
    margin-bottom: 16px;
  }

  .testimonial-text {
    color: var(--text-muted);
    font-size: .95rem;
    margin-bottom: 24px;
    font-style: italic;
  }

  .testimonial-author {
    display: flex;
    align-items: center;
    gap: 14px;
  }

  .testimonial-author img {
    width: 48px;
    height: 48px;
    border-radius: 50%;
  }

  .author-name {
    font-weight: 700;
    font-size: .95rem;
  }

  .author-role {
    color: var(--text-muted);
    font-size: .82rem;
  }

  footer {
    background: var(--navy);
    padding: 72px 0 28px;
    border-top: 1px solid var(--glass-border);
  }

  .footer-grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1.2fr;
    gap: 40px;
    margin-bottom: 48px;
  }

  .footer-desc {
    color: var(--text-muted);
    font-size: .9rem;
    margin: 16px 0 24px;
    max-width: 280px;
  }

  .social-links {
    display: flex;
    gap: 12px;
  }

  .social-links a {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(37, 99, 235, .08);
    color: var(--purple);
  }

  .social-links a:hover {
    background: rgba(37, 99, 235, .15);
  }

  .footer-col h4 {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 20px;
  }

  .footer-col ul li {
    margin-bottom: 12px;
  }

  .footer-col ul li a {
    color: var(--text-muted);
    font-size: .9rem;
  }

  .footer-col ul li a:hover {
    color: var(--purple);
  }

  .footer-contact li {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    color: var(--text-muted);
    font-size: .9rem;
    margin-bottom: 14px;
  }

  .footer-contact i {
    color: var(--purple);
    margin-top: 3px;
  }

  .footer-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
    padding-top: 28px;
    border-top: 1px solid var(--glass-border);
  }

  .footer-bottom p {
    color: var(--text-muted);
    font-size: .85rem;
  }

  .reveal {
    opacity: 1;
    transform: translateY(0);
  }

  .flash-message {
    position: fixed;
    top: 80px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(16, 185, 129, .1);
    border: 1px solid rgba(16, 185, 129, .3);
    color: var(--green);
    padding: 12px 24px;
    border-radius: 10px;
    z-index: 9999;
    font-size: .9rem;
    font-weight: 500;
    backdrop-filter: blur(10px);
  }

  .flash-message.error {
    background: rgba(239, 68, 68, .1);
    border-color: rgba(239, 68, 68, .3);
    color: var(--red);
  }

  .cart-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 24px;
  }

  .modal-box {
    background: #fff;
    border: 1px solid var(--glass-border);
    border-radius: 20px;
    width: 100%;
    max-width: 480px;
    padding: 32px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
  }

  .modal-sub {
    color: var(--text-muted);
    font-size: .88rem;
    margin-bottom: 24px;
  }

  .form-group {
    margin-bottom: 18px;
  }

  .form-group label {
    display: block;
    font-size: .85rem;
    font-weight: 600;
    margin-bottom: 8px;
    color: var(--text-main);
  }

  .form-group input,
  .form-group textarea,
  .form-group select {
    width: 100%;
    padding: 12px 14px;
    border-radius: 10px;
    background: #fff;
    border: 1px solid var(--glass-border);
    color: var(--text-main);
    font-family: inherit;
    font-size: .9rem;
    outline: none;
    transition: border-color var(--transition);
  }

  .form-group input:focus,
  .form-group textarea:focus,
  .form-group select:focus {
    border-color: var(--purple);
  }

  .form-group textarea {
    resize: vertical;
    min-height: 70px;
  }

  .form-error {
    color: var(--red);
    font-size: .8rem;
    margin-top: 6px;
  }

  .pay-options {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 20px;
  }

  .pay-option {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 16px;
    border-radius: 12px;
    border: 1.5px solid var(--glass-border);
    cursor: pointer;
    background: #fff;
  }

  .pay-option.selected {
    border-color: var(--purple);
    background: rgba(37, 99, 235, .05);
  }

  .pay-option input {
    width: auto;
    accent-color: var(--purple);
  }

  .pay-option-text {
    flex: 1;
  }

  .pay-option-title {
    font-weight: 600;
    font-size: .9rem;
  }

  .pay-option-desc {
    color: var(--text-muted);
    font-size: .78rem;
    margin-top: 2px;
  }

  .pay-option-amount {
    font-weight: 700;
    font-size: .95rem;
    color: var(--purple);
  }

  .summary-box {
    background: #F8FAFC;
    border: 1px solid var(--glass-border);
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 20px;
    font-size: .85rem;
  }

  .summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    color: var(--text-muted);
  }

  .summary-row.total {
    color: var(--text-main);
    font-weight: 700;
    font-size: 1rem;
    border-top: 1px solid var(--glass-border);
    padding-top: 10px;
    margin-top: 6px;
  }

  .confirm-icon {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: rgba(16, 185, 129, .1);
    color: var(--green);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    margin: 0 auto 20px;
  }

  .order-id-box {
    text-align: center;
    background: rgba(37, 99, 235, .05);
    border: 1px solid rgba(37, 99, 235, .2);
    border-radius: 12px;
    padding: 14px;
    margin-bottom: 20px;
  }

  .order-id-box .label {
    font-size: .78rem;
    color: var(--text-muted);
  }

  .order-id-box .value {
    font-size: 1.25rem;
    font-weight: 800;
    letter-spacing: 1px;
    color: var(--purple);
  }

  .bank-box {
    background: #F8FAFC;
    border: 1px dashed var(--glass-border);
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 20px;
    font-size: .85rem;
  }

  .bank-box .bank-name {
    font-weight: 700;
    margin-bottom: 4px;
  }

  .bank-box .bank-num {
    font-size: 1.1rem;
    font-weight: 800;
    letter-spacing: 1px;
    color: var(--text-main);
    margin-bottom: 2px;
  }

  .demo-hint {
    font-size: .75rem;
    color: var(--amber);
    background: rgba(245, 158, 11, .1);
    border: 1px solid rgba(245, 158, 11, .3);
    padding: 8px 12px;
    border-radius: 8px;
    margin-top: 10px;
  }

  .admin-view {
    position: fixed;
    inset: 0;
    background: var(--black);
    z-index: 900;
    display: flex;
  }

  .admin-sidebar {
    width: 250px;
    background: var(--navy);
    border-right: 1px solid var(--glass-border);
    padding: 28px 20px;
    display: flex;
    flex-direction: column;
  }

  .admin-sidebar .logo {
    margin-bottom: 36px;
    padding-left: 8px;
  }

  .admin-nav {
    display: flex;
    flex-direction: column;
    gap: 6px;
    flex: 1;
  }

  .admin-nav a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 14px;
    border-radius: 10px;
    color: var(--text-muted);
    font-size: .9rem;
    font-weight: 500;
  }

  .admin-nav a i {
    width: 18px;
    text-align: center;
  }

  .admin-nav a:hover {
    background: rgba(37, 99, 235, .05);
    color: var(--text-main);
  }

  .admin-nav a.active {
    background: rgba(37, 99, 235, .1);
    color: var(--purple);
    border: 1px solid rgba(37, 99, 235, .2);
  }

  .admin-main {
    flex: 1;
    overflow-y: auto;
  }

  .admin-topbar {
    padding: 22px 36px;
    border-bottom: 1px solid var(--glass-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    background: rgba(255, 255, 255, .9);
    backdrop-filter: blur(10px);
    z-index: 5;
  }

  .admin-topbar h2 {
    font-size: 1.3rem;
    font-weight: 800;
  }

  .admin-content {
    padding: 32px 36px;
  }

  .stat-cards {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 32px;
  }

  .stat-card {
    padding: 22px;
    border-radius: var(--radius-md);
  }

  .stat-card .sc-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(37, 99, 235, .1);
    color: var(--purple);
    margin-bottom: 14px;
  }

  .stat-card .sc-value {
    font-size: 1.5rem;
    font-weight: 800;
  }

  .stat-card .sc-label {
    color: var(--text-muted);
    font-size: .82rem;
    margin-top: 4px;
  }

  .admin-table-wrap {
    overflow-x: auto;
    border-radius: var(--radius-md);
    border: 1px solid var(--glass-border);
  }

  table.admin-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 900px;
  }

  table.admin-table th {
    text-align: left;
    font-size: .75rem;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: var(--text-muted);
    padding: 14px 16px;
    border-bottom: 1px solid var(--glass-border);
    background: #F8FAFC;
  }

  table.admin-table td {
    padding: 14px 16px;
    border-bottom: 1px solid var(--glass-border);
    font-size: .87rem;
    vertical-align: top;
    background: #fff;
  }

  .status-pill {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 999px;
    font-size: .72rem;
    font-weight: 700;
    white-space: nowrap;
  }

  .status-select {
    padding: 8px 10px;
    border-radius: 8px;
    background: #fff;
    border: 1px solid var(--glass-border);
    color: var(--text-main);
    font-size: .8rem;
  }

  .pay-tag {
    font-size: .72rem;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 999px;
  }

  .pay-tag.dp {
    background: rgba(245, 158, 11, .1);
    color: var(--amber);
  }

  .pay-tag.lunas {
    background: rgba(16, 185, 129, .1);
    color: var(--green);
  }

  .product-edit-row {
    display: grid;
    grid-template-columns: 70px 1.4fr 1fr 1fr 100px;
    gap: 14px;
    align-items: center;
    padding: 16px;
    border-radius: 12px;
    margin-bottom: 12px;
    background: #fff;
    border: 1px solid var(--glass-border);
  }

  .product-edit-row img {
    width: 56px;
    height: 56px;
    border-radius: 8px;
    object-fit: cover;
  }

  @media (max-width:900px) {
    .services-grid {
      grid-template-columns: repeat(2, 1fr);
    }

    .products-grid {
      grid-template-columns: repeat(2, 1fr);
    }

    .guarantee-grid {
      grid-template-columns: 1fr;
    }

    .testimonials-grid {
      grid-template-columns: 1fr;
    }

    .footer-grid {
      grid-template-columns: 1fr 1fr;
    }

    .stat-cards {
      grid-template-columns: 1fr 1fr;
    }
  }

  @media (max-width:768px) {
    .nav-menu {
      display: none;
    }

    .hamburger {
      display: flex;
    }

    .mobile-menu {
      display: flex;
    }

    .hero-stats {
      gap: 32px;
    }

    .services-grid {
      grid-template-columns: 1fr;
    }

    .products-grid {
      grid-template-columns: 1fr;
    }

    .footer-grid {
      grid-template-columns: 1fr;
      gap: 32px;
    }

    section {
      padding: 70px 0;
    }

    .cart-grid {
      grid-template-columns: 1fr !important;
    }

    .admin-sidebar {
      width: 74px;
      padding: 20px 10px;
    }

    .admin-sidebar .logo {
      font-size: 0;
    }

    .admin-sidebar .logo::after {
      content: "K";
      font-size: 1.4rem;
    }

    .admin-nav a span {
      display: none;
    }

    .admin-content {
      padding: 22px 16px;
    }

    .stat-cards {
      grid-template-columns: 1fr 1fr;
    }
  }
</style>