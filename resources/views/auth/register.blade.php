<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Daftar - Wisata Trenggalek</title>

    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@600;700;800;900&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#2f6287",
                        "on-secondary-container": "#3d5481",
                        "on-primary": "#ffffff",
                        "error-container": "#ffdad6",
                        "error": "#ba1a1a",
                        "on-surface": "#191c23",
                        "inverse-surface": "#2d3038",
                        "background": "#f9f9ff",
                        "surface-container-high": "#e6e8f2",
                        "on-tertiary-fixed-variant": "#783100",
                        "tertiary-fixed": "#ffdbcb",
                        "tertiary-container": "#c55500",
                        "surface-tint": "#2f6388",
                        "on-primary-fixed-variant": "#0e4b6e",
                        "tertiary-fixed-dim": "#ffb691",
                        "surface-container-low": "#f2f3fd",
                        "surface-bright": "#f9f9ff",
                        "on-secondary-fixed": "#001a41",
                        "tertiary": "#9e4300",
                        "primary-fixed-dim": "#9bccf6",
                        "on-primary-fixed": "#001e30",
                        "on-primary-container": "#ffffff",
                        "on-background": "#191c23",
                        "on-tertiary": "#ffffff",
                        "primary-container": "#4a7ba2",
                        "outline-variant": "#c1c6d6",
                        "surface-container-lowest": "#ffffff",
                        "secondary-fixed-dim": "#afc7fb",
                        "on-error-container": "#93000a",
                        "surface-variant": "#e0e2ec",
                        "on-surface-variant": "#414754",
                        "on-secondary-fixed-variant": "#2e4673",
                        "secondary": "#475e8c",
                        "surface-container": "#ecedf7",
                        "outline": "#727785",
                        "inverse-on-surface": "#eff0fa",
                        "surface-dim": "#d8d9e3",
                        "secondary-container": "#b2c9fe",
                        "on-tertiary-container": "#0e0200",
                        "inverse-primary": "#9bccf6",
                        "surface-container-highest": "#e0e2ec",
                        "secondary-fixed": "#d8e2ff",
                        "on-secondary": "#ffffff",
                        "surface": "#f9f9ff",
                        "on-tertiary-fixed": "#341100",
                        "on-error": "#ffffff",
                        "primary-fixed": "#cbe6ff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Public Sans"],
                        "display": ["Public Sans"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .text-glass-shadow {
            text-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface min-h-screen flex flex-col">

{{-- ============== HEADER (sama persis dengan login) ============== --}}
<header class="sticky top-0 z-50 bg-surface/80 dark:bg-slate-900/80 backdrop-blur-sm border-b border-slate-200 dark:border-slate-800">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between whitespace-nowrap h-16">
            <div class="flex items-center gap-4 text-slate-900 dark:text-white">
                <div class="w-7 h-7 text-primary">
                    <svg fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path d="M42.4379 44C42.4379 44 36.0744 33.9038 41.1692 24C46.8624 12.9336 42.2078 4 42.2078 4L7.01134 4C7.01134 4 11.6577 12.932 5.96912 23.9969C0.876273 33.9029 7.27094 44 7.27094 44L42.4379 44Z" fill="currentColor"></path>
                    </svg>
                </div>
                <h2 class="text-lg font-bold tracking-[-0.015em]">Wisata Trenggalek</h2>
            </div>

            <div class="hidden md:flex flex-1 justify-end gap-8">
                <nav class="flex items-center gap-9">
                    <a class="text-sm font-medium hover:text-primary dark:hover:text-primary transition-colors" href="{{ route('home') }}">Home</a>
                    <a class="text-sm font-medium hover:text-primary dark:hover:text-primary transition-colors" href="{{ route('destinasi.index') }}">Destinasi</a>
                    <a class="text-sm font-medium hover:text-primary dark:hover:text-primary transition-colors" href="{{ route('rekomendasi.pso') }}">Rekomendasi Cerdas</a>
                    <a class="text-sm font-medium hover:text-primary dark:hover:text-primary transition-colors" href="{{ route('about') }}">Tentang</a>
                </nav>

                <div class="flex items-center gap-4">
                    @auth
                        <div class="flex items-center gap-4 border-l pl-6 border-slate-200 dark:border-slate-700">
                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">
                                {{ Auth::user()->name }}
                            </span>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="flex items-center justify-center rounded-lg h-10 w-10 text-red-500 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 transition-colors" title="Logout">
                                    <span class="material-symbols-outlined">logout</span>
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex gap-2">
                            <a href="{{ route('login') }}" class="flex min-w-[84px] cursor-pointer items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-colors">
                                <span class="truncate">Login</span>
                            </a>
                        </div>
                    @endauth
                </div>
            </div>

            <div class="md:hidden">
                <button class="flex items-center justify-center rounded-lg h-10 w-10 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                    <span class="material-symbols-outlined text-2xl">menu</span>
                </button>
            </div>
        </div>
    </div>
</header>

{{-- ============== MAIN / FORM REGISTER ============== --}}
<main class="flex-grow flex flex-col md:flex-row min-h-[calc(100vh-160px)]">

    {{-- Kolom Kiri — Gambar (sama dengan login) --}}
    <section class="relative w-full md:w-1/2 min-h-[400px] md:min-h-full overflow-hidden">
        <img alt="Trenggalek Landscape"
             class="absolute inset-0 w-full h-full object-cover"
             src="https://sidita.disbudpar.jatimprov.go.id/storage/foto-dtw/52e1b_1708922197.jpg"/>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent flex flex-col justify-end p-12 md:p-20">
            <h1 class="font-headline font-black text-5xl md:text-7xl text-white tracking-tight leading-none text-glass-shadow mb-4">
                Join<br/>Trenggalek
            </h1>
            <p class="text-white/90 text-lg md:text-xl font-medium max-w-md text-glass-shadow">
                Create your account and start planning your perfect trip to the hidden gem of East Java.
            </p>
        </div>
    </section>

    {{-- Kolom Kanan — Form Register --}}
    <section class="w-full md:w-1/2 flex items-center justify-center p-8 md:p-16 bg-surface">
        <div class="w-full max-w-md flex flex-col gap-8">
            <div class="space-y-2">
                <h2 class="font-headline font-extrabold text-4xl text-primary tracking-tight">Create Account</h2>
                <p class="text-on-surface-variant font-medium">Fill in your details to get started.</p>
            </div>

            <div class="flex flex-col gap-4">
                {{-- Google Sign Up --}}
                <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center gap-3 py-3 px-6 bg-surface-container-lowest border border-outline-variant/20 rounded-lg font-semibold text-on-surface hover:bg-surface-container-low transition-colors duration-200">
                    <svg class="w-5 h-5" viewbox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"></path>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
                    </svg>
                    Sign up with Google
                </a>

                <div class="relative flex items-center py-4">
                    <div class="flex-grow border-t border-outline-variant/30"></div>
                    <span class="flex-shrink mx-4 text-xs font-bold uppercase tracking-widest text-outline">Or use email</span>
                    <div class="flex-grow border-t border-outline-variant/30"></div>
                </div>

                {{-- Form Register --}}
                <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5">
                    @csrf

                    {{-- Nama --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-on-surface-variant px-1" for="name">Full Name</label>
                        <input class="w-full px-4 py-3 rounded-lg bg-surface-container-high border-none focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all duration-200"
                               id="name" name="name" value="{{ old('name') }}" placeholder="Nama lengkap Anda" type="text" required autofocus/>
                        @error('name')
                            <span class="text-error text-xs font-semibold px-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-on-surface-variant px-1" for="email">Email Address</label>
                        <input class="w-full px-4 py-3 rounded-lg bg-surface-container-high border-none focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all duration-200"
                               id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" type="email" required/>
                        @error('email')
                            <span class="text-error text-xs font-semibold px-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-on-surface-variant px-1" for="password">Password</label>
                        <div class="relative">
                            <input class="w-full px-4 py-3 rounded-lg bg-surface-container-high border-none focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all duration-200"
                                   id="password" name="password" placeholder="••••••••" type="password" required/>
                            <button class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-primary transition-colors" type="button" onclick="togglePassword('password', 'pw_icon')">
                                <span class="material-symbols-outlined text-xl" id="pw_icon">visibility</span>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-error text-xs font-semibold px-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-on-surface-variant px-1" for="password_confirmation">Confirm Password</label>
                        <div class="relative">
                            <input class="w-full px-4 py-3 rounded-lg bg-surface-container-high border-none focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all duration-200"
                                   id="password_confirmation" name="password_confirmation" placeholder="••••••••" type="password" required/>
                            <button class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-primary transition-colors" type="button" onclick="togglePassword('password_confirmation', 'pw_confirm_icon')">
                                <span class="material-symbols-outlined text-xl" id="pw_confirm_icon">visibility</span>
                            </button>
                        </div>
                    </div>

                    <button class="w-full py-4 bg-primary text-on-primary font-bold rounded-lg mt-2 shadow-lg shadow-primary/20 hover:bg-primary-container transition-all active:scale-[0.98]" type="submit">
                        Buat Akun
                    </button>
                </form>
            </div>

            <div class="text-center pt-4">
                <p class="text-on-surface-variant font-medium">
                    Sudah punya akun?
                    <a class="text-primary font-bold hover:underline underline-offset-4 ml-1" href="{{ route('login') }}">Login</a>
                </p>
            </div>
        </div>
    </section>
</main>

{{-- ============== FOOTER (sama dengan login) ============== --}}
<footer class="bg-slate-900 text-white">
    <div class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-7 h-7 text-white">
                        <svg fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path d="M42.4379 44C42.4379 44 36.0744 33.9038 41.1692 24C46.8624 12.9336 42.2078 4 42.2078 4L7.01134 4C7.01134 4 11.6577 12.932 5.96912 23.9969C0.876273 33.9029 7.27094 44 7.27094 44L42.4379 44Z" fill="currentColor"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold">Wisata Trenggalek</h3>
                </div>
                <p class="text-slate-400 text-sm">Portal informasi pariwisata resmi Kabupaten Trenggalek, membantu Anda menemukan pesona tersembunyi dengan rekomendasi cerdas berbasis algoritma PSO.</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Tautan Cepat</h4>
                <ul class="space-y-2">
                    <li><a class="text-slate-400 hover:text-white text-sm transition-colors" href="{{ route('destinasi.index') }}">Destinasi</a></li>
                    <li><a class="text-slate-400 hover:text-white text-sm transition-colors" href="{{ route('rekomendasi.pso') }}">Rekomendasi Cerdas</a></li>
                    <li><a class="text-slate-400 hover:text-white text-sm transition-colors" href="{{ route('about') }}">Tentang</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Kontak</h4>
                <ul class="space-y-2 text-slate-400 text-sm">
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-lg mt-0.5">location_on</span>
                        <span>Dinas Pariwisata Trenggalek, Jawa Timur</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">mail</span>
                        <a class="hover:text-white transition-colors" href="mailto:info@trenggalektourism.go.id">info@trenggalektourism.go.id</a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-slate-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-slate-500 text-sm">
            <p>© {{ date('Y') }} Sistem Informasi Pariwisata Kabupaten Trenggalek. Hak Cipta Dilindungi.</p>
            <div class="flex items-center gap-2">
                <span class="text-[10px] uppercase tracking-widest bg-slate-800 px-3 py-1 rounded-full text-slate-400 flex items-center gap-1">
                    <span class="material-symbols-outlined text-[12px]">bolt</span>
                    Powered by PSO Algorithm
                </span>
            </div>
        </div>
    </div>
</footer>

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility';
        }
    }
</script>

</body>
</html>