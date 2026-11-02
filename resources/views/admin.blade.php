@extends('layouts.app')

@section('title', 'Panel Admin')
@section('description', 'Kelola pengguna, artikel, dan kategori Jurnal.')

@php
    $totalUsers = \App\Models\User::count();
    $totalPosts = \App\Models\Post::count();
    $totalCategories = \App\Models\Category::count();
    $totalAdmins = \App\Models\User::where('role', 'admin')->count();

    $recentPosts = \App\Models\Post::with('user')->latest()->take(5)->get();
    $recentUsers = \App\Models\User::latest()->take(5)->get();
    $topCategories = \App\Models\Category::withCount('posts')->orderByDesc('posts_count')->take(5)->get();
    $maxCategoryPosts = max(1, $topCategories->max('posts_count') ?? 0);
@endphp

@section('content')
    <section class="mb-10 flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="mb-3 inline-flex items-center gap-2 rounded-full border border-line bg-white/70 px-3 py-1 text-xs font-semibold uppercase tracking-[0.16em] text-stone-500">
                <span class="size-1.5 rounded-full bg-accent"></span>
                Khusus admin
            </p>
            <h1 class="font-serif text-4xl font-semibold tracking-tight text-ink sm:text-5xl">Panel Admin</h1>
            <p class="mt-3 max-w-xl text-base leading-7 text-stone-600">
                Pantau aktivitas Jurnal dan kelola konten dari satu dashboard.
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('posts.index') }}" class="btn btn-ghost">Lihat situs</a>
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard saya</a>
        </div>
    </section>

    <section class="mb-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="card p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-stone-400">Pengguna</p>
                    <p class="mt-2 font-serif text-3xl font-semibold text-ink">{{ $totalUsers }}</p>
                </div>
                <span class="grid size-10 place-items-center rounded-xl bg-sky-50 text-sky-600">
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </span>
            </div>
            <p class="mt-3 text-xs text-stone-500">{{ $totalAdmins }} akun admin</p>
        </div>

        <div class="card p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-stone-400">Artikel</p>
                    <p class="mt-2 font-serif text-3xl font-semibold text-ink">{{ $totalPosts }}</p>
                </div>
                <span class="grid size-10 place-items-center rounded-xl bg-accent-soft text-accent">
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z" />
                    </svg>
                </span>
            </div>
            <p class="mt-3 text-xs text-stone-500">Tulisan yang dipublikasikan</p>
        </div>

        <div class="card p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-stone-400">Kategori</p>
                    <p class="mt-2 font-serif text-3xl font-semibold text-ink">{{ $totalCategories }}</p>
                </div>
                <span class="grid size-10 place-items-center rounded-xl bg-emerald-50 text-emerald-600">
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M20.59 13.41 13.42 20.58a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82Z" />
                        <circle cx="7" cy="7" r="1.5" />
                    </svg>
                </span>
            </div>
            <p class="mt-3 text-xs text-stone-500">Topik yang tersedia</p>
        </div>

        <div class="card p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-stone-400">Status</p>
                    <p class="mt-2 flex items-center gap-2 font-serif text-3xl font-semibold text-ink">
                        <span class="size-2.5 rounded-full bg-emerald-500"></span>
                        Normal
                    </p>
                </div>
                <span class="grid size-10 place-items-center rounded-xl bg-stone-100 text-stone-600">
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                    </svg>
                </span>
            </div>
            <p class="mt-3 text-xs text-stone-500">Aplikasi berjalan dengan baik</p>
        </div>
    </section>

    <div class="grid gap-8 lg:grid-cols-[1.35fr_1fr]">
        <section class="card overflow-hidden">
            <div class="flex items-center justify-between gap-4 border-b border-line px-5 py-4 sm:px-6">
                <div>
                    <h2 class="font-serif text-xl font-semibold tracking-tight text-ink">Artikel Terbaru</h2>
                    <p class="mt-0.5 text-xs text-stone-500">Konten yang baru dipublikasikan</p>
                </div>
                <a href="{{ route('posts.index') }}" class="text-sm font-semibold text-accent hover:text-orange-800">Semua</a>
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
                                    {{ $post->user?->name ?? 'Tanpa penulis' }}
                                    &middot;
                                    {{ $post->created_at?->format('d M Y') ?? 'Tanpa tanggal' }}
                                </p>
                            </div>

                            <a href="{{ route('posts.show', $post) }}" class="btn btn-ghost shrink-0 px-3 py-1.5 text-xs">Lihat</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="px-6 py-12 text-center text-sm text-stone-500">Belum ada artikel.</p>
            @endif
        </section>

        <section class="card p-5 sm:p-6">
            <h2 class="font-serif text-xl font-semibold tracking-tight text-ink">Kategori Populer</h2>
            <p class="mt-0.5 text-xs text-stone-500">Berdasarkan jumlah artikel</p>

            @if ($topCategories->isNotEmpty())
                <ul class="mt-5 space-y-4">
                    @foreach ($topCategories as $category)
                        @php($percentage = (int) round(($category->posts_count / $maxCategoryPosts) * 100))

                        <li>
                            <div class="mb-1.5 flex items-center justify-between gap-3 text-sm">
                                <span class="font-medium text-ink">{{ $category->name }}</span>
                                <span class="text-xs text-stone-400">{{ $category->posts_count }} artikel</span>
                            </div>
                            <div class="h-2 overflow-hidden rounded-full bg-stone-100">
                                <div class="h-full rounded-full bg-accent" style="width: {{ $percentage }}%"></div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="mt-5 text-sm text-stone-500">Belum ada kategori.</p>
            @endif
        </section>
    </div>

    <section class="card mt-8 overflow-hidden">
        <div class="flex items-center justify-between gap-4 border-b border-line px-5 py-4 sm:px-6">
            <div>
                <h2 class="font-serif text-xl font-semibold tracking-tight text-ink">Pengguna Terbaru</h2>
                <p class="mt-0.5 text-xs text-stone-500">Akun yang baru bergabung</p>
            </div>
        </div>

        @if ($recentUsers->isNotEmpty())
            <ul class="divide-y divide-line">
                @foreach ($recentUsers as $user)
                    <li class="flex items-center justify-between gap-4 px-5 py-4 sm:px-6">
                        <div class="flex min-w-0 items-center gap-3">
                            <span class="grid size-9 shrink-0 place-items-center rounded-full bg-stone-100 text-xs font-bold text-stone-600">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                            <div class="min-w-0">
                                <p class="truncate text-sm font-semibold text-ink">{{ $user->name }}</p>
                                <p class="truncate text-xs text-stone-400">{{ $user->email }}</p>
                            </div>
                        </div>

                        <div class="flex shrink-0 items-center gap-3">
                            <span class="chip {{ $user->role === 'admin' ? 'border-accent/20 bg-accent-soft text-accent' : '' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                            <span class="hidden text-xs text-stone-400 sm:inline">{{ $user->created_at?->format('d M Y') ?? '—' }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="px-6 py-12 text-center text-sm text-stone-500">Belum ada pengguna.</p>
        @endif
    </section>
@endsection
