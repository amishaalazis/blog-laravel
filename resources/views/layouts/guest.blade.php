<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#1c1917">
    <meta name="description" content="@yield('description', 'Masuk ke Jurnal untuk mulai menulis dan berbagi cerita.')">

    <title>@yield('title', 'Masuk') &middot; Jurnal</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {!! Vite::fonts() !!}
</head>
<body class="min-h-screen bg-paper text-ink antialiased">
    <div class="grid min-h-screen lg:grid-cols-[1.05fr_1fr]">
        <aside class="relative hidden overflow-hidden bg-ink p-12 text-white lg:flex lg:flex-col lg:justify-between">
            <div class="pointer-events-none absolute -right-24 -top-24 size-96 rounded-full bg-accent/30 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-32 -left-20 size-96 rounded-full bg-orange-300/10 blur-3xl"></div>

            <a href="{{ route('home') }}" class="relative flex items-center gap-3">
                <span class="grid size-11 place-items-center rounded-xl bg-white text-ink shadow-sm">
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 20h9" />
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z" />
                    </svg>
                </span>
                <span class="leading-tight">
                    <span class="block font-serif text-xl font-semibold tracking-tight">Jurnal</span>
                    <span class="block text-[10px] font-semibold uppercase tracking-[0.22em] text-stone-400">Blog Laravel</span>
                </span>
            </a>

            <div class="relative max-w-md">
                <p class="mb-4 inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-3 py-1 text-xs font-medium text-stone-300">
                    <span class="size-1.5 rounded-full bg-emerald-400"></span>
                    Ruang menulis yang tenang
                </p>
                <h2 class="font-serif text-4xl font-semibold leading-tight tracking-tight">
                    Tempat ide kecil tumbuh menjadi cerita besar.
                </h2>
                <p class="mt-5 text-base leading-7 text-stone-400">
                    Tulis artikel, susun kategori, dan bagikan pemikiranmu dalam satu ruang yang sederhana dan nyaman.
                </p>
            </div>

            <div class="relative flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 p-4">
                <span class="grid size-10 shrink-0 place-items-center rounded-full bg-accent-soft text-sm font-bold text-accent">J</span>
                <div>
                    <p class="text-sm font-medium text-stone-200">&ldquo;Menulis adalah cara berpikir dua kali.&rdquo;</p>
                    <p class="mt-1 text-xs text-stone-500">Jurnal &middot; Catatan harian</p>
                </div>
            </div>
        </aside>

        <main class="flex min-h-screen items-center justify-center px-4 py-12 sm:px-8">
            <div class="w-full max-w-md">
                <a href="{{ route('home') }}" class="mb-8 inline-flex items-center gap-3 lg:hidden">
                    <span class="grid size-10 place-items-center rounded-xl bg-ink text-white shadow-sm">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M12 20h9" />
                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z" />
                        </svg>
                    </span>
                    <span class="leading-tight">
                        <span class="block font-serif text-lg font-semibold tracking-tight">Jurnal</span>
                        <span class="block text-[10px] font-semibold uppercase tracking-[0.22em] text-stone-400">Blog Laravel</span>
                    </span>
                </a>

                <div class="card p-6 sm:p-8">
                    @yield('content')
                </div>

                <p class="mt-6 text-center text-xs text-stone-400">
                    &copy; {{ date('Y') }} Jurnal. Dibangun dengan Laravel.
                </p>
            </div>
        </main>
    </div>
</body>
</html>
