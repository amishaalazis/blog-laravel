@extends('layouts.app')

@section('title', 'Daftar Artikel')
@section('description', 'Kumpulan artikel, catatan, dan cerita terbaru dari komunitas Jurnal.')

@section('content')
    <section class="mb-12 grid gap-8 lg:grid-cols-[1fr_auto] lg:items-end">
        <div class="max-w-2xl">
            <p class="mb-4 inline-flex items-center gap-2 rounded-full border border-line bg-white/70 px-3 py-1 text-xs font-semibold uppercase tracking-[0.16em] text-stone-500">
                <span class="size-1.5 rounded-full bg-accent"></span>
                Catatan terbaru
            </p>

            <h1 class="font-serif text-4xl font-semibold leading-[1.05] tracking-tight text-ink sm:text-5xl">
                Cerita, gagasan, dan hal-hal yang layak dibagikan.
            </h1>

            <p class="mt-5 text-base leading-7 text-stone-600 sm:text-lg">
                Kumpulan tulisan terbaru dari para penulis Jurnal. Temukan ide baru, pelajari sesuatu, lalu bagikan milikmu.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <span class="chip">{{ $posts->total() }} artikel</span>

            @auth
                <a href="{{ route('posts.create') }}" class="btn btn-primary">
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                        <path d="M12 5v14M5 12h14" />
                    </svg>
                    Buat Artikel
                </a>
            @else
                <a href="{{ route('register') }}" class="btn btn-primary">
                    Mulai menulis
                </a>
            @endauth
        </div>
    </section>

    @forelse ($posts as $post)
        @if ($loop->first)
            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @endif

        <article class="card group flex h-full flex-col p-6 transition duration-200 hover:-translate-y-1 hover:border-stone-300">
            <div class="mb-4 flex flex-wrap items-center gap-2">
                @forelse ($post->categories as $category)
                    <span class="chip-accent">{{ $category->name }}</span>
                @empty
                    <span class="chip">Tanpa kategori</span>
                @endforelse
            </div>

            <h2 class="font-serif text-2xl font-semibold leading-snug tracking-tight text-ink">
                <a href="{{ route('posts.show', $post) }}" class="transition hover:text-accent">
                    {{ $post->title }}
                </a>
            </h2>

            <p class="mt-3 line-clamp-3 flex-1 text-sm leading-6 text-stone-600">
                {{ \Illuminate\Support\Str::limit($post->content, 160) }}
            </p>

            <div class="mt-6 flex items-center justify-between gap-4 border-t border-line pt-5">
                <div class="flex min-w-0 items-center gap-2.5">
                    <span class="grid size-9 shrink-0 place-items-center rounded-full bg-stone-100 text-xs font-bold text-stone-600">
                        {{ strtoupper(substr($post->user?->name ?? '?', 0, 1)) }}
                    </span>
                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold text-ink">{{ $post->user?->name ?? 'Penulis tidak tersedia' }}</p>
                        <time class="text-xs text-stone-400" datetime="{{ $post->created_at?->toDateString() ?? '' }}">
                            {{ $post->created_at?->format('d M Y') ?? 'Tanpa tanggal' }}
                        </time>
                    </div>
                </div>

                <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-accent transition group-hover:gap-2">
                    Baca
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </article>

        @if ($loop->last)
            </div>
        @endif
    @empty
        <div class="card flex flex-col items-center px-6 py-16 text-center">
            <span class="grid size-14 place-items-center rounded-2xl bg-accent-soft text-accent">
                <svg class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z" />
                </svg>
            </span>
            <h2 class="mt-5 font-serif text-2xl font-semibold tracking-tight">Belum ada artikel</h2>
            <p class="mt-2 max-w-sm text-sm leading-6 text-stone-500">
                Jadilah penulis pertama. Bagikan satu ide hari ini dan mulai percakapan.
            </p>
            <a href="{{ auth()->check() ? route('posts.create') : route('register') }}" class="btn btn-primary mt-6">
                {{ auth()->check() ? 'Tulis artikel pertama' : 'Daftar sekarang' }}
            </a>
        </div>
    @endforelse

    @if ($posts->hasPages())
        <div class="mt-10 border-t border-line pt-6">
            {{ $posts->onEachSide(1)->links() }}
        </div>
    @endif
@endsection
