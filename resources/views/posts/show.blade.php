@extends('layouts.app')

@section('title', $post->title)
@section('description', \Illuminate\Support\Str::limit(strip_tags($post->content), 150))

@php
    $readingTime = max(1, (int) ceil(str_word_count(strip_tags($post->content)) / 200));
    $isUpdated = $post->updated_at && $post->created_at && $post->updated_at->gt($post->created_at);
@endphp

@section('content')
    <div class="mx-auto max-w-3xl">
        <a href="{{ route('posts.index') }}" class="mb-8 inline-flex items-center gap-2 text-sm font-semibold text-stone-500 transition hover:text-ink">
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M19 12H5M12 19l-7-7 7-7" />
            </svg>
            Kembali ke daftar artikel
        </a>

        <article>
            <header class="mb-8">
                <div class="mb-5 flex flex-wrap items-center gap-2">
                    @forelse ($post->categories as $category)
                        <span class="chip-accent">{{ $category->name }}</span>
                    @empty
                        <span class="chip">Tanpa kategori</span>
                    @endforelse
                </div>

                <h1 class="font-serif text-4xl font-semibold leading-[1.08] tracking-tight text-ink sm:text-5xl">
                    {{ $post->title }}
                </h1>

                <div class="mt-7 flex flex-wrap items-center justify-between gap-4 border-y border-line py-4">
                    <div class="flex items-center gap-3">
                        <span class="grid size-11 place-items-center rounded-full bg-accent-soft text-sm font-bold text-accent">
                            {{ strtoupper(substr($post->user?->name ?? '?', 0, 1)) }}
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-ink">{{ $post->user?->name ?? 'Penulis tidak tersedia' }}</p>
                            <p class="mt-0.5 flex flex-wrap items-center gap-2 text-xs text-stone-400">
                                <time datetime="{{ $post->created_at?->toDateString() ?? '' }}">{{ $post->created_at?->format('d M Y') ?? 'Tanpa tanggal' }}</time>
                                <span aria-hidden="true">&middot;</span>
                                <span>{{ $readingTime }} menit baca</span>
                                @if ($isUpdated)
                                    <span aria-hidden="true">&middot;</span>
                                    <span>Diperbarui {{ $post->updated_at->format('d M Y') }}</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    @canany(['update', 'delete'], $post)
                        <div class="flex flex-wrap items-center gap-2">
                            @can('update', $post)
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-ghost">
                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M12 20h9" />
                                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z" />
                                    </svg>
                                    Edit
                                </a>
                            @endcan

                            @can('delete', $post)
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">
                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6M10 11v6M14 11v6" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            @endcan
                        </div>
                    @endcanany
                </div>
            </header>

            <div class="card p-6 sm:p-10">
                <div class="article-body whitespace-pre-line">{{ $post->content }}</div>
            </div>
        </article>

        <footer class="mt-10 flex flex-col gap-4 border-t border-line pt-6 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-stone-500">Terima kasih sudah membaca.</p>
            <a href="{{ route('posts.index') }}" class="btn btn-ghost self-start sm:self-auto">
                Lihat artikel lainnya
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
            </a>
        </footer>
    </div>
@endsection
