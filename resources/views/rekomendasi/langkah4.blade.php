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

<body class="bg-background-light dark:bg-background-dark font-display text-[#111318] dark:text-gray-200">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <div class="px-4 sm:px-8 md:px-20 lg:px-40 flex flex-1 justify-center py-5">
                <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
                    
                    {{-- Header --}}
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
                        {{-- Progress Section --}}
                        <div class="flex flex-col gap-3 p-4 mb-8">
                            <div class="flex flex-wrap justify-between gap-3 mb-2">
                                <div class="flex flex-col gap-1">
                                    <h1 class="text-[#111318] dark:text-white text-3xl font-black leading-tight tracking-[-0.033em]">Langkah 4: Konfirmasi Pilihan Anda</h1>
                                    <p class="text-[#616f89] dark:text-gray-400 text-base font-normal leading-normal">Tentukan jumlah tujuan dan prioritas faktor perjalanan.</p>
                                </div>
                            </div>
                            <div class="flex gap-6 justify-between items-center">
                                <p class="text-[#111318] dark:text-gray-300 text-base font-medium leading-normal">Langkah 4 dari 4</p>
                                <span class="text-xs font-bold text-primary px-2 py-1 bg-primary/10 rounded">Tahap Konfirmasi</span>
                            </div>
                            <div class="rounded-full bg-[#dbdfe6] dark:bg-gray-700">
                                <div class="h-2 rounded-full bg-primary" style="width: 100%;"></div>
                            </div>
                        </div>

                        <form action="{{ route('rekomendasi.proses') }}" method="POST" class="space-y-8">
                            @csrf

                            {{-- TAMBAHAN: Pilihan Jumlah Destinasi --}}
                            <div class="bg-white dark:bg-background-dark dark:border dark:border-gray-700/50 p-6 rounded-xl shadow-sm border border-gray-100">
                                <div class="flex items-center gap-3 px-4 pb-4">
                                    <span class="material-symbols-outlined text-primary">map_precision</span>
                                    <h2 class="text-[#111318] dark:text-white text-[20px] font-bold leading-tight">Berapa banyak wisata yang ingin Anda kunjungi?</h2>
                                </div>
                                <div class="px-4">
                                    <div class="relative max-w-md">
                                        <select name="limit_tujuan" class="block w-full rounded-xl border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-[#111318] dark:text-white py-3 pl-4 pr-10 focus:ring-primary focus:border-primary">
                                            <option value="1">1 Destinasi (Fokus ke yang terdekat)</option>
                                            <option value="3" selected>3 Destinasi Terbaik (Rekomendasi Utama)</option>
                                            <option value="5">5 Destinasi (Eksplorasi Lebih Luas)</option>
                                            <option value="10">10 Destinasi (Daftar Lengkap)</option>
                                        </select>
                                    </div>
                                    <p class="mt-3 text-sm text-gray-500 dark:text-gray-400 italic">Sistem PSO akan mengurutkan destinasi dari yang paling optimal sesuai kriteria Anda.</p>
                                </div>
                            </div>

                            {{-- Bobot Prioritas --}}
                            <div class="bg-white dark:bg-background-dark dark:border dark:border-gray-700/50 p-6 rounded-xl shadow-sm border border-gray-100">
                                <div class="flex items-center gap-3 px-4 pb-3 pt-2">
                                    <span class="material-symbols-outlined text-primary">tune</span>
                                    <h2 class="text-[#111318] dark:text-white text-[20px] font-bold leading-tight tracking-[-0.015em]">Prioritas Algoritma</h2>
                                </div>
                                <p class="text-[#616f89] dark:text-gray-400 text-sm font-normal leading-normal pb-8 pt-1 px-4">
                                    Geser untuk menentukan prioritas. Karena fokus Anda adalah <b>Jarak</b>, pastikan bobot jarak tetap tinggi.
                                </p>

                                <div class="space-y-12 px-4">
                                    {{-- Weight Price --}}
                                    <div class="space-y-4">
                                        <div class="flex justify-between items-end">
                                            <div class="flex items-center gap-2">
                                                <span class="material-symbols-outlined text-gray-500">payments</span>
                                                <label class="text-base font-bold text-[#111318] dark:text-gray-200" for="weight-price">Prioritas Anggaran</label>
                                            </div>
                                            <span class="text-sm font-bold text-primary bg-primary/10 px-3 py-1 rounded-full border border-primary/20">Bobot: <span id="val-price">{{ old('weight_price', 50) }}</span>%</span>
                                        </div>
                                        <input name="weight_price" class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer accent-primary" id="weight-price" max="100" min="0" oninput="document.getElementById('val-price').innerText = this.value" step="1" type="range" value="{{ old('weight_price', 50) }}"/>
                                        <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400">
                                            <span>Abaikan Harga</span>
                                            <span>Sangat Murah</span>
                                        </div>
                                    </div>

                                    {{-- Weight Distance --}}
                                    <div class="space-y-4">
                                        <div class="flex justify-between items-end">
                                            <div class="flex items-center gap-2">
                                                <span class="material-symbols-outlined text-gray-500">near_me</span>
                                                <label class="text-base font-bold text-[#111318] dark:text-gray-200" for="weight-distance">Prioritas Jarak Tempuh</label>
                                            </div>
                                            <span class="text-sm font-bold text-primary bg-primary/10 px-3 py-1 rounded-full border border-primary/20">Bobot: <span id="val-distance">{{ old('weight_distance', 90) }}</span>%</span>
                                        </div>
                                        <input name="weight_distance" class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer accent-primary" id="weight-distance" max="100" min="0" oninput="document.getElementById('val-distance').innerText = this.value" step="1" type="range" value="{{ old('weight_distance', 90) }}"/>
                                        <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400">
                                            <span>Abaikan Jarak</span>
                                            <span>Cari yang Terdekat</span>
                                        </div>
                                    </div>

                                    {{-- Weight Popularity --}}
                                    <div class="space-y-4">
                                        <div class="flex justify-between items-end">
                                            <div class="flex items-center gap-2">
                                                <span class="material-symbols-outlined text-gray-500">star</span>
                                                <label class="text-base font-bold text-[#111318] dark:text-gray-200" for="weight-popularity">Prioritas Rating</label>
                                            </div>
                                            <span class="text-sm font-bold text-primary bg-primary/10 px-3 py-1 rounded-full border border-primary/20">Bobot: <span id="val-popularity">{{ old('weight_popularity', 70) }}</span>%</span>
                                        </div>
                                        <input name="weight_popularity" class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer accent-primary" id="weight-popularity" max="100" min="0" oninput="document.getElementById('val-popularity').innerText = this.value" step="1" type="range" value="{{ old('weight_popularity', 70) }}"/>
                                        <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400">
                                            <span>Abaikan Rating</span>
                                            <span>Sangat Populer</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800/50 rounded-xl p-4 flex gap-4">
                                <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">auto_awesome</span>
                                <div>
                                    <h4 class="text-sm font-bold text-blue-800 dark:text-blue-300">Siap Menjalankan Algoritma PSO</h4>
                                    <p class="text-sm text-blue-700 dark:text-blue-400 mt-1">Sistem akan melakukan perhitungan kecocokan berdasarkan lokasi GPS Anda dan bobot yang baru saja Anda tentukan.</p>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6">
                                <a href="{{ route('rekomendasi.langkah3') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 px-6 h-12 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-bold hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                                    <span>Kembali</span>
                                </a>
                                <button class="w-full sm:w-auto flex min-w-[280px] cursor-pointer items-center justify-center gap-3 overflow-hidden rounded-lg h-12 px-8 bg-primary text-white text-base font-bold hover:bg-primary/90 transition-all shadow-lg shadow-primary/20" type="submit">
                                    <span>Dapatkan Rekomendasi</span>
                                    <span class="material-symbols-outlined text-[20px]">chevron_right</span>
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