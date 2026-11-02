@php
    $selected = old('categories', $selectedCategories ?? []);
@endphp

<div class="space-y-7">
    <div>
        <label for="title" class="label">Judul Artikel</label>

        <input
            type="text"
            id="title"
            name="title"
            value="{{ old('title', $post->title ?? '') }}"
            class="field @error('title') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror"
            placeholder="Contoh: Belajar Laravel dari nol"
            autocomplete="off"
            required
        >

        @error('title')
            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
        @enderror

        <p class="mt-2 text-xs text-stone-400">Buat judul yang jelas dan menarik, maksimal 255 karakter.</p>
    </div>

    <div>
        <label for="content" class="label">Isi Artikel</label>

        <textarea
            id="content"
            name="content"
            rows="14"
            class="field min-h-72 resize-y leading-7 @error('content') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror"
            placeholder="Tuliskan ide, cerita, atau catatanmu di sini..."
            required
        >{{ old('content', $post->content ?? '') }}</textarea>

        @error('content')
            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
        @enderror

        <p class="mt-2 text-xs text-stone-400">Gunakan paragraf pendek agar artikel lebih nyaman dibaca.</p>
    </div>

    <fieldset>
        <legend class="label">Kategori Artikel</legend>
        <p class="mb-3 text-xs text-stone-400">Pilih satu atau lebih kategori yang paling relevan.</p>

        @forelse ($categories as $category)
            @if ($loop->first)
                <div class="grid gap-2 sm:grid-cols-2">
            @endif

            <label class="flex cursor-pointer items-center gap-2.5 rounded-xl border border-line bg-white px-3.5 py-3 text-sm font-medium text-stone-600 transition hover:border-stone-300 has-[:checked]:border-accent has-[:checked]:bg-accent-soft has-[:checked]:text-accent">
                <input
                    type="checkbox"
                    name="categories[]"
                    value="{{ $category->id }}"
                    class="size-4 rounded border-stone-300 accent-accent focus:ring-accent/30"
                    @checked(in_array($category->id, $selected))
                >
                {{ $category->name }}
            </label>

            @if ($loop->last)
                </div>
            @endif
        @empty
            <div class="rounded-xl border border-dashed border-line bg-stone-50 px-4 py-5 text-sm text-stone-500">
                Belum ada kategori yang tersedia. Artikel tetap bisa disimpan tanpa kategori.
            </div>
        @endforelse
    </fieldset>
</div>
