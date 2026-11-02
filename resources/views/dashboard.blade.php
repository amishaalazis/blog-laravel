@extends('layouts.app')

@section('title', 'Dashboard')
@section('description', 'Ringkasan akun dan artikelmu di Jurnal.')

@php
    $user = auth()->user();
    $postCount = $user->posts()->count();
    $recentPosts = $user->posts()->latest()->take(5)->get();
@endphp

@section('content')
    <section class="mb-10 flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="mb-3 inline-flex items-center gap-2 rounded-full border border-line bg-white/70 px-3 py-1 text-xs font-semibold uppercase tracking-[0.16em] text-stone-500">
                <span class="size-1.5 rounded-full bg-emerald-500"></span>
                Dashboard
            </p>
            <h1 class="font-serif text-4xl font-semibold tracking-tight text-ink sm:text-5xl">
                Halo, {{ $user->name }}.
            </h1>
            <p class="mt-3 max-w-xl text-base leading-7 text-stone-600">
                Ini ringkasan ruang menulismu. Lanjutkan draf, kelola artikel, atau mulai tulisan baru hari ini.
            </p>
        </div>

        <a href="{{ route('posts.create') }}" class="btn btn-primary self-start sm:self-auto">
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                <path d="M12 5v14M5 12h14" />
            </svg>
            Tulis Artikel
        </a>
    </section>

    <section class="mb-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="card p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-stone-400">Total Artikel</p>
            <p class="mt-2 font-serif text-3xl font-semibold text-ink">{{ $postCount }}</p>
            <p class="mt-1 text-xs text-stone-500">Tulisan yang sudah kamu buat</p>
        </div>

        <div class="card p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-stone-400">Peran</p>
            <p class="mt-2 font-serif text-3xl font-semibold capitalize text-ink">{{ $user->role }}</p>
            <p class="mt-1 text-xs text-stone-500">Hak akses akunmu saat ini</p>
        </div>

        <div class="card p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-stone-400">Bergabung</p>
            <p class="mt-2 font-serif text-3xl font-semibold text-ink">{{ $user->created_at?->format('M Y') ?? '—' }}</p>
            <p class="mt-1 text-xs text-stone-500">{{ $user->created_at?->format('d M Y') ?? '—' }}</p>
        </div>

        <div class="card p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-stone-400">Status</p>
            <p class="mt-2 flex items-center gap-2 font-serif text-3xl font-semibold text-ink">
                <span class="size-2.5 rounded-full bg-emerald-500"></span>
                Aktif
            </p>
            <p class="mt-1 text-xs text-stone-500">Akun siap digunakan</p>
        </div>
    </section>

    <div class="grid gap-8 lg:grid-cols-[1fr_340px]">
        <section class="card overflow-hidden">
            <div class="flex items-center justify-between gap-4 border-b border-line px-5 py-4 sm:px-6">
                <div>
                    <h2 class="font-serif text-xl font-semibold tracking-tight text-ink">Artikel Terbaru</h2>
                    <p class="mt-0.5 text-xs text-stone-500">Lima tulisan terakhir darimu</p>
                </div>

                <a href="{{ route('posts.index') }}" class="text-sm font-semibold text-accent hover:text-orange-800">Lihat semua</a>
            </div>

            @if ($recentPosts->isNotEmpty())
                <ul class="divide-y divide-line">
                    @foreach ($recentPosts as $post)
                        <li class="flex items-center justify-between gap-4 px-5 py-4 transition hover:bg-stone-50 sm:px-6">
                            <div class="min-w-0">
                                <a href="{{ route('posts.show', $post) }}" class="block truncate font-semibold text-ink transition hover:text-accent">
                                    {{ $post->title }}
                                </a>
                                <p class="mt-1 text-xs text-stone-400">
                                    {{ $post->created_at?->format('d M Y') ?? 'Tanpa tanggal' }}
                                    &middot;
                                    {{ \Illuminate\Support\Str::limit($post->content, 60) }}
                                </p>
                            </div>

                            <div class="flex shrink-0 items-center gap-1">
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-ghost px-3 py-1.5 text-xs">Lihat</a>
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-ghost px-3 py-1.5 text-xs">Edit</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="flex flex-col items-center px-6 py-14 text-center">
                    <span class="grid size-12 place-items-center rounded-2xl bg-accent-soft text-accent">
                        <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M12 20h9" />
                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z" />
                        </svg>
                    </span>
                    <h3 class="mt-4 font-serif text-xl font-semibold tracking-tight">Belum ada artikel</h3>
                    <p class="mt-2 max-w-xs text-sm leading-6 text-stone-500">
                        Mulai dengan satu paragraf. Tulisan pertamamu tidak harus sempurna.
                    </p>
                    <a href="{{ route('posts.create') }}" class="btn btn-primary mt-5">Tulis sekarang</a>
                </div>
            @endif
        </section>

        <aside class="space-y-6">
            <section class="card p-5">
                <div class="flex items-center gap-3">
                    <span class="grid size-12 place-items-center rounded-full bg-accent-soft text-base font-bold text-accent">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </span>
                    <div class="min-w-0">
                        <p class="truncate font-semibold text-ink">{{ $user->name }}</p>
                        <p class="truncate text-xs text-stone-500">{{ $user->email }}</p>
                    </div>
                </div>

                <dl class="mt-5 space-y-3 border-t border-line pt-4 text-sm">
                    <div class="flex items-center justify-between gap-3">
                        <dt class="text-stone-500">Peran</dt>
                        <dd class="font-semibold capitalize text-ink">{{ $user->role }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                        <dt class="text-stone-500">Artikel</dt>
                        <dd class="font-semibold text-ink">{{ $postCount }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                        <dt class="text-stone-500">Bergabung</dt>
                        <dd class="font-semibold text-ink">{{ $user->created_at?->format('d M Y') ?? '—' }}</dd>
                    </div>
                </dl>
            </section>

            <section class="card p-5">
                <h2 class="font-serif text-lg font-semibold tracking-tight">Aksi Cepat</h2>

                <div class="mt-4 space-y-2">
                    <a href="{{ route('posts.create') }}" class="flex items-center justify-between rounded-xl border border-line bg-white px-3.5 py-3 text-sm font-medium text-stone-700 transition hover:border-stone-300 hover:bg-stone-50">
                        Tulis artikel baru
                        <svg class="size-4 text-stone-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="{{ route('posts.index') }}" class="flex items-center justify-between rounded-xl border border-line bg-white px-3.5 py-3 text-sm font-medium text-stone-700 transition hover:border-stone-300 hover:bg-stone-50">
                        Jelajahi artikel
                        <svg class="size-4 text-stone-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>

                    @if ($user->role === 'admin')
                        <a href="{{ route('admin') }}" class="flex items-center justify-between rounded-xl border border-line bg-white px-3.5 py-3 text-sm font-medium text-stone-700 transition hover:border-stone-300 hover:bg-stone-50">
                            Buka panel admin
                            <svg class="size-4 text-stone-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </a>
                    @endif
                </div>
            </section>
        </aside>
    </div>
@endsection
