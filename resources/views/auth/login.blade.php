@extends('layouts.guest')

@section('title', 'Masuk')
@section('description', 'Masuk ke akun Jurnal untuk mulai menulis dan mengelola artikel.')

@section('content')
    <header class="mb-7">
        <p class="mb-3 inline-flex items-center gap-2 rounded-full bg-accent-soft px-3 py-1 text-xs font-semibold text-accent">
            <span class="size-1.5 rounded-full bg-accent"></span>
            Selamat datang kembali
        </p>
        <h1 class="font-serif text-3xl font-semibold tracking-tight text-ink">Masuk ke akunmu</h1>
        <p class="mt-2 text-sm leading-6 text-stone-500">Lanjutkan menulis dan kelola artikelmu dari satu tempat.</p>
    </header>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="label">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="field @error('email') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror"
                placeholder="nama@email.com"
                autocomplete="email"
                autofocus
                required
            >

            @error('email')
                <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="label">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                class="field @error('password') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror"
                placeholder="Masukkan password"
                autocomplete="current-password"
                required
            >

            @error('password')
                <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-full">
            Masuk
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </button>
    </form>

    <div class="mt-7 border-t border-line pt-6 text-center text-sm text-stone-500">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-semibold text-accent underline underline-offset-4 hover:text-orange-800">
            Daftar sekarang
        </a>
    </div>
@endsection
