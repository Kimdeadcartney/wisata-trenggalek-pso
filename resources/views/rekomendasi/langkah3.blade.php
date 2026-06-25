<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Rekomendasi Cerdas Wisata Trenggalek</title>
    
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
        input[type="radio"]:checked + div {
            @apply border-primary bg-primary/5 ring-1 ring-primary;
        }
        input[type="radio"]:checked + div span.icon-wrapper {
            @apply text-primary;
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
    <button id="mobile-menu-btn" onclick="toggleMobileMenu()" class="flex items-center justify-center rounded-lg h-10 w-10 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
        <span id="mobile-menu-icon" class="material-symbols-outlined text-2xl">menu</span>
    </button>
</div>
        </div>
    </div>
</header>
<!-- Mobile Menu Dropdown -->
<div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 shadow-lg sticky top-16 z-40">
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

                    <main class="flex-1 py-10 px-4">
                        <div class="flex flex-col gap-3 p-4 mb-6">
                            <h1 class="text-[#111318] dark:text-white text-3xl font-black leading-tight tracking-[-0.033em]">Langkah 3: Tipe Rombongan &amp; Minat</h1>
                            <p class="text-[#616f89] dark:text-gray-400 text-base font-normal leading-normal">Bantu algoritma PSO kami memahami siapa Anda dan apa yang Anda sukai untuk rekomendasi yang lebih akurat.</p>
                        </div>

                        {{-- Alert Lokasi (Desain tetap rapi) --}}
                        <div id="location-info" class="mx-4 mb-6 p-4 rounded-xl border flex items-center gap-3 bg-blue-50 border-blue-100 text-blue-700 dark:bg-blue-900/20 dark:border-blue-800 dark:text-blue-300">
                            <span class="material-symbols-outlined animate-spin" id="loc-icon">sync</span>
                            <span id="loc-text" class="text-sm font-medium">Mendeteksi koordinat GPS Anda untuk perhitungan jarak...</span>
                        </div>

                        <div class="flex flex-col gap-3 p-4 mb-8">
                            <div class="flex gap-6 justify-between">
                                <p class="text-[#111318] dark:text-gray-300 text-sm font-bold uppercase tracking-wider">Langkah 3 dari 4</p>
                                <p class="text-primary text-sm font-bold">75% Selesai</p>
                            </div>
                            <div class="rounded-full bg-[#dbdfe6] dark:bg-gray-700 h-2.5 overflow-hidden">
                                <div class="h-full rounded-full bg-primary transition-all duration-500" style="width: 75%;"></div>
                            </div>
                        </div>

                        <form action="{{ route('rekomendasi.simpanLangkah3') }}" method="POST" class="space-y-8">
                            @csrf
                            
                            <input type="hidden" name="user_lat" id="user_lat" value="-8.0581">
                            <input type="hidden" name="user_lng" id="user_lng" value="111.7118">

                            {{-- Section 1: Tipe Rombongan --}}
                            <div class="bg-white dark:bg-background-dark border border-gray-100 dark:border-gray-800 p-8 rounded-2xl shadow-sm">
                                <div class="mb-8">
                                    <h2 class="text-[#111318] dark:text-white text-2xl font-bold leading-tight tracking-[-0.015em]">Siapa Teman Perjalanan Anda?</h2>
                                    <p class="text-[#616f89] dark:text-gray-400 text-sm mt-1">Pilih satu tipe rombongan yang paling menggambarkan perjalanan Anda.</p>
                                </div>
                                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                                    @php
                                        $companions = [
                                            ['val' => 'solo', 'label' => 'Solo', 'desc' => 'Pergi sendirian', 'icon' => 'person'],
                                            ['val' => 'couple', 'label' => 'Pasangan', 'desc' => 'Bersama pasangan', 'icon' => 'favorite'],
                                            ['val' => 'family', 'label' => 'Keluarga', 'desc' => 'Bersama keluarga', 'icon' => 'family_restroom'],
                                            ['val' => 'friends', 'label' => 'Teman', 'desc' => 'Grup atau teman', 'icon' => 'group'],
                                        ];
                                    @endphp

                                    @foreach($companions as $comp)
                                    <label class="relative group cursor-pointer">
                                        <input class="sr-only" name="companion" type="radio" value="{{ $comp['val'] }}" {{ old('companion', 'solo') == $comp['val'] ? 'checked' : '' }}>
                                        <div class="flex flex-col items-center gap-4 p-6 border-2 border-gray-100 dark:border-gray-800 rounded-xl transition-all duration-200 group-hover:border-primary/50">
                                            <div class="icon-wrapper size-14 rounded-full bg-gray-50 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 group-hover:text-primary transition-colors">
                                                <span class="material-symbols-outlined text-3xl">{{ $comp['icon'] }}</span>
                                            </div>
                                            <div class="text-center">
                                                <span class="block text-sm font-bold text-[#111318] dark:text-white">{{ $comp['label'] }}</span>
                                                <span class="block text-xs text-gray-500 mt-1">{{ $comp['desc'] }}</span>
                                            </div>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Section 2: Minat Spesifik --}}
                            <div class="bg-white dark:bg-background-dark border border-gray-100 dark:border-gray-800 p-8 rounded-2xl shadow-sm">
                                <div class="mb-8">
                                    <h2 class="text-[#111318] dark:text-white text-2xl font-bold leading-tight tracking-[-0.015em]">Minat Spesifik &amp; Aktivitas</h2>
                                    <p class="text-[#616f89] dark:text-gray-400 text-sm mt-1">Personalisasi perjalanan Anda dengan memilih minat tambahan yang relevan.</p>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                    @php
                                        $interests = [
                                            ['val' => 'photography', 'label' => 'Fotografi', 'desc' => 'Spot foto estetik'],
                                            ['val' => 'waterfalls', 'label' => 'Air Terjun', 'desc' => 'Eksplorasi alam'],
                                            ['val' => 'beaches', 'label' => 'Wisata Pantai', 'desc' => 'Pasir putih & sunset'],
                                            ['val' => 'caves', 'label' => 'Susur Gua', 'desc' => 'Petualangan tanah'],
                                            ['val' => 'crafts', 'label' => 'Kerajinan Lokal', 'desc' => 'Souvenir khas'],
                                            ['val' => 'historical', 'label' => 'Situs Sejarah', 'desc' => 'Religi & sejarah'],
                                        ];
                                    @endphp

                                    @foreach($interests as $interest)
                                    <label class="flex items-center gap-4 p-4 border border-gray-200 dark:border-gray-700 rounded-xl cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors has-[:checked]:bg-primary/5 has-[:checked]:border-primary">
                                        <input class="size-5 rounded border-gray-300 text-primary focus:ring-primary focus:ring-offset-0 dark:bg-gray-800 dark:border-gray-600" 
                                               name="interests[]" 
                                               type="checkbox" 
                                               value="{{ $interest['val'] }}"
                                               {{ is_array(old('interests')) && in_array($interest['val'], old('interests')) ? 'checked' : '' }}>
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-[#111318] dark:text-white">{{ $interest['label'] }}</span>
                                            <span class="text-xs text-gray-500">{{ $interest['desc'] }}</span>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Navigation Buttons --}}
                            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-8">
                                <a href="{{ route('rekomendasi.langkah2') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 rounded-xl h-14 px-8 border border-gray-200 dark:border-gray-700 text-[#111318] dark:text-white font-bold hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                    <span class="material-symbols-outlined">arrow_back</span>
                                    <span>Kembali</span>
                                </a>
                                <button class="w-full sm:w-auto flex items-center justify-center gap-2 rounded-xl h-14 px-12 bg-primary text-white font-bold hover:brightness-110 transition-all shadow-lg shadow-primary/20" type="submit">
                                    <span>Lanjutkan Ke Langkah Terakhir</span>
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


    {{-- Geolocation Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const locInfo = document.getElementById('location-info');
            const locIcon = document.getElementById('loc-icon');
            const locText = document.getElementById('loc-text');
            const latInp = document.getElementById('user_lat');
            const lngInp = document.getElementById('user_lng');

            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        latInp.value = position.coords.latitude;
                        lngInp.value = position.coords.longitude;
                        
                        // Update UI Status (Sukses)
                        locInfo.classList.replace('bg-blue-50', 'bg-green-50');
                        locInfo.classList.replace('border-blue-100', 'border-green-100');
                        locInfo.classList.replace('text-blue-700', 'text-green-700');
                        locIcon.innerText = 'location_on';
                        locIcon.classList.remove('animate-spin');
                        locText.innerText = 'Lokasi berhasil ditemukan! Jarak akan dihitung secara akurat.';
                    },
                    function(error) {
                        // Update UI Status (Gagal/Ditolak)
                        locInfo.classList.replace('bg-blue-50', 'bg-orange-50');
                        locInfo.classList.replace('border-blue-100', 'border-orange-100');
                        locInfo.classList.replace('text-blue-700', 'text-orange-700');
                        locIcon.innerText = 'location_off';
                        locIcon.classList.remove('animate-spin');
                        locText.innerText = 'Izin lokasi ditolak. Menggunakan titik pusat kota sebagai acuan.';
                    }
                );
            } else {
                locText.innerText = 'Browser tidak mendukung GPS.';
            }
        });
    </script>
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