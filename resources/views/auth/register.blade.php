@extends('layouts.guest')

@section('title', 'Daftar')
@section('description', 'Buat akun Jurnal dan mulai bagikan tulisanmu.')

@section('content')
    <header class="mb-7">
        <p class="mb-3 inline-flex items-center gap-2 rounded-full bg-accent-soft px-3 py-1 text-xs font-semibold text-accent">
            <span class="size-1.5 rounded-full bg-accent"></span>
            Bergabung dengan Jurnal
        </p>
        <h1 class="font-serif text-3xl font-semibold tracking-tight text-ink">Buat akun baru</h1>
        <p class="mt-2 text-sm leading-6 text-stone-500">Satu akun untuk menulis, menyimpan, dan membagikan ceritamu.</p>
    </header>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="label">Nama</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="field @error('name') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror"
                placeholder="Nama lengkap"
                autocomplete="name"
                autofocus
                required
            >

            @error('name')
                <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
            @enderror
        </div>

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
                placeholder="Minimal 8 karakter"
                autocomplete="new-password"
                required
            >

            @error('password')
                <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
            @enderror

            <p class="mt-2 text-xs text-stone-400">Gunakan minimal 8 karakter agar akunmu lebih aman.</p>
        </div>

        <div>
            <label for="password_confirmation" class="label">Konfirmasi Password</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                class="field"
                placeholder="Ulangi password"
                autocomplete="new-password"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary w-full">
            Daftar
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </button>
    </form>

    <div class="mt-7 border-t border-line pt-6 text-center text-sm text-stone-500">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="font-semibold text-accent underline underline-offset-4 hover:text-orange-800">
            Masuk di sini
        </a>
    </div>
@endsection
