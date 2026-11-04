@extends('layouts.app')

@section('title', 'Login Admin - KREYASA')

@section('content')
  <div class="min-h-screen flex items-center justify-center p-6 bg-slate-50 dark:bg-slate-950 relative overflow-hidden">

    <div
      class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl -translate-y-1/2 pointer-events-none">
    </div>
    <div
      class="absolute bottom-0 right-1/4 w-96 h-96 bg-violet-500/10 rounded-full blur-3xl translate-y-1/2 pointer-events-none">
    </div>

    <div
      class="w-full max-w-md bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-8 md:p-10 shadow-xl shadow-indigo-500/5 relative z-10">

      <a href="{{ route('home') }}"
        class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-400 mb-8 transition-colors">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Website
      </a>

      <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Login Admin</h2>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">Khusus untuk tim internal KREYASA mengelola pesanan.
        </p>
      </div>

      @if ($errors->any())
        <div
          class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-950/30 border border-red-200 dark:border-red-900/50 text-red-600 dark:text-red-400 text-sm flex items-start gap-3">
          <i class="fa-solid fa-circle-exclamation mt-0.5"></i>
          <span>{{ $errors->first() }}</span>
        </div>
      @endif

      <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
        @csrf

        <div>
          <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Email</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@kreyasa.id" required
            autofocus
            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
        </div>

        <div>
          <label for="password"
            class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Password</label>
          <input type="password" id="password" name="password" placeholder="Masukkan password" required
            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
        </div>

        <button type="submit"
          class="w-full py-3.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-colors shadow-lg shadow-indigo-500/30">
          Masuk
        </button>
      </form>

    </div>
  </div>
@endsection