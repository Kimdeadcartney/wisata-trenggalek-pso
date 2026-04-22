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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>

    <style type="text/tailwindcss">
        :root {
            --primary: #135bec;
            --background-light: #f6f6f8;
            --background-dark: #101622;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .category-card:hover .icon-bg {
            @apply bg-primary text-white;
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
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "Noto Sans", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-[#111318] dark:text-gray-200">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <div class="px-4 sm:px-8 md:px-20 lg:px-40 flex flex-1 justify-center py-5">
                <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
                    
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
                    <a class="text-sm font-medium hover:text-primary dark:hover:text-primary transition-colors" href="{{ route('home') }}">Home</a>
                    <a class="text-sm font-medium hover:text-primary dark:hover:text-primary transition-colors" href="{{ route('destinasi.index') }}">Destinasi</a>
                    <a class="text-sm font-medium hover:text-primary dark:hover:text-primary transition-colors" href="{{ route('rekomendasi.pso') }}">Rekomendasi Cerdas</a>
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


                    <main class="flex-1 py-10 px-4">
                        <div class="flex flex-col gap-2 mb-8 text-center max-w-2xl mx-auto">
                            <h1 class="text-[#111318] dark:text-white text-3xl font-black leading-tight tracking-tight">Apa Kategori Wisata Favorit Anda?</h1>
                            <p class="text-[#616f89] dark:text-gray-400 text-base font-normal">Pilih satu atau lebih kategori yang paling menarik bagi Anda untuk membantu algoritma PSO kami menemukan destinasi terbaik.</p>
                        </div>

                        <div class="flex flex-col gap-3 max-w-xl mx-auto mb-12">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-bold text-primary px-3 py-1 bg-primary/10 rounded-full">Langkah 1 dari 4</span>
                                <span class="text-sm font-medium text-gray-500">25% Selesai</span>
                            </div>
                            <div class="h-2 w-full bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-primary w-1/4 rounded-full transition-all duration-500"></div>
                            </div>
                        </div>

                        <form action="{{ route('rekomendasi.simpanLangkah1') }}" method="POST" class="space-y-10">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                                {{-- Kategori: Pantai --}}
                                <label class="relative group cursor-pointer">
                                    <input class="category-radio hidden" name="categories[]" type="checkbox" value="pantai" {{ in_array('pantai', old('categories', [])) ? 'checked' : '' }}>
                                    <div class="category-content flex flex-col items-center p-6 bg-white dark:bg-background-dark border-2 border-transparent rounded-2xl shadow-sm hover:shadow-md transition-all h-full">
                                        <div class="icon-bg size-16 rounded-2xl bg-blue-50 dark:bg-gray-800 flex items-center justify-center text-primary mb-4 transition-colors">
                                            <span class="material-symbols-outlined text-4xl">beach_access</span>
                                        </div>
                                        <h3 class="text-lg font-bold text-[#111318] dark:text-white mb-2">Pantai</h3>
                                        <p class="text-sm text-center text-[#616f89] dark:text-gray-400">Keindahan pesisir selatan dengan pasir putih dan ombak yang memukau.</p>
                                        <div class="check-indicator absolute top-4 right-4 opacity-0 transition-opacity">
                                            <span class="material-symbols-outlined text-primary font-bold">check_circle</span>
                                        </div>
                                    </div>
                                </label>

                                {{-- Kategori: Alam --}}
                                <label class="relative group cursor-pointer">
                                    <input class="category-radio hidden" name="categories[]" type="checkbox" value="alam" {{ in_array('alam', old('categories', [])) ? 'checked' : '' }}>
                                    <div class="category-content flex flex-col items-center p-6 bg-white dark:bg-background-dark border-2 border-transparent rounded-2xl shadow-sm hover:shadow-md transition-all h-full">
                                        <div class="icon-bg size-16 rounded-2xl bg-blue-50 dark:bg-gray-800 flex items-center justify-center text-primary mb-4 transition-colors">
                                            <span class="material-symbols-outlined text-4xl">landscape</span>
                                        </div>
                                        <h3 class="text-lg font-bold text-[#111318] dark:text-white mb-2">Alam &amp; Pegunungan</h3>
                                        <p class="text-sm text-center text-[#616f89] dark:text-gray-400">Udara sejuk pegunungan, hutan pinus, dan pemandangan hijau yang asri.</p>
                                        <div class="check-indicator absolute top-4 right-4 opacity-0 transition-opacity">
                                            <span class="material-symbols-outlined text-primary font-bold">check_circle</span>
                                        </div>
                                    </div>
                                </label>

                                {{-- Kategori: Budaya --}}
                                <label class="relative group cursor-pointer">
                                    <input class="category-radio hidden" name="categories[]" type="checkbox" value="budaya" {{ in_array('budaya', old('categories', [])) ? 'checked' : '' }}>
                                    <div class="category-content flex flex-col items-center p-6 bg-white dark:bg-background-dark border-2 border-transparent rounded-2xl shadow-sm hover:shadow-md transition-all h-full">
                                        <div class="icon-bg size-16 rounded-2xl bg-blue-50 dark:bg-gray-800 flex items-center justify-center text-primary mb-4 transition-colors">
                                            <span class="material-symbols-outlined text-4xl">temple_hindu</span>
                                        </div>
                                        <h3 class="text-lg font-bold text-[#111318] dark:text-white mb-2">Budaya &amp; Sejarah</h3>
                                        <p class="text-sm text-center text-[#616f89] dark:text-gray-400">Warisan leluhur, kesenian lokal, dan situs sejarah Kabupaten Trenggalek.</p>
                                        <div class="check-indicator absolute top-4 right-4 opacity-0 transition-opacity">
                                            <span class="material-symbols-outlined text-primary font-bold">check_circle</span>
                                        </div>
                                    </div>
                                </label>

                                {{-- Kategori: Gua --}}
                                <label class="relative group cursor-pointer">
                                    <input class="category-radio hidden" name="categories[]" type="checkbox" value="gua" {{ in_array('gua', old('categories', [])) ? 'checked' : '' }}>
                                    <div class="category-content flex flex-col items-center p-6 bg-white dark:bg-background-dark border-2 border-transparent rounded-2xl shadow-sm hover:shadow-md transition-all h-full">
                                        <div class="icon-bg size-16 rounded-2xl bg-blue-50 dark:bg-gray-800 flex items-center justify-center text-primary mb-4 transition-colors">
                                            <span class="material-symbols-outlined text-4xl">mountain_flag</span>
                                        </div>
                                        <h3 class="text-lg font-bold text-[#111318] dark:text-white mb-2">Gua &amp; Karst</h3>
                                        <p class="text-sm text-center text-[#616f89] dark:text-gray-400">Eksplorasi keajaiban bawah tanah seperti Gua Lowo yang legendaris.</p>
                                        <div class="check-indicator absolute top-4 right-4 opacity-0 transition-opacity">
                                            <span class="material-symbols-outlined text-primary font-bold">check_circle</span>
                                        </div>
                                    </div>
                                </label>

                                {{-- Kategori: Kuliner --}}
                                <label class="relative group cursor-pointer">
                                    <input class="category-radio hidden" name="categories[]" type="checkbox" value="kuliner" {{ in_array('kuliner', old('categories', [])) ? 'checked' : '' }}>
                                    <div class="category-content flex flex-col items-center p-6 bg-white dark:bg-background-dark border-2 border-transparent rounded-2xl shadow-sm hover:shadow-md transition-all h-full">
                                        <div class="icon-bg size-16 rounded-2xl bg-blue-50 dark:bg-gray-800 flex items-center justify-center text-primary mb-4 transition-colors">
                                            <span class="material-symbols-outlined text-4xl">restaurant</span>
                                        </div>
                                        <h3 class="text-lg font-bold text-[#111318] dark:text-white mb-2">Kuliner</h3>
                                        <p class="text-sm text-center text-[#616f89] dark:text-gray-400">Cita rasa autentik nasi gegok, alpen, dan olahan ikan laut segar.</p>
                                        <div class="check-indicator absolute top-4 right-4 opacity-0 transition-opacity">
                                            <span class="material-symbols-outlined text-primary font-bold">check_circle</span>
                                        </div>
                                    </div>
                                </label>

                                {{-- Kategori: Religi --}}
                                <label class="relative group cursor-pointer">
                                    <input class="category-radio hidden" name="categories[]" type="checkbox" value="religi" {{ in_array('religi', old('categories', [])) ? 'checked' : '' }}>
                                    <div class="category-content flex flex-col items-center p-6 bg-white dark:bg-background-dark border-2 border-transparent rounded-2xl shadow-sm hover:shadow-md transition-all h-full">
                                        <div class="icon-bg size-16 rounded-2xl bg-blue-50 dark:bg-gray-800 flex items-center justify-center text-primary mb-4 transition-colors">
                                            <span class="material-symbols-outlined text-4xl">mosque</span>
                                        </div>
                                        <h3 class="text-lg font-bold text-[#111318] dark:text-white mb-2">Wisata Religi</h3>
                                        <p class="text-sm text-center text-[#616f89] dark:text-gray-400">Kunjungan ke tempat ibadah bersejarah dan pusat spiritual daerah.</p>
                                        <div class="check-indicator absolute top-4 right-4 opacity-0 transition-opacity">
                                            <span class="material-symbols-outlined text-primary font-bold">check_circle</span>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-8 border-t border-gray-200 dark:border-gray-700/50">
                                <a href="{{ url()->previous() }}" class="order-2 sm:order-1 flex items-center justify-center gap-2 px-6 h-12 text-gray-500 font-bold hover:text-gray-800 dark:hover:text-white transition-colors">
                                    <span class="material-symbols-outlined">arrow_back</span>
                                    Kembali
                                </a>
                                <button class="order-1 sm:order-2 w-full sm:w-auto flex min-w-[200px] items-center justify-center gap-2 rounded-xl h-12 px-8 bg-primary text-white text-base font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 hover:translate-y-[-1px] active:translate-y-[0px] transition-all" type="submit">
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

</body>
</html>