<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f8f4ed">
    <meta name="description" content="@yield('description', 'Jurnal — ruang untuk menulis, berbagi, dan tumbuh bersama.')">

    <title>@yield('title', 'Jurnal') &middot; Blog Laravel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {!! Vite::fonts() !!}
</head>
<body class="min-h-screen bg-paper text-ink antialiased">
    <a href="#content" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded-lg focus:bg-ink focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-white">
        Lewati ke konten
    </a>

    <div class="pointer-events-none fixed inset-x-0 top-0 -z-10 h-80 bg-linear-to-b from-orange-50 via-paper to-paper"></div>

    <header class="sticky top-0 z-40 border-b border-line/80 bg-paper/85 backdrop-blur">
        <div class="site-container flex h-16 items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="group flex items-center gap-3">
                <span class="grid size-10 place-items-center rounded-xl bg-ink text-white shadow-sm transition duration-200 group-hover:-rotate-3">
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

            <nav class="hidden items-center gap-1 md:flex" aria-label="Navigasi utama">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home', 'posts.index') ? 'nav-link-active' : '' }}">Beranda</a>

                @auth
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'nav-link-active' : '' }}">Dashboard</a>

                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin') }}" class="nav-link {{ request()->routeIs('admin') ? 'nav-link-active' : '' }}">Admin</a>
                    @endif
                @endauth
            </nav>

            <div class="flex items-center gap-2">
                @auth
                    <a href="{{ route('posts.create') }}" class="btn btn-accent">
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                        <span class="hidden sm:inline">Tulis</span>
                    </a>

                    <div class="hidden items-center gap-2.5 rounded-full border border-line bg-white/70 py-1 pl-1 pr-3 lg:flex">
                        <span class="grid size-8 place-items-center rounded-full bg-accent-soft text-xs font-bold text-accent">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                        <span class="max-w-32 truncate text-sm font-semibold">{{ auth()->user()->name }}</span>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-ghost" title="Keluar dari akun">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-ghost">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
                @endauth
            </div>
        </div>

        <nav class="site-container flex items-center gap-1 overflow-x-auto pb-3 md:hidden" aria-label="Navigasi seluler">
            <a href="{{ route('home') }}" class="nav-link whitespace-nowrap {{ request()->routeIs('home', 'posts.index') ? 'nav-link-active' : '' }}">Beranda</a>

            @auth
                <a href="{{ route('dashboard') }}" class="nav-link whitespace-nowrap {{ request()->routeIs('dashboard') ? 'nav-link-active' : '' }}">Dashboard</a>

                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin') }}" class="nav-link whitespace-nowrap {{ request()->routeIs('admin') ? 'nav-link-active' : '' }}">Admin</a>
                @endif
            @endauth
        </nav>
    </header>

    <main id="content" class="site-container py-10 sm:py-14">
        @if (session('success'))
            <div class="mb-8 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="status">
                <svg class="mt-0.5 size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <path d="m9 11 3 3L22 4" />
                </svg>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-8 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">
                <p class="font-semibold">Terjadi kesalahan pada input:</p>
                <ul class="mt-1 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="border-t border-line bg-white/40">
        <div class="site-container flex flex-col gap-2 py-8 text-sm text-stone-500 sm:flex-row sm:items-center sm:justify-between">
            <p>&copy; {{ date('Y') }} Jurnal. Dibangun dengan Laravel.</p>
            <p class="flex items-center gap-2">
                <span class="size-2 rounded-full bg-emerald-500"></span>
                Semua sistem berjalan normal
            </p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
