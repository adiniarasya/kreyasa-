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

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    }
                }
            }
        }


        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                document.querySelectorAll('.alert-auto-hide').forEach(el => {
                    el.style.transition = 'opacity 0.5s ease';
                    el.style.opacity = '0';
                    setTimeout(() => el.remove(), 500);
                });
            }, 3000);
        });
    </script>

    @stack('styles')
</head>

<body class="font-sans antialiased bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100">

    @if (session('success'))
        <div
            class="alert-auto-hide fixed top-20 left-1/2 -translate-x-1/2 bg-emerald-100 border border-emerald-400 text-emerald-600 px-6 py-3 rounded-lg z-50 text-sm font-medium backdrop-blur-md shadow-lg">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div
            class="alert-auto-hide fixed top-20 left-1/2 -translate-x-1/2 bg-red-100 border border-red-400 text-red-600 px-6 py-3 rounded-lg z-50 text-sm font-medium backdrop-blur-md shadow-lg">
            <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
        </div>
    @endif

    @yield('content')
    @stack('scripts')
</body>

</html>
