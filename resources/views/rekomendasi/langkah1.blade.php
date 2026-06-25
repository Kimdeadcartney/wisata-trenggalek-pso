<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rekomendasi PSO Trenggalek</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <style type="text/tailwindcss">
        :root {
            --primary: #135bec;
            --background-light: #f6f6f8;
            --background-dark: #101622;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .category-radio:checked + .category-content {
            @apply border-primary ring-2 ring-primary/20 bg-primary/5;
        }
        .category-radio:checked + .category-content .icon-bg {
            @apply bg-primary text-white;
        }
        .category-radio:checked + .category-content .check-indicator {
            @apply opacity-100;
        }
        .category-content:hover .icon-bg {
            @apply bg-primary/10 text-primary;
        }
    </style>

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#135bec",
                        "background-light": "#f6f6f8",
                        "background-dark": "#101622",
                    },
                    fontFamily: { "display": ["Plus Jakarta Sans", "Noto Sans", "sans-serif"] },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-[#111318] dark:text-gray-200">
<div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
    <div class="flex h-full grow flex-col">
        <div class="px-4 sm:px-8 md:px-20 lg:px-40 flex flex-1 justify-center py-5">
            <div class="flex flex-col max-w-[960px] flex-1">

                {{-- ── Header ── --}}
                <header class="sticky top-0 z-50 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm border-b border-slate-200 dark:border-slate-800">
                    <div class="container mx-auto px-4">
                        <div class="flex items-center justify-between whitespace-nowrap h-16">
                            <div class="flex items-center gap-4 text-slate-900 dark:text-white">
                                <div class="w-7 h-7 text-primary">
                                    <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M42.4379 44C42.4379 44 36.0744 33.9038 41.1692 24C46.8624 12.9336 42.2078 4 42.2078 4L7.01134 4C7.01134 4 11.6577 12.932 5.96912 23.9969C0.876273 33.9029 7.27094 44 7.27094 44L42.4379 44Z" fill="currentColor"/>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-bold tracking-[-0.015em]">Wisata Trenggalek</h2>
                            </div>

                            <div class="hidden md:flex flex-1 justify-end gap-8">
                                <nav class="flex items-center gap-9">
                                    <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ route('home') }}">Home</a>
                                    <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ route('destinasi.index') }}">Destinasi</a>
                                    <a class="text-sm font-medium text-primary font-bold" href="{{ route('rekomendasi.pso') }}">Rekomendasi Cerdas</a>
                                    <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ route('about') }}">Tentang</a>
                                </nav>
                                <div class="flex items-center gap-4">
                                    @auth
                                        <div class="flex items-center gap-4 border-l pl-6 border-slate-200 dark:border-slate-700">
                                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ Auth::user()->name }}</span>
                                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="flex items-center justify-center rounded-lg h-10 w-10 text-red-500 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 transition-colors" title="Logout">
                                                    <span class="material-symbols-outlined">logout</span>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <a href="{{ route('login') }}" class="flex min-w-[84px] cursor-pointer items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-colors">
                                            <span class="truncate">Login</span>
                                        </a>
                                    @endauth
                                </div>
                            </div>

                        <div class="md:hidden">
    <button id="mobile-menu-btn" onclick="toggleMobileMenu()" class="flex items-center justify-center rounded-lg h-10 w-10 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
        <span id="mobile-menu-icon" class="material-symbols-outlined text-2xl">menu</span>
    </button>
</div>
                        </div>
                    </div>
                </header>
<!-- Mobile Menu Dropdown -->
<div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 shadow-lg">
    <nav class="container mx-auto px-4 py-3 flex flex-col">
        <a href="{{ route('home') }}" class="flex items-center gap-3 py-3 px-2 text-sm font-medium text-slate-800 dark:text-slate-200 hover:text-primary dark:hover:text-primary border-b border-slate-100 dark:border-slate-800 transition-colors">
            <span class="material-symbols-outlined text-xl">home</span> Home
        </a>
        <a href="{{ route('destinasi.index') }}" class="flex items-center gap-3 py-3 px-2 text-sm font-medium text-slate-800 dark:text-slate-200 hover:text-primary dark:hover:text-primary border-b border-slate-100 dark:border-slate-800 transition-colors">
            <span class="material-symbols-outlined text-xl">explore</span> Destinasi
        </a>
        <a href="{{ route('rekomendasi.pso') }}" class="flex items-center gap-3 py-3 px-2 text-sm font-medium text-slate-800 dark:text-slate-200 hover:text-primary dark:hover:text-primary border-b border-slate-100 dark:border-slate-800 transition-colors">
            <span class="material-symbols-outlined text-xl">bolt</span> Rekomendasi Cerdas
        </a>
        <a href="{{ route('about') }}" class="flex items-center gap-3 py-3 px-2 text-sm font-medium text-slate-800 dark:text-slate-200 hover:text-primary dark:hover:text-primary border-b border-slate-100 dark:border-slate-800 transition-colors">
            <span class="material-symbols-outlined text-xl">info</span> Tentang
        </a>
        <div class="pt-3 pb-1">
            @auth
                <div class="flex items-center justify-between px-2 py-2">
                    <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center gap-1 text-red-500 text-sm font-medium">
                            <span class="material-symbols-outlined text-xl">logout</span> Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="flex w-full items-center justify-center rounded-lg h-11 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-colors">
                    Login
                </a>
            @endauth
        </div>
    </nav>
</div>
                {{-- ── Main ── --}}
                <main class="flex-1 py-10 px-4">

                    {{-- Judul --}}
                    <div class="flex flex-col gap-2 mb-8 text-center max-w-2xl mx-auto">
                        <h1 class="text-[#111318] dark:text-white text-3xl font-black leading-tight tracking-tight">
                            Apa Kategori Wisata Favorit Anda?
                        </h1>
                        <p class="text-[#616f89] dark:text-gray-400 text-base">
                            Pilih satu atau lebih kategori yang paling menarik untuk membantu algoritma PSO menemukan destinasi terbaik.
                        </p>
                    </div>

                    {{-- Progress bar --}}
                    <div class="flex flex-col gap-3 max-w-xl mx-auto mb-12">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-bold text-primary px-3 py-1 bg-primary/10 rounded-full">Langkah 1 dari 4</span>
                            <span class="text-sm font-medium text-gray-500">25% Selesai</span>
                        </div>
                        <div class="h-2 w-full bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-primary w-1/4 rounded-full transition-all duration-500"></div>
                        </div>
                    </div>

                    {{-- Error validasi --}}
                    @if($errors->any())
                    <div class="max-w-2xl mx-auto mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl flex items-start gap-3">
                        <span class="material-symbols-outlined text-red-500 mt-0.5">error</span>
                        <div>
                            <p class="text-sm font-bold text-red-700 dark:text-red-400">{{ $errors->first() }}</p>
                        </div>
                    </div>
                    @endif

                    {{-- Form Pilih Kategori --}}
                    <form action="{{ route('rekomendasi.simpanLangkah1') }}" method="POST" class="space-y-10">
                        @csrf

                        {{--
                            DAFTAR KATEGORI — disesuaikan dengan data yang ada di database:
                            ✅ Pantai        → DB: Pantai
                            ✅ Alam          → DB: Alam, Bukit, Hutan, Agrowisata
                            ✅ Budaya        → DB: Budaya, Desa Wisata
                            ✅ Gua & Karst   → DB: Goa        (value="gua" dipetakan controller)
                            ✅ Air Terjun    → DB: Air Terjun  (menggantikan Religi yang tidak ada di DB)
                            ✅ Kuliner       → DB: Kuliner
                            ✅ Wisata Buatan → DB: Wisata Buatan
                        --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">

                            {{-- Pantai --}}
                            <label class="relative group cursor-pointer">
                                <input class="category-radio hidden" name="categories[]" type="checkbox"
                                       value="pantai" {{ in_array('pantai', old('categories', [])) ? 'checked' : '' }}>
                                <div class="category-content flex flex-col items-center p-6 bg-white dark:bg-background-dark border-2 border-transparent rounded-2xl shadow-sm hover:shadow-md transition-all h-full">
                                    <div class="icon-bg size-16 rounded-2xl bg-blue-50 dark:bg-gray-800 flex items-center justify-center text-primary mb-4 transition-colors">
                                        <span class="material-symbols-outlined text-4xl">beach_access</span>
                                    </div>
                                    <h3 class="text-base font-bold text-[#111318] dark:text-white mb-1">Pantai</h3>
                                    <p class="text-xs text-center text-[#616f89] dark:text-gray-400">Pesisir selatan dengan pasir putih dan ombak memukau.</p>
                                    <div class="check-indicator absolute top-3 right-3 opacity-0 transition-opacity">
                                        <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1">check_circle</span>
                                    </div>
                                </div>
                            </label>

                            {{-- Alam & Pegunungan --}}
                            <label class="relative group cursor-pointer">
                                <input class="category-radio hidden" name="categories[]" type="checkbox"
                                       value="alam" {{ in_array('alam', old('categories', [])) ? 'checked' : '' }}>
                                <div class="category-content flex flex-col items-center p-6 bg-white dark:bg-background-dark border-2 border-transparent rounded-2xl shadow-sm hover:shadow-md transition-all h-full">
                                    <div class="icon-bg size-16 rounded-2xl bg-blue-50 dark:bg-gray-800 flex items-center justify-center text-primary mb-4 transition-colors">
                                        <span class="material-symbols-outlined text-4xl">landscape</span>
                                    </div>
                                    <h3 class="text-base font-bold text-[#111318] dark:text-white mb-1">Alam &amp; Pegunungan</h3>
                                    <p class="text-xs text-center text-[#616f89] dark:text-gray-400">Udara sejuk, hutan, agrowisata dan bukit pemandangan.</p>
                                    <div class="check-indicator absolute top-3 right-3 opacity-0 transition-opacity">
                                        <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1">check_circle</span>
                                    </div>
                                </div>
                            </label>

                            {{-- Budaya & Sejarah --}}
                            <label class="relative group cursor-pointer">
                                <input class="category-radio hidden" name="categories[]" type="checkbox"
                                       value="budaya" {{ in_array('budaya', old('categories', [])) ? 'checked' : '' }}>
                                <div class="category-content flex flex-col items-center p-6 bg-white dark:bg-background-dark border-2 border-transparent rounded-2xl shadow-sm hover:shadow-md transition-all h-full">
                                    <div class="icon-bg size-16 rounded-2xl bg-blue-50 dark:bg-gray-800 flex items-center justify-center text-primary mb-4 transition-colors">
                                        <span class="material-symbols-outlined text-4xl">temple_hindu</span>
                                    </div>
                                    <h3 class="text-base font-bold text-[#111318] dark:text-white mb-1">Budaya &amp; Sejarah</h3>
                                    <p class="text-xs text-center text-[#616f89] dark:text-gray-400">Kesenian, upacara adat, dan desa wisata khas Trenggalek.</p>
                                    <div class="check-indicator absolute top-3 right-3 opacity-0 transition-opacity">
                                        <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1">check_circle</span>
                                    </div>
                                </div>
                            </label>

                            {{-- Gua & Karst --}}
                            <label class="relative group cursor-pointer">
                                <input class="category-radio hidden" name="categories[]" type="checkbox"
                                       value="gua" {{ in_array('gua', old('categories', [])) ? 'checked' : '' }}>
                                <div class="category-content flex flex-col items-center p-6 bg-white dark:bg-background-dark border-2 border-transparent rounded-2xl shadow-sm hover:shadow-md transition-all h-full">
                                    <div class="icon-bg size-16 rounded-2xl bg-blue-50 dark:bg-gray-800 flex items-center justify-center text-primary mb-4 transition-colors">
                                        <span class="material-symbols-outlined text-4xl">mountain_flag</span>
                                    </div>
                                    <h3 class="text-base font-bold text-[#111318] dark:text-white mb-1">Gua &amp; Karst</h3>
                                    <p class="text-xs text-center text-[#616f89] dark:text-gray-400">Eksplorasi Goa Lowo, goa alam, dan taman batu karst.</p>
                                    <div class="check-indicator absolute top-3 right-3 opacity-0 transition-opacity">
                                        <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1">check_circle</span>
                                    </div>
                                </div>
                            </label>

                            {{-- Air Terjun — MENGGANTIKAN "Wisata Religi" yang tidak ada di database --}}
                            <label class="relative group cursor-pointer">
                                <input class="category-radio hidden" name="categories[]" type="checkbox"
                                       value="air terjun" {{ in_array('air terjun', old('categories', [])) ? 'checked' : '' }}>
                                <div class="category-content flex flex-col items-center p-6 bg-white dark:bg-background-dark border-2 border-transparent rounded-2xl shadow-sm hover:shadow-md transition-all h-full">
                                    <div class="icon-bg size-16 rounded-2xl bg-blue-50 dark:bg-gray-800 flex items-center justify-center text-primary mb-4 transition-colors">
                                        <span class="material-symbols-outlined text-4xl">water</span>
                                    </div>
                                    <h3 class="text-base font-bold text-[#111318] dark:text-white mb-1">Air Terjun</h3>
                                    <p class="text-xs text-center text-[#616f89] dark:text-gray-400">Coban dan air terjun alami di tengah hutan pegunungan.</p>
                                    <div class="check-indicator absolute top-3 right-3 opacity-0 transition-opacity">
                                        <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1">check_circle</span>
                                    </div>
                                </div>
                            </label>

                            {{-- Kuliner --}}
                            <label class="relative group cursor-pointer">
                                <input class="category-radio hidden" name="categories[]" type="checkbox"
                                       value="kuliner" {{ in_array('kuliner', old('categories', [])) ? 'checked' : '' }}>
                                <div class="category-content flex flex-col items-center p-6 bg-white dark:bg-background-dark border-2 border-transparent rounded-2xl shadow-sm hover:shadow-md transition-all h-full">
                                    <div class="icon-bg size-16 rounded-2xl bg-blue-50 dark:bg-gray-800 flex items-center justify-center text-primary mb-4 transition-colors">
                                        <span class="material-symbols-outlined text-4xl">restaurant</span>
                                    </div>
                                    <h3 class="text-base font-bold text-[#111318] dark:text-white mb-1">Kuliner</h3>
                                    <p class="text-xs text-center text-[#616f89] dark:text-gray-400">Nasi gegok, ayam lodho, dan olahan ikan laut segar khas Trenggalek.</p>
                                    <div class="check-indicator absolute top-3 right-3 opacity-0 transition-opacity">
                                        <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1">check_circle</span>
                                    </div>
                                </div>
                            </label>

                            {{-- Wisata Buatan --}}
                            <label class="relative group cursor-pointer">
                                <input class="category-radio hidden" name="categories[]" type="checkbox"
                                       value="wisata buatan" {{ in_array('wisata buatan', old('categories', [])) ? 'checked' : '' }}>
                                <div class="category-content flex flex-col items-center p-6 bg-white dark:bg-background-dark border-2 border-transparent rounded-2xl shadow-sm hover:shadow-md transition-all h-full">
                                    <div class="icon-bg size-16 rounded-2xl bg-blue-50 dark:bg-gray-800 flex items-center justify-center text-primary mb-4 transition-colors">
                                        <span class="material-symbols-outlined text-4xl">attractions</span>
                                    </div>
                                    <h3 class="text-base font-bold text-[#111318] dark:text-white mb-1">Wisata Buatan</h3>
                                    <p class="text-xs text-center text-[#616f89] dark:text-gray-400">Taman kota, waterpark, dan fasilitas wisata dalam kota.</p>
                                    <div class="check-indicator absolute top-3 right-3 opacity-0 transition-opacity">
                                        <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1">check_circle</span>
                                    </div>
                                </div>
                            </label>

                            {{-- Hotel --}}
                            <label class="relative group cursor-pointer">
                                <input class="category-radio hidden" name="categories[]" type="checkbox"
                                       value="hotel" {{ in_array('hotel', old('categories', [])) ? 'checked' : '' }}>
                                <div class="category-content flex flex-col items-center p-6 bg-white dark:bg-background-dark border-2 border-transparent rounded-2xl shadow-sm hover:shadow-md transition-all h-full">
                                    <div class="icon-bg size-16 rounded-2xl bg-blue-50 dark:bg-gray-800 flex items-center justify-center text-primary mb-4 transition-colors">
                                        <span class="material-symbols-outlined text-4xl">hotel</span>
                                    </div>
                                    <h3 class="text-base font-bold text-[#111318] dark:text-white mb-1">Hotel</h3>
                                    <p class="text-xs text-center text-[#616f89] dark:text-gray-400">Penginapan dan hotel terbaik di Trenggalek untuk perjalanan nyaman.</p>
                                    <div class="check-indicator absolute top-3 right-3 opacity-0 transition-opacity">
                                        <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1">check_circle</span>
                                    </div>
                                </div>
                            </label>

                        </div>

                        {{-- Navigasi --}}
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-8 border-t border-gray-200 dark:border-gray-700/50">
                            <a href="{{ url()->previous() }}"
                               class="order-2 sm:order-1 flex items-center justify-center gap-2 px-6 h-12 text-gray-500 font-bold hover:text-gray-800 dark:hover:text-white transition-colors">
                                <span class="material-symbols-outlined">arrow_back</span>
                                Kembali
                            </a>
                            <button type="submit"
                                class="order-1 sm:order-2 w-full sm:w-auto flex min-w-[220px] items-center justify-center gap-2 rounded-xl h-12 px-8 bg-primary text-white text-base font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 hover:translate-y-[-1px] active:translate-y-0 transition-all">
                                <span class="truncate">Lanjut ke Langkah 2</span>
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </button>
                        </div>
                    </form>
                </main>

                <footer class="text-center py-8 px-4 border-t border-[#f0f2f4] dark:border-gray-700/50 mt-12">
                    <div class="flex justify-center gap-6 mb-4">
                        <span class="text-xs text-[#616f89] dark:text-gray-500 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">bolt</span>
                            Powered by PSO Algorithm
                        </span>
                    </div>
                    <p class="text-sm text-[#616f89] dark:text-gray-400">© {{ date('Y') }} Sistem Informasi Pariwisata Kabupaten Trenggalek.</p>
                </footer>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleMobileMenu() {
        var menu = document.getElementById('mobile-menu');
        var icon = document.getElementById('mobile-menu-icon');
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
            icon.textContent = 'close';
        } else {
            menu.classList.add('hidden');
            icon.textContent = 'menu';
        }
    }
</script>
</body>
</html>