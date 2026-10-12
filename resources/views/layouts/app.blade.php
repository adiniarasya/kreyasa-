<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'KREYASA - Platform Digital Pendidikan & Bisnis')</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@include('partials.styles')
@stack('styles')
<style>
/* Flash message style (tanpa JS) */
.flash-message{
  position:fixed;top:80px;left:50%;transform:translateX(-50%);
  background:rgba(34,197,94,.15);border:1px solid rgba(34,197,94,.4);
  color:#22C55E;padding:12px 24px;border-radius:10px;
  z-index:9999;font-size:.9rem;font-weight:500;
  backdrop-filter:blur(10px);
}
.flash-message.error{
  background:rgba(239,68,68,.15);border-color:rgba(239,68,68,.4);color:#FCA5A5;
}
</style>
</head>
<body>

@if(session('success'))
  <div class="flash-message">
    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
  </div>
@endif

@if(session('error'))
  <div class="flash-message error">
    <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
  </div>
@endif

@yield('content')
@stack('scripts')
</body>
</html>