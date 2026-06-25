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
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-[#111318] dark:text-gray-200 min-h-screen flex flex-col">

    {{-- Header --}}
    <header class="sticky top-0 z-50 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm border-b border-slate-200 dark:border-slate-800">
        <div class="max-w-[960px] mx-auto px-4 sm:px-6 h-16 flex items-center justify-between whitespace-nowrap">
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
                <button id="mobile-menu-btn" onclick="toggleMobileMenu()" class="flex items-center justify-center rounded-lg h-10 w-10 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                    <span id="mobile-menu-icon" class="material-symbols-outlined text-2xl">menu</span>
                </button>
            </div>
        </div>
    </header>

    <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 shadow-lg sticky top-16 z-40">
        <nav class="px-4 py-3 flex flex-col">
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

    {{-- Main Content Wrapper --}}
    <div class="flex-1 w-full max-w-[960px] mx-auto px-4 sm:px-6 md:px-8 py-6">
        <main class="w-full">
            {{-- Progress Section --}}
            <div class="flex flex-col gap-3 mb-8">
                <div class="flex flex-wrap justify-between gap-3 mb-2">
                    <div class="flex flex-col gap-1">
                        <h1 class="text-[#111318] dark:text-white text-2xl sm:text-3xl font-black leading-tight tracking-[-0.033em]">Langkah 4: Konfirmasi Pilihan Anda</h1>
                        <p class="text-[#616f89] dark:text-gray-400 text-sm sm:text-base font-normal leading-normal">Tentukan jumlah tujuan dan prioritas faktor perjalanan.</p>
                    </div>
                </div>
                <div class="flex gap-6 justify-between items-center">
                    <p class="text-[#111318] dark:text-gray-300 text-sm sm:text-base font-medium leading-normal">Langkah 4 dari 4</p>
                    <span class="text-xs font-bold text-primary px-2 py-1 bg-primary/10 rounded">Tahap Konfirmasi</span>
                </div>
                <div class="rounded-full bg-[#dbdfe6] dark:bg-gray-700">
                    <div class="h-2 rounded-full bg-primary" style="width: 100%;"></div>
                </div>
            </div>

            <form action="{{ route('rekomendasi.proses') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Pilihan Jumlah Destinasi --}}
                <div class="bg-white dark:bg-background-dark dark:border dark:border-gray-700/50 p-4 sm:p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center gap-3 pb-4">
                        <span class="material-symbols-outlined text-primary">map_precision</span>
                        <h2 class="text-[#111318] dark:text-white text-lg sm:text-[20px] font-bold leading-tight">Berapa banyak wisata yang ingin Anda kunjungi?</h2>
                    </div>
                    <div>
                        <div class="relative max-w-md">
                            <select name="limit_tujuan" class="block w-full rounded-xl border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-[#111318] dark:text-white py-3 pl-4 pr-10 focus:ring-primary focus:border-primary text-sm sm:text-base">
                                <option value="1">1 Destinasi</option>
                                <option value="2">2 Destinasi</option>
                                <option value="3" selected>3 Destinasi (Rekomendasi Utama)</option>
                                <option value="4">4 Destinasi</option>
                                <option value="5">5 Destinasi</option>
                                <option value="6">6 Destinasi</option>
                                <option value="7">7 Destinasi</option>
                                <option value="8">8 Destinasi</option>
                                <option value="9">9 Destinasi</option>
                                <option value="10">10 Destinasi (Daftar Lengkap)</option>
                            </select>
                        </div>
                        <p class="mt-3 text-xs sm:text-sm text-gray-500 dark:text-gray-400 italic">Sistem PSO akan mengurutkan destinasi dari yang paling optimal sesuai kriteria Anda.</p>
                    </div>
                </div>

                {{-- Bobot Prioritas --}}
                <div class="bg-white dark:bg-background-dark dark:border dark:border-gray-700/50 p-4 sm:p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center gap-3 pb-3">
                        <span class="material-symbols-outlined text-primary">tune</span>
                        <h2 class="text-[#111318] dark:text-white text-lg sm:text-[20px] font-bold leading-tight tracking-[-0.015em]">Prioritas Algoritma</h2>
                    </div>
                    <p class="text-[#616f89] dark:text-gray-400 text-xs sm:text-sm font-normal leading-normal pb-6">
                        Geser untuk menentukan prioritas. Karena fokus Anda adalah <b>Jarak</b>, pastikan bobot jarak tetap tinggi.
                    </p>

                    <div class="space-y-8">
                        {{-- Weight Price --}}
                        <div class="space-y-3">
                            <div class="flex justify-between items-end">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-gray-500 text-xl">payments</span>
                                    <label class="text-sm sm:text-base font-bold text-[#111318] dark:text-gray-200" for="weight-price">Prioritas Anggaran</label>
                                </div>
                                <span class="text-xs sm:text-sm font-bold text-primary bg-primary/10 px-3 py-1 rounded-full border border-primary/20">Bobot: <span id="val-price">{{ old('weight_price', 50) }}</span>%</span>
                            </div>
                            <input name="weight_price" class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer accent-primary" id="weight-price" max="100" min="0" oninput="document.getElementById('val-price').innerText = this.value" step="1" type="range" value="{{ old('weight_price', 50) }}"/>
                            <div class="flex justify-between text-[11px] sm:text-xs text-gray-500 dark:text-gray-400">
                                <span>Abaikan Harga</span>
                                <span>Sangat Murah</span>
                            </div>
                        </div>

                        {{-- Weight Distance --}}
                        <div class="space-y-3">
                            <div class="flex justify-between items-end">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-gray-500 text-xl">near_me</span>
                                    <label class="text-sm sm:text-base font-bold text-[#111318] dark:text-gray-200" for="weight-distance">Prioritas Jarak Tempuh</label>
                                </div>
                                <span class="text-xs sm:text-sm font-bold text-primary bg-primary/10 px-3 py-1 rounded-full border border-primary/20">Bobot: <span id="val-distance">{{ old('weight_distance', 90) }}</span>%</span>
                            </div>
                            <input name="weight_distance" class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer accent-primary" id="weight-distance" max="100" min="0" oninput="document.getElementById('val-distance').innerText = this.value" step="1" type="range" value="{{ old('weight_distance', 90) }}"/>
                            <div class="flex justify-between text-[11px] sm:text-xs text-gray-500 dark:text-gray-400">
                                <span>Abaikan Jarak</span>
                                <span>Cari yang Terdekat</span>
                            </div>
                        </div>

                        {{-- Weight Popularity --}}
                        <div class="space-y-3">
                            <div class="flex justify-between items-end">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-gray-500 text-xl">star</span>
                                    <label class="text-sm sm:text-base font-bold text-[#111318] dark:text-gray-200" for="weight-popularity">Prioritas Rating</label>
                                </div>
                                <span class="text-xs sm:text-sm font-bold text-primary bg-primary/10 px-3 py-1 rounded-full border border-primary/20">Bobot: <span id="val-popularity">{{ old('weight_popularity', 70) }}</span>%</span>
                            </div>
                            <input name="weight_popularity" class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer accent-primary" id="weight-popularity" max="100" min="0" oninput="document.getElementById('val-popularity').innerText = this.value" step="1" type="range" value="{{ old('weight_popularity', 70) }}"/>
                            <div class="flex justify-between text-[11px] sm:text-xs text-gray-500 dark:text-gray-400">
                                <span>Abaikan Rating</span>
                                <span>Sangat Populer</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Alert Info --}}
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800/50 rounded-xl p-4 flex gap-3 sm:gap-4">
                    <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">auto_awesome</span>
                    <div>
                        <h4 class="text-sm font-bold text-blue-800 dark:text-blue-300">Siap Menjalankan Algoritma PSO</h4>
                        <p class="text-xs sm:text-sm text-blue-700 dark:text-blue-400 mt-1">Sistem akan melakukan perhitungan kecocokan berdasarkan lokasi GPS Anda dan bobot yang baru saja Anda tentukan.</p>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
                    <a href="{{ route('rekomendasi.langkah3') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 px-6 h-12 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-bold hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors text-sm sm:text-base">
                        <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                        <span>Kembali</span>
                    </a>
                    <button class="w-full sm:w-auto flex min-w-[260px] cursor-pointer items-center justify-center gap-3 overflow-hidden rounded-lg h-12 px-8 bg-primary text-white font-bold hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 text-sm sm:text-base" type="submit">
                        <span>Dapatkan Rekomendasi</span>
                        <span class="material-symbols-outlined text-[20px]">chevron_right</span>
                    </button>
                </div>
            </form>
        </main>

        {{-- Footer --}}
        <footer class="text-center py-8 border-t border-[#f0f2f4] dark:border-gray-700/50 mt-12">
            <div class="flex justify-center gap-6 mb-4">
                <span class="text-xs text-[#616f89] dark:text-gray-500 flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">bolt</span>
                    Powered by PSO Algorithm
                </span>
            </div>
            <p class="text-xs sm:text-sm text-[#616f89] dark:text-gray-400">© {{ date('Y') }} Sistem Informasi Pariwisata Kabupaten Trenggalek.</p>
        </footer>
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