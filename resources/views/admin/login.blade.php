@extends('layouts.app')

@section('title', 'Login Admin - KREYASA')

@section('content')
<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;background:radial-gradient(circle at 30% 20%, rgba(108,60,225,.25), transparent 60%), var(--black);">
  <div class="modal-box" style="max-width:440px;position:relative;">
    <a href="{{ route('home') }}" style="color:var(--text-muted);font-size:.85rem;display:inline-flex;align-items:center;gap:6px;margin-bottom:20px;">
      <i class="fa-solid fa-arrow-left"></i> Kembali ke Website
    </a>
    <h2>Login Admin</h2>
    <p class="modal-sub">Khusus untuk tim internal KREYASA mengelola pesanan.</p>

    @if ($errors->any())
      <div class="form-error" style="display:block;background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.3);padding:10px;border-radius:8px;margin-bottom:16px;">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
      @csrf
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@kreyasa.id" required autofocus>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Masuk</button>
    </form>

    <div class="demo-hint" style="margin-top:16px;">
      <i class="fa-solid fa-circle-info"></i>
      Demo: email <b>admin@kreyasa.id</b> / password <b>kreyasa123</b>
    </div>
  </div>
</div>
@endsection