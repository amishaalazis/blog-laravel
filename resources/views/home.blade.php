@extends('layouts.app')

@section('title', 'Daftar Post')

@section('content')
    <h1>Daftar Post</h1>

    <a href="/blog/create">Tambah Post</a>

    @forelse ($posts as $post)
        <article>
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
            <p>Author: {{ $post->author }}</p>
        </article>
    @empty
        <p>Belum ada post.</p>
    @endforelse
@endsection