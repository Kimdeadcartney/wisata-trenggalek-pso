<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Wisata Trenggalek - Jelajahi Pesona Tersembunyi')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#135bec",
                        "background-light": "#f6f6f8",
                        "background-dark": "#101622",
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "Noto Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-800 dark:text-slate-200">
    <div class="relative flex min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        
        <header class="sticky top-0 z-50 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm border-b border-slate-200 dark:border-slate-800">
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
                            <a class="text-sm font-medium hover:text-primary dark:hover:text-primary" href="{{ route('home') }}">Home</a>
                            <a class="text-sm font-medium hover:text-primary dark:hover:text-primary" href="{{ route('destinasi.index') }}">Destinasi</a>
                            <a class="text-sm font-medium hover:text-primary dark:hover:text-primary" href="{{ route('rekomendasi.pso') }}">Rekomendasi Cerdas</a>
                        </nav>
                        
                        <div class="flex gap-2 items-center">
                            @auth
                                <div class="flex items-center gap-4 border-l pl-6 border-slate-200 dark:border-slate-700">
                                    <span class="text-sm font-bold text-primary">{{ Auth::user()->name }}</span>
                                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="flex items-center text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 p-2 rounded-lg transition-colors">
                                            <span class="material-symbols-outlined">logout</span>
                                        </button>
                                    </form>
                                </div>
                            @else
                                <a href="{{ route('login') }}" class="flex min-w-[84px] cursor-pointer items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-colors">
                                    Login
                                </a>
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

        <main class="flex-grow">
            @yield('content')
        </main>

        <footer class="bg-slate-900 text-white mt-auto">
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
                        <ul class="space-y-2 text-sm text-slate-400">
                            <li><a class="hover:text-white transition-colors" href="{{ route('destinasi.index') }}">Destinasi</a></li>
                            <li><a class="hover:text-white transition-colors" href="{{ route('rekomendasi.pso') }}">Rekomendasi Cerdas</a></li>
                            <li><a class="hover:text-white transition-colors" href="#">Tentang</a></li>
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
                    <p>© {{ date('Y') }} Sistem Informasi Pariwisata Kabupaten Trenggalek.</p>
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] uppercase tracking-widest bg-slate-800 px-3 py-1 rounded-full text-slate-400 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[12px]">bolt</span>
                            Powered by PSO Algorithm
                        </span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>