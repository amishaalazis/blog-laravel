@extends('layouts.app')

@section('title', 'Edit Artikel')
@section('description', 'Perbarui isi dan kategori artikelmu.')

@section('content')
    <div class="mx-auto max-w-3xl">
        <a href="{{ route('posts.show', $post) }}" class="mb-8 inline-flex items-center gap-2 text-sm font-semibold text-stone-500 transition hover:text-ink">
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M19 12H5M12 19l-7-7 7-7" />
            </svg>
            Kembali ke artikel
        </a>

        <header class="mb-8">
            <p class="mb-3 inline-flex items-center gap-2 rounded-full border border-line bg-white/70 px-3 py-1 text-xs font-semibold uppercase tracking-[0.16em] text-stone-500">
                <span class="size-1.5 rounded-full bg-accent"></span>
                Perbarui tulisan
            </p>
            <h1 class="font-serif text-4xl font-semibold tracking-tight text-ink sm:text-5xl">Edit Artikel</h1>
            <p class="mt-3 text-base leading-7 text-stone-600">
                Perbaiki detail, rapikan kalimat, atau tambahkan kategori baru.
            </p>
        </header>

        <form action="{{ route('posts.update', $post) }}" method="POST" class="card p-6 sm:p-8">
            @csrf
            @method('PUT')

            @include('posts._form', ['selectedCategories' => $selectedCategories])

            <div class="mt-8 flex flex-col-reverse gap-3 border-t border-line pt-6 sm:flex-row sm:items-center sm:justify-between">
                <a href="{{ route('posts.show', $post) }}" class="btn btn-ghost">Batal</a>

                <button type="submit" class="btn btn-primary">
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z" />
                        <path d="M17 21v-8H7v8M7 3v5h8" />
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
