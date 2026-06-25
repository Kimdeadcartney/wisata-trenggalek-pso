<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Itinerary PSO - Wisata Trenggalek</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css"/>

    <style type="text/tailwindcss">
        :root { --primary: #135bec; --background-light: #f6f6f8; --background-dark: #101622; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24; }
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
            .itinerary-card { border: 1px solid #ddd !important; box-shadow: none !important; }
        }
        #map-container { height: 100%; width: 100%; min-height: 420px; z-index: 1; }
        .leaflet-routing-container { display: none !important; }

        .wisata-img-wrap { overflow: hidden; }
        .wisata-img-wrap img { transition: transform 0.5s ease; }
        .wisata-img-wrap:hover img { transform: scale(1.07); }

        .btn-detail { transition: all 0.2s ease; }
        .btn-detail:hover { box-shadow: 0 4px 14px rgba(19, 91, 236, 0.25); transform: translateY(-1px); }

        .dest-card-removing {
            opacity: 0.4;
            transition: opacity 0.25s ease;
        }
        .dest-card-removing .dest-card-inner {
            border: 2px dashed #ef4444 !important;
        }
        .dest-card-removing .dest-name {
            text-decoration: line-through;
            color: #ef4444 !important;
        }

        #modal-tambah { transition: opacity 0.2s ease; }
        #modal-tambah.hidden { opacity: 0; pointer-events: none; }
        .modal-dest-card.selected { border-color: #135bec !important; background: #eff5ff !important; }
        .dark .modal-dest-card.selected { background: #1e2d4d !important; }
        .modal-dest-card.already-added { opacity: 0.5; pointer-events: none; cursor: not-allowed; }
        .modal-dest-card { transition: border-color 0.15s ease, background 0.15s ease; cursor: pointer; }

        #update-bar { transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1); }
        #update-bar.show { transform: translateY(0) !important; }

        .cat-pill { transition: background 0.15s, color 0.15s; }
        .cat-pill.active { background: #135bec; color: white; }
    </style>

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: { extend: {
                colors: { "primary": "#135bec", "background-light": "#f6f6f8", "background-dark": "#101622" },
                fontFamily: { "display": ["Plus Jakarta Sans","Noto Sans","sans-serif"] },
            }},
        }
    </script>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-[#111318] dark:text-gray-200">
<div class="relative flex min-h-screen w-full flex-col">

    {{-- ── Header ── --}}
    <header class="no-print sticky top-0 z-50 flex items-center justify-between border-b border-[#f0f2f4] dark:border-gray-700/50 px-4 sm:px-8 md:px-20 lg:px-40 py-3 bg-white dark:bg-background-dark">
        <div class="flex items-center gap-3 text-[#111318] dark:text-white">
            <div class="size-6 text-primary">
                <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path d="M42.4379 44C42.4379 44 36.0744 33.9038 41.1692 24C46.8624 12.9336 42.2078 4 42.2078 4L7.01134 4C7.01134 4 11.6577 12.932 5.96912 23.9969C0.876273 33.9029 7.27094 44 7.27094 44L42.4379 44Z" fill="currentColor"/>
                </svg>
            </div>
            <h2 class="text-lg font-bold uppercase tracking-tight">Wisata Trenggalek</h2>
        </div>

        {{-- Desktop nav --}}
        <div class="hidden lg:flex items-center gap-8">
            <nav class="flex items-center gap-8">
                <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ route('home') }}">Home</a>
                <a class="text-sm font-medium text-primary font-bold" href="#">Rekomendasi Cerdas</a>
            </nav>
            <a href="{{ route('rekomendasi.langkah1') }}"
               class="flex items-center gap-2 bg-primary text-white text-sm font-bold px-4 py-2 rounded-lg hover:bg-primary/90 transition-all">
                <span class="material-symbols-outlined text-base">refresh</span>
                Reset Rute
            </a>
        </div>

        {{-- Mobile: tombol Reset Rute + Hamburger --}}
        <div class="flex lg:hidden items-center gap-2">
            <a href="{{ route('rekomendasi.langkah1') }}"
               class="flex items-center gap-1.5 bg-primary text-white text-xs font-bold px-3 py-2 rounded-lg hover:bg-primary/90 transition-all no-print">
                <span class="material-symbols-outlined text-sm">refresh</span>
                Reset Rute
            </a>
            <button id="mobile-menu-btn" onclick="toggleMobileMenu()"
                class="flex items-center justify-center rounded-lg h-10 w-10 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                <span id="mobile-menu-icon" class="material-symbols-outlined text-2xl">menu</span>
            </button>
        </div>
    </header>

    {{-- Mobile Menu Dropdown --}}
    <div id="mobile-menu" class="hidden lg:hidden bg-white dark:bg-background-dark border-b border-slate-200 dark:border-slate-800 shadow-lg sticky top-[57px] z-40 no-print">
        <nav class="px-4 sm:px-8 py-3 flex flex-col">
            <a href="{{ route('home') }}" class="flex items-center gap-3 py-3 px-2 text-sm font-medium text-slate-800 dark:text-slate-200 hover:text-primary border-b border-slate-100 dark:border-slate-800 transition-colors">
                <span class="material-symbols-outlined text-xl">home</span> Home
            </a>
            <a href="#" class="flex items-center gap-3 py-3 px-2 text-sm font-medium text-primary font-bold border-b border-slate-100 dark:border-slate-800 transition-colors">
                <span class="material-symbols-outlined text-xl">bolt</span> Rekomendasi Cerdas
            </a>
            <div class="pt-3 pb-1">
                <a href="{{ route('rekomendasi.langkah1') }}"
                   class="flex w-full items-center justify-center gap-2 rounded-lg h-11 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-colors">
                    <span class="material-symbols-outlined text-base">refresh</span>
                    Reset Rute
                </a>
            </div>
        </nav>
    </div>

    <main class="flex-1 px-4 sm:px-8 md:px-20 lg:px-40 py-10">
        <div class="max-w-[1200px] mx-auto flex flex-col gap-8">

            {{-- ── Title & Actions ── --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-black leading-tight tracking-tight text-[#111318] dark:text-white">
                        Itinerary Berbasis Lokasi Pengguna
                    </h1>
                    <p class="text-[#616f89] dark:text-gray-400 text-base mt-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm text-green-500">my_location</span>
                        Titik Awal:
                        <strong class="text-primary">{{ session('pso_data.location', 'Lokasi Anda') }}</strong>
                    </p>
                </div>
                <div class="no-print flex flex-wrap gap-3">
                    <button onclick="openModal()"
                        class="flex items-center gap-2 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors font-bold text-sm shadow-sm">
                        <span class="material-symbols-outlined text-base">add_location_alt</span>
                        <span>Tambah Destinasi</span>
                    </button>
                    <button onclick="window.print()"
                        class="flex items-center gap-2 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                        <span class="material-symbols-outlined text-lg">print</span>
                        <span class="text-sm font-bold">Cetak Rute</span>
                    </button>
                </div>
            </div>

            {{-- ── Flash error ── --}}
            @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-base">error</span>
                {{ session('error') }}
            </div>
            @endif

            {{-- ── Stats Grid ── --}}
            @php
                $jumlahData   = count($results);
                $totalFitness = collect($results)->sum(fn($r) => (float)$r['fitness_score']);
                $avgFitness   = $jumlahData > 0 ? $totalFitness / $jumlahData : 0;
                $totalJarak   = $pso_rute['total_jarak'] ?? collect($results)->sum(fn($r) => (float)$r['jarak']);
                $maxJarak     = 500;
                $skorJarak    = max(0, 100 - (($totalJarak / $maxJarak) * 100));
                $efisiensi    = round((0.7 * $avgFitness) + (0.3 * $skorJarak));
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="stats-grid">

                <div class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm">
                    <p class="text-xs text-[#616f89] dark:text-gray-400 font-bold uppercase tracking-wider mb-1">Durasi</p>
                    <p class="text-xl font-bold text-primary">
                        @php $dur = session('pso_data.duration', 1); @endphp
                        @if($dur == 1) One Day Trip
                        @elseif($dur == 2) Two Day Trip
                        @else {{ $dur }} Hari Trip
                        @endif
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm">
                    <p class="text-xs text-[#616f89] dark:text-gray-400 font-bold uppercase tracking-wider mb-1">Total Destinasi</p>
                    <p class="text-xl font-bold text-primary" id="stat-total-dest">{{ $jumlahData }} Lokasi</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm">
                    <p class="text-xs text-[#616f89] dark:text-gray-400 font-bold uppercase tracking-wider mb-1">Total Jarak Rute</p>
                    <p class="text-xl font-bold text-primary">{{ number_format($totalJarak, 1) }} km</p>
                    <p class="text-xs text-gray-400 mt-1">Pergi + Pulang</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm">
                    <p class="text-xs text-[#616f89] dark:text-gray-400 font-bold uppercase tracking-wider mb-1">Skor Efisiensi</p>
                    <div class="flex items-center gap-2">
                        <p class="text-xl font-bold text-primary">{{ $efisiensi }}%</p>
                        <span class="material-symbols-outlined text-green-500 text-sm">verified</span>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Avg. fitness: {{ round($avgFitness) }}%</p>
                </div>
            </div>

            {{-- ── Main Grid: Itinerary + Map ── --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- ── Left: Timeline Itinerary ── --}}
                <div class="lg:col-span-7 space-y-6">
                    <div class="itinerary-card bg-white dark:bg-gray-800/50 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm">
                        <div class="bg-primary px-6 py-4 flex justify-between items-center text-white">
                            <h3 class="text-lg font-bold">Rencana Perjalanan (Rute Optimal PSO)</h3>
                            <span class="text-sm bg-white/20 px-3 py-1 rounded-full backdrop-blur-sm flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">route</span>
                                Jarak Terpendek
                            </span>
                        </div>

                        <div class="p-6">
                            <div id="itinerary-timeline" class="relative flex flex-col gap-8 before:content-[''] before:absolute before:left-[17px] before:top-2 before:bottom-2 before:w-[2px] before:bg-gray-200 dark:before:bg-gray-700">
                                @php $urutan = $pso_rute['urutan_rute'] ?? []; @endphp

                                @forelse($urutan as $stop)

                                    {{-- TITIK ASAL (START) --}}
                                    @if($stop['tipe'] === 'asal')
                                    <div class="relative pl-12">
                                        <div class="absolute left-0 top-1 size-9 rounded-full bg-blue-50 dark:bg-blue-900/30 border-4 border-blue-500 flex items-center justify-center z-10">
                                            <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-lg">my_location</span>
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2 mb-1">
                                                <h4 class="font-bold text-lg text-blue-600 dark:text-blue-400">Titik Keberangkatan</h4>
                                                <span class="text-[10px] bg-blue-500 text-white px-2 py-0.5 rounded-full uppercase font-bold tracking-wider">START</span>
                                            </div>
                                            <p class="text-sm text-[#616f89] dark:text-gray-400">{{ $stop['nama'] }}</p>
                                            @if(isset($stop['jarak_ke_berikut']) && $stop['jarak_ke_berikut'] > 0)
                                            <div class="mt-2 flex items-center gap-1 text-xs text-gray-400">
                                                <span class="material-symbols-outlined text-sm text-primary">directions_car</span>
                                                <span>{{ $stop['jarak_ke_berikut'] }} km ke destinasi pertama</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- DESTINASI (STOP 1, 2, 3, ...) --}}
                                    @elseif($stop['tipe'] === 'destinasi')
                                    <div class="relative pl-12 dest-card-wrapper"
                                         data-dest-id="{{ $stop['id'] }}"
                                         data-dest-name="{{ $stop['nama'] }}"
                                         id="dest-card-{{ $stop['id'] }}">

                                        <div class="absolute left-0 top-1 size-9 rounded-full bg-white dark:bg-gray-800 border-4 border-primary flex items-center justify-center z-10">
                                            <span class="text-xs font-bold text-primary dest-urutan">{{ $stop['urutan'] }}</span>
                                        </div>

                                        <div class="dest-card-inner bg-gray-50 dark:bg-gray-800/60 rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700/50">

                                            @php $gambarSrc = !empty($stop['gambar']) ? $stop['gambar'] : null; @endphp
                                            @if($gambarSrc)
                                            <div class="wisata-img-wrap relative h-44 w-full bg-gray-200 dark:bg-gray-700">
                                                <img
                                                    src="{{ $gambarSrc }}"
                                                    alt="{{ $stop['nama'] }}"
                                                    onerror="this.onerror=null;this.src='https://placehold.co/600x176/135bec/ffffff?text={{ urlencode($stop['nama']) }}';"
                                                    class="w-full h-full object-cover"
                                                    loading="lazy"
                                                >
                                                <div class="absolute top-2 right-2 flex items-center gap-1 bg-black/50 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-1 rounded-full">
                                                    <span class="material-symbols-outlined text-[11px] text-yellow-400" style="font-variation-settings:'FILL' 1">star</span>
                                                    Fitness {{ $stop['fitness_score'] ?? 0 }}%
                                                </div>
                                                <div class="absolute bottom-2 left-2">
                                                    <span class="bg-primary text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wide">
                                                        {{ $stop['kategori'] ?? '' }}
                                                    </span>
                                                </div>
                                                <button
                                                    onclick="removeDestination({{ $stop['id'] }}, '{{ addslashes($stop['nama']) }}')"
                                                    title="Hapus destinasi ini"
                                                    class="no-print remove-btn absolute top-2 left-2 flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded-full transition-all backdrop-blur-sm shadow-sm z-10">
                                                    <span class="material-symbols-outlined text-[12px]" style="font-variation-settings:'FILL' 1">delete</span>
                                                    Hapus
                                                </button>
                                            </div>
                                            @else
                                            <div class="relative h-20 w-full bg-gradient-to-r from-primary/10 to-primary/5 flex items-center justify-center">
                                                <span class="material-symbols-outlined text-primary/30 text-5xl">image_not_supported</span>
                                                <div class="absolute top-2 right-2">
                                                    <span class="bg-black/40 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">
                                                        Fitness {{ $stop['fitness_score'] ?? 0 }}%
                                                    </span>
                                                </div>
                                                <div class="absolute bottom-2 left-2">
                                                    <span class="bg-primary text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wide">
                                                        {{ $stop['kategori'] ?? '' }}
                                                    </span>
                                                </div>
                                                <button
                                                    onclick="removeDestination({{ $stop['id'] }}, '{{ addslashes($stop['nama']) }}')"
                                                    title="Hapus destinasi ini"
                                                    class="no-print remove-btn absolute top-2 left-2 flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded-full transition-all z-10">
                                                    <span class="material-symbols-outlined text-[12px]" style="font-variation-settings:'FILL' 1">delete</span>
                                                    Hapus
                                                </button>
                                            </div>
                                            @endif

                                            <div class="p-4">
                                                <h4 class="font-bold text-base text-[#111318] dark:text-white mb-3 leading-snug dest-name">
                                                    {{ $stop['nama'] }}
                                                </h4>

                                                <div class="flex flex-wrap gap-x-4 gap-y-1.5 text-xs font-medium text-gray-500 dark:text-gray-400">
                                                    <span class="flex items-center gap-1">
                                                        <span class="material-symbols-outlined text-sm text-orange-400" style="font-variation-settings:'FILL' 1">star</span>
                                                        {{ $stop['rating'] ?? '-' }}
                                                    </span>
                                                    <span class="flex items-center gap-1">
                                                        <span class="material-symbols-outlined text-sm text-green-500">payments</span>
                                                        @if(($stop['harga'] ?? 0) == 0)
                                                            Gratis
                                                        @else
                                                            Rp {{ number_format($stop['harga'], 0, ',', '.') }}
                                                        @endif
                                                    </span>
                                                    @if(!empty($stop['jam_buka']))
                                                    <span class="flex items-center gap-1">
                                                        <span class="material-symbols-outlined text-sm text-blue-500">schedule</span>
                                                        {{ $stop['jam_buka'] }}{{ !empty($stop['jam_tutup']) ? ' – ' . $stop['jam_tutup'] : '' }}
                                                    </span>
                                                    @endif
                                                </div>

                                                @if(!empty($stop['id']))
                                                <a href="{{ route('destinasi.show', $stop['id']) }}"
                                                   target="_blank"
                                                   rel="noopener noreferrer"
                                                   class="btn-detail mt-3 w-full flex items-center justify-center gap-2 bg-primary text-white text-xs font-bold px-3 py-2.5 rounded-lg">
                                                    <span class="material-symbols-outlined text-sm">travel_explore</span>
                                                    Lihat Detail Wisata
                                                    <span class="material-symbols-outlined text-sm ml-auto opacity-70">open_in_new</span>
                                                </a>
                                                @endif

                                                @if(isset($stop['jarak_ke_berikut']) && $stop['jarak_ke_berikut'] > 0)
                                                <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-700 flex items-center gap-1 text-xs text-gray-400">
                                                    <span class="material-symbols-outlined text-sm text-primary">directions_car</span>
                                                    <span>
                                                        {{ $stop['jarak_ke_berikut'] }} km ke
                                                        @php $nextStop = collect($urutan)->firstWhere('urutan', $stop['urutan'] + 1); @endphp
                                                        {{ $nextStop ? ($nextStop['tipe'] === 'kembali' ? 'titik pulang' : $nextStop['nama']) : 'tujuan berikutnya' }}
                                                    </span>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    {{-- TITIK KEMBALI (FINISH) --}}
                                    @elseif($stop['tipe'] === 'kembali')
                                    <div class="relative pl-12">
                                        <div class="absolute left-0 top-1 size-9 rounded-full bg-green-50 dark:bg-green-900/30 border-4 border-green-500 flex items-center justify-center z-10">
                                            <span class="material-symbols-outlined text-green-600 dark:text-green-400 text-lg">home</span>
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2 mb-1">
                                                <h4 class="font-bold text-lg text-green-600 dark:text-green-400">Kembali ke Rumah</h4>
                                                <span class="text-[10px] bg-green-500 text-white px-2 py-0.5 rounded-full uppercase font-bold tracking-wider">FINISH</span>
                                            </div>
                                            <p class="text-sm text-[#616f89] dark:text-gray-400">{{ $stop['nama'] }}</p>
                                            <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                                <span class="material-symbols-outlined text-sm text-green-500">check_circle</span>
                                                Perjalanan selesai. Semua destinasi telah dikunjungi.
                                            </p>
                                        </div>
                                    </div>
                                    @endif

                                @empty
                                    <p class="text-center text-gray-400 py-8">Data rute tidak tersedia.</p>
                                @endforelse

                            </div>{{-- end timeline --}}

                            <div class="no-print mt-6 pt-4 border-t border-dashed border-gray-200 dark:border-gray-700">
                                <button onclick="openModal()"
                                    class="w-full flex items-center justify-center gap-2 py-3 rounded-xl border-2 border-dashed border-green-400 text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 transition-colors font-bold text-sm">
                                    <span class="material-symbols-outlined text-lg">add_location_alt</span>
                                    Tambahkan Destinasi Lain ke Itinerary
                                </button>
                            </div>

                        </div>
                    </div>

                    {{-- Ringkasan Bobot PSO --}}
                    @if(isset($pso_meta['bobot_digunakan']))
                    <div class="bg-white dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-5">
                        <h4 class="font-bold text-sm mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-base">tune</span>
                            Bobot PSO yang Digunakan
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach([
                                ['label'=>'Rating',    'key'=>'rating',    'icon'=>'star'],
                                ['label'=>'Jarak',     'key'=>'jarak',     'icon'=>'near_me'],
                                ['label'=>'Harga',     'key'=>'harga',     'icon'=>'payments'],
                                ['label'=>'Minat',     'key'=>'minat',     'icon'=>'favorite'],
                                ['label'=>'Rombongan', 'key'=>'companion', 'icon'=>'group'],
                            ] as $b)
                            <div class="bg-gray-50 dark:bg-gray-700/50 p-3 rounded-lg">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="material-symbols-outlined text-primary text-sm">{{ $b['icon'] }}</span>
                                    <span class="text-xs font-bold text-gray-600 dark:text-gray-300">{{ $b['label'] }}</span>
                                </div>
                                @php $val = $pso_meta['bobot_digunakan'][$b['key']] ?? 0; @endphp
                                <div class="h-1.5 bg-gray-200 dark:bg-gray-600 rounded-full overflow-hidden mt-1">
                                    <div class="h-full bg-primary rounded-full" style="width: {{ round($val * 100) }}%"></div>
                                </div>
                                <p class="text-xs text-primary font-bold mt-1">{{ round($val * 100) }}%</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                {{-- ── Right: Peta Leaflet ── --}}
                <div class="lg:col-span-5">
                    <div class="sticky top-24 space-y-4">
                        <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700 shadow-lg">
                            <div class="p-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                                <h4 class="font-bold flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">map</span>
                                    Visualisasi Rute Optimal
                                </h4>
                                <span class="text-xs bg-primary/10 text-primary px-2 py-1 rounded-full font-bold">
                                    {{ count($results) }} Destinasi + Pulang
                                </span>
                            </div>

                            <div class="relative h-[420px] bg-gray-200 dark:bg-gray-900 overflow-hidden">
                                <div id="map-container"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-4 flex flex-col justify-end bg-gradient-to-t from-gray-950/80 to-transparent pointer-events-none z-[1000]">
                                    <div class="bg-white/10 backdrop-blur-md p-3 rounded-xl border border-white/20">
                                        <p class="text-xs text-white leading-relaxed">
                                            <span class="text-blue-400 font-black uppercase tracking-widest block mb-0.5">PSO Route Intelligence</span>
                                            Rute dioptimasi dari {{ session('pso_data.location', 'titik Anda') }} → {{ count($results) }} destinasi → pulang.
                                            Total: <strong>{{ number_format($totalJarak, 1) }} km</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="px-4 py-3 border-t border-gray-100 dark:border-gray-700 flex flex-wrap gap-4 text-xs text-gray-500">
                                <span class="flex items-center gap-1.5">
                                    <span class="size-3 rounded-full bg-blue-500 inline-block"></span> Titik Awal
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <span class="size-3 rounded-full bg-primary inline-block"></span> Destinasi
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <span class="size-3 rounded-full bg-green-500 inline-block"></span> Pulang
                                </span>
                            </div>

                            <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                                <a id="gmaps-btn" target="_blank"
                                   class="w-full flex items-center justify-center gap-2 bg-primary text-white font-bold py-3 rounded-xl hover:bg-primary/90 transition">
                                    <span class="material-symbols-outlined text-base">directions</span>
                                    Buka Rute di Google Maps
                                </a>
                            </div>
                        </div>

                        {{-- Ringkasan Jarak Per Segmen --}}
                        @if(!empty($pso_rute['urutan_rute']))
                        <div class="bg-white dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-5">
                            <h4 class="font-bold text-sm mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-base">straighten</span>
                                Jarak Per Segmen
                            </h4>
                            <div class="space-y-2">
                                @foreach($pso_rute['urutan_rute'] as $seg)
                                    @if(isset($seg['jarak_ke_berikut']) && $seg['jarak_ke_berikut'] > 0)
                                    <div class="flex items-center justify-between text-xs py-1.5 border-b border-gray-100 dark:border-gray-700/50 last:border-0">
                                        <span class="text-gray-600 dark:text-gray-400 truncate max-w-[60%]">
                                            {{ $seg['urutan'] + 1 }}. {{ $seg['nama'] }}
                                        </span>
                                        <span class="font-bold text-primary">{{ $seg['jarak_ke_berikut'] }} km →</span>
                                    </div>
                                    @endif
                                @endforeach
                                <div class="flex items-center justify-between text-xs pt-2 font-bold">
                                    <span class="text-gray-700 dark:text-gray-200">Total Perjalanan</span>
                                    <span class="text-primary">{{ number_format($pso_rute['total_jarak'] ?? 0, 1) }} km</span>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

            </div>{{-- end main grid --}}
        </div>
    </main>

    <footer class="text-center py-8 px-4 border-t border-[#f0f2f4] dark:border-gray-700/50 mt-12">
        <div class="flex justify-center gap-6 mb-4">
            <span class="text-xs text-[#616f89] dark:text-gray-500 flex items-center gap-1">
                <span class="material-symbols-outlined text-sm">bolt</span>
                Powered by PSO Algorithm
            </span>
        </div>
        <p class="text-sm text-[#616f89] dark:text-gray-400">
            © {{ date('Y') }} <span class="text-[#111318] dark:text-gray-300">Sistem Informasi Pariwisata Kabupaten Trenggalek.</span>
        </p>
    </footer>
</div>

{{-- STICKY UPDATE BAR --}}
<div id="update-bar"
     class="no-print fixed bottom-0 left-0 right-0 z-[9000] translate-y-full">
    <div class="bg-[#111318] text-white px-4 sm:px-8 md:px-20 lg:px-40 py-4 flex flex-wrap items-center justify-between gap-3 shadow-2xl border-t border-white/10">
        <div class="flex items-center gap-3">
            <div class="size-8 rounded-full bg-yellow-400 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-[#111318] text-base" style="font-variation-settings:'FILL' 1">edit_note</span>
            </div>
            <div>
                <p class="font-bold text-sm">Ada Perubahan Itinerary</p>
                <p id="change-summary" class="text-xs text-gray-400 mt-0.5"></p>
            </div>
        </div>
        <div class="flex gap-3">
            <button onclick="cancelChanges()"
                class="px-4 py-2 text-sm font-bold border border-gray-600 rounded-lg hover:bg-gray-800 transition">
                Batalkan
            </button>
            <button onclick="applyChanges()"
                class="flex items-center gap-2 px-5 py-2.5 bg-primary text-white text-sm font-bold rounded-lg hover:bg-primary/90 transition shadow-lg">
                <span class="material-symbols-outlined text-base">route</span>
                Perbarui Rute PSO
            </button>
        </div>
    </div>
</div>

{{-- HIDDEN FORM --}}
<form id="update-form" method="POST" action="{{ route('rekomendasi.updateRute') }}" class="hidden">
    @csrf
    <div id="removed-inputs"></div>
    <div id="added-inputs"></div>
</form>

{{-- MODAL TAMBAH DESTINASI --}}
<div id="modal-tambah"
     class="no-print hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4"
     role="dialog" aria-modal="true" aria-labelledby="modal-title">

    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal()"></div>

    <div class="relative w-full sm:max-w-2xl bg-white dark:bg-gray-900 rounded-t-3xl sm:rounded-2xl shadow-2xl flex flex-col max-h-[92vh] sm:max-h-[85vh]">

        <div class="flex items-center justify-between p-5 border-b border-gray-100 dark:border-gray-700 flex-shrink-0">
            <div>
                <h2 id="modal-title" class="text-lg font-bold text-[#111318] dark:text-white">Tambah Destinasi</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Pilih dari daftar wisata Trenggalek</p>
            </div>
            <button onclick="closeModal()"
                class="size-9 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                <span class="material-symbols-outlined text-gray-600 dark:text-gray-300 text-lg">close</span>
            </button>
        </div>

        <div class="px-5 pt-4 pb-2 flex-shrink-0">
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">search</span>
                <input type="text" id="modal-search" placeholder="Cari nama destinasi..."
                    class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-200 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-800 text-[#111318] dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/40"
                    oninput="filterModal()">
            </div>
        </div>

        <div class="px-5 pb-3 flex-shrink-0 overflow-x-auto">
            <div id="category-tabs" class="flex gap-2 pb-1"></div>
        </div>

        <div id="modal-dest-grid"
             class="flex-1 overflow-y-scroll px-5 pb-4 grid grid-cols-1 sm:grid-cols-2 gap-4 content-start">
        </div>

        <div class="flex-shrink-0 p-5 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between gap-3">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Dipilih: <span id="modal-selected-count" class="font-bold text-primary">0</span> destinasi
            </p>
            <div class="flex gap-3">
                <button onclick="closeModal()"
                    class="px-4 py-2 text-sm font-bold border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                    Batal
                </button>
                <button onclick="confirmAddDestinations()" id="modal-confirm-btn" disabled
                    class="flex items-center gap-2 px-5 py-2.5 bg-green-500 text-white text-sm font-bold rounded-lg transition disabled:opacity-40 disabled:cursor-not-allowed hover:bg-green-600">
                    <span class="material-symbols-outlined text-base">add_location_alt</span>
                    Tambahkan ke Itinerary
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

<script>
const ruteData = @json($pso_rute['urutan_rute'] ?? []);
const homeLat  = parseFloat("{{ session('pso_data.latitude', -8.0581) }}");
const homeLng  = parseFloat("{{ session('pso_data.longitude', 111.7118) }}");
const homeName = @json(session('pso_data.location', 'Lokasi Anda'));

@php
    $wisataJs = isset($semuaWisata) ? $semuaWisata->map(function($w) {
        return [
            'id'          => $w->id,
            'nama'        => $w->nama,
            'kategori'    => $w->kategori ?? '',
            'kecamatan'   => $w->kecamatan ?? '',
            'rating'      => $w->rating ?? 0,
            'harga_tiket' => $w->harga_tiket ?? 0,
            'gambar'      => $w->gambar ?? '',
            'jam_buka'    => $w->jam_buka ?? '',
            'jam_tutup'   => $w->jam_tutup ?? '',
            'fasilitas'   => $w->fasilitas ?? '',
        ];
    })->values()->toArray() : [];
    $currentIdsJs = collect($results ?? [])->pluck('id')->values()->toArray();
@endphp
const semuaWisata = @json($wisataJs);
const currentIds = @json($currentIdsJs ?? []);

let pendingRemovals  = [];
let pendingAdditions = [];
let selectedInModal  = [];
let activeCategory   = '';
let searchQuery      = '';

// ── Mobile Menu ──
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

// ── Hapus Destinasi ──
function removeDestination(id, name) {
    const card = document.getElementById('dest-card-' + id);
    if (!card) return;

    const alreadyRemoving = pendingRemovals.some(r => r.id === id);

    if (alreadyRemoving) {
        pendingRemovals = pendingRemovals.filter(r => r.id !== id);
        card.classList.remove('dest-card-removing');
        const btn = card.querySelector('.remove-btn');
        if (btn) {
            btn.innerHTML = `<span class="material-symbols-outlined text-[12px]" style="font-variation-settings:'FILL' 1">delete</span> Hapus`;
            btn.classList.remove('bg-gray-500', 'hover:bg-gray-600');
            btn.classList.add('bg-red-500', 'hover:bg-red-600');
        }
    } else {
        pendingRemovals.push({ id, name });
        card.classList.add('dest-card-removing');
        const btn = card.querySelector('.remove-btn');
        if (btn) {
            btn.innerHTML = `<span class="material-symbols-outlined text-[12px]" style="font-variation-settings:'FILL' 1">undo</span> Batalkan`;
            btn.classList.remove('bg-red-500', 'hover:bg-red-600');
            btn.classList.add('bg-gray-500', 'hover:bg-gray-600');
        }
    }

    updateChangeBar();
}

// ── Update Bar ──
function updateChangeBar() {
    const bar     = document.getElementById('update-bar');
    const summary = document.getElementById('change-summary');
    const total   = pendingRemovals.length + pendingAdditions.length;

    if (total === 0) {
        bar.classList.remove('show');
    } else {
        const parts = [];
        if (pendingRemovals.length > 0)  parts.push(`${pendingRemovals.length} destinasi akan dihapus`);
        if (pendingAdditions.length > 0) parts.push(`${pendingAdditions.length} destinasi akan ditambahkan`);
        summary.textContent = parts.join(' · ');
        bar.classList.add('show');
    }
}

function cancelChanges() {
    pendingRemovals.forEach(r => {
        const card = document.getElementById('dest-card-' + r.id);
        if (card) {
            card.classList.remove('dest-card-removing');
            const btn = card.querySelector('.remove-btn');
            if (btn) {
                btn.innerHTML = `<span class="material-symbols-outlined text-[12px]" style="font-variation-settings:'FILL' 1">delete</span> Hapus`;
                btn.classList.remove('bg-gray-500', 'hover:bg-gray-600');
                btn.classList.add('bg-red-500', 'hover:bg-red-600');
            }
        }
    });
    pendingRemovals  = [];
    pendingAdditions = [];
    updateChangeBar();
    renderModalCards();
}

function applyChanges() {
    if (pendingRemovals.length === 0 && pendingAdditions.length === 0) return;

    const form       = document.getElementById('update-form');
    const removedDiv = document.getElementById('removed-inputs');
    const addedDiv   = document.getElementById('added-inputs');
    removedDiv.innerHTML = '';
    addedDiv.innerHTML   = '';

    pendingRemovals.forEach(r => {
        const inp = document.createElement('input');
        inp.type = 'hidden'; inp.name = 'removed_ids[]'; inp.value = r.id;
        removedDiv.appendChild(inp);
    });

    pendingAdditions.forEach(a => {
        const inp = document.createElement('input');
        inp.type = 'hidden'; inp.name = 'added_ids[]'; inp.value = a.id;
        addedDiv.appendChild(inp);
    });

    const btn = document.querySelector('#update-bar button:last-child');
    if (btn) {
        btn.innerHTML = `<span class="material-symbols-outlined text-base animate-spin">progress_activity</span> Mengoptimasi Rute...`;
        btn.disabled = true;
    }

    form.submit();
}

// ── Modal ──
function openModal() {
    const modal = document.getElementById('modal-tambah');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';

    activeCategory = '';
    searchQuery    = '';
    const searchInput = document.getElementById('modal-search');
    if (searchInput) searchInput.value = '';
    document.getElementById('modal-dest-grid').innerHTML = '';

    renderCategoryTabs();
    renderModalCards();
    setTimeout(() => searchInput?.focus(), 100);
}

function closeModal() {
    document.getElementById('modal-tambah').classList.add('hidden');
    document.body.style.overflow = '';
}

function renderCategoryTabs() {
    const tabContainer = document.getElementById('category-tabs');
    const cats = [...new Set(semuaWisata.map(w => w.kategori))].sort();
    tabContainer.innerHTML = '';
    cats.forEach((cat, index) => {
        const isFirst = index === 0;
        const btn = document.createElement('button');
        btn.className = isFirst
            ? 'cat-pill active flex-shrink-0 px-3 py-1.5 text-xs font-bold rounded-full bg-primary text-white border border-primary transition'
            : 'cat-pill flex-shrink-0 px-3 py-1.5 text-xs font-bold rounded-full border border-gray-200 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 transition';
        btn.dataset.cat  = cat;
        btn.textContent  = cat;
        btn.onclick = () => filterByCategory(cat, btn);
        tabContainer.appendChild(btn);
        if (isFirst) activeCategory = cat;
    });
}

function filterByCategory(cat, btnEl) {
    activeCategory = cat;
    document.querySelectorAll('.cat-pill').forEach(b => {
        b.classList.remove('active', 'bg-primary', 'text-white', 'border-primary');
        b.classList.add('bg-gray-100', 'text-gray-600', 'border-gray-200');
    });
    btnEl.classList.add('active', 'bg-primary', 'text-white', 'border-primary');
    btnEl.classList.remove('bg-gray-100', 'text-gray-600', 'border-gray-200');
    renderModalCards();
}

function filterModal() {
    searchQuery = document.getElementById('modal-search').value.toLowerCase();
    renderModalCards();
}

function renderModalCards() {
    const grid = document.getElementById('modal-dest-grid');

    const activeIds = currentIds
        .filter(id => !pendingRemovals.some(r => Number(r.id) === Number(id)))
        .map(Number);
    const addedIds = pendingAdditions.map(a => Number(a.id));

    let filtered = semuaWisata.filter(w => {
        const matchCat    = !activeCategory || w.kategori === activeCategory;
        const matchSearch = !searchQuery || w.nama.toLowerCase().includes(searchQuery) || (w.kecamatan || '').toLowerCase().includes(searchQuery);
        return matchCat && matchSearch;
    });

    if (filtered.length === 0) {
        grid.innerHTML = `
            <div class="col-span-2 text-center py-10 text-gray-400">
                <span class="material-symbols-outlined text-4xl block mb-2">search_off</span>
                <p class="text-sm">Tidak ada destinasi ditemukan</p>
            </div>`;
        return;
    }

    grid.innerHTML = filtered.map(w => {
        const isCurrentlyInItinerary = activeIds.includes(w.id);
        const isPendingAdd = addedIds.includes(w.id);
        const isSelected   = selectedInModal.includes(w.id);

        const statusBadge = isCurrentlyInItinerary
            ? `<span class="absolute top-2 left-2 bg-blue-500 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-full z-10">Sudah ada</span>`
            : isPendingAdd
            ? `<span class="absolute top-2 left-2 bg-green-500 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-full z-10">Akan ditambah</span>`
            : '';

        const checkIcon = (isSelected || isPendingAdd)
            ? `<div class="absolute top-2 right-2 size-5 rounded-full bg-primary flex items-center justify-center z-10">
                    <span class="material-symbols-outlined text-white text-[12px]" style="font-variation-settings:'FILL' 1">check</span>
               </div>`
            : '';

        const imgSrc = (w.gambar && w.gambar !== 'default.jpg' && w.gambar !== '')
            ? w.gambar
            : `https://placehold.co/600x200/135bec/ffffff?text=${encodeURIComponent(w.nama)}`;

        const disabledAttr = isCurrentlyInItinerary ? 'pointer-events-none opacity-50' : '';

        return `
        <div class="modal-dest-card relative rounded-xl border-2 ${isCurrentlyInItinerary ? 'border-gray-200 dark:border-gray-700' : isSelected || isPendingAdd ? 'selected border-primary' : 'border-gray-200 dark:border-gray-700 hover:border-primary/50'} ${disabledAttr} cursor-pointer bg-white dark:bg-gray-800"
             onclick="toggleModalCard(${w.id}, '${w.nama.replace(/'/g, "\\'")}', this)"
             data-id="${w.id}">
            ${statusBadge}
            ${checkIcon}
            <div class="relative h-36 bg-gray-100 dark:bg-gray-800 overflow-hidden">
                <img src="${imgSrc}" alt="${w.nama}" onerror="this.onerror=null;this.src='https://placehold.co/600x200/135bec/ffffff?text=Wisata';" class="w-full h-full object-cover">
                <div class="absolute bottom-2 left-2">
                    <span class="bg-primary text-white text-[9px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wide">${w.kategori}</span>
                </div>
            </div>
            <div class="p-3">
                <p class="font-bold text-sm text-[#111318] dark:text-white leading-snug line-clamp-2 mb-2">${w.nama}</p>
                <div class="flex items-center justify-between mb-1">
                    <span class="text-[11px] text-gray-500 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[11px]">location_on</span>
                        ${w.kecamatan || '-'}
                    </span>
                    <span class="text-[11px] text-gray-400 flex items-center gap-0.5">
                        <span class="material-symbols-outlined text-[11px] text-orange-400" style="font-variation-settings:'FILL' 1">star</span>
                        ${w.rating || '-'}
                    </span>
                </div>
                <p class="text-[11px] text-green-600 dark:text-green-400 font-bold">
                    ${(w.harga_tiket == 0 || !w.harga_tiket) ? 'Gratis' : 'Rp ' + Number(w.harga_tiket).toLocaleString('id-ID')}
                </p>
            </div>
        </div>`;
    }).join('');

    updateModalSelectedCount();
}

function toggleModalCard(id, name, cardEl) {
    const activeIds = currentIds.filter(cid => !pendingRemovals.some(r => r.id == cid));
    if (activeIds.includes(id)) return;

    const isPendingAdd = pendingAdditions.some(a => a.id === id);
    if (isPendingAdd) {
        pendingAdditions = pendingAdditions.filter(a => a.id !== id);
        selectedInModal  = selectedInModal.filter(sid => sid !== id);
    } else {
        const isSelected = selectedInModal.includes(id);
        if (isSelected) {
            selectedInModal = selectedInModal.filter(sid => sid !== id);
        } else {
            selectedInModal.push(id);
        }
    }

    renderModalCards();
    updateModalSelectedCount();
}

function updateModalSelectedCount() {
    const count = selectedInModal.length;
    document.getElementById('modal-selected-count').textContent = count;
    document.getElementById('modal-confirm-btn').disabled = count === 0;
}

function confirmAddDestinations() {
    if (selectedInModal.length === 0) return;

    selectedInModal.forEach(id => {
        const wisata = semuaWisata.find(w => w.id === id);
        if (wisata && !pendingAdditions.some(a => a.id === id)) {
            pendingAdditions.push({ id: wisata.id, name: wisata.nama });
        }
    });
    selectedInModal = [];

    closeModal();
    updateChangeBar();
    renderModalCards();
}

// ── Leaflet Map ──
document.addEventListener('DOMContentLoaded', function () {

    if (!ruteData || ruteData.length === 0) return;

    const map = L.map('map-container');
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
    }).addTo(map);

    const waypoints = ruteData.map(stop => ({
        lat:     parseFloat(stop.latitude),
        lng:     parseFloat(stop.longitude),
        nama:    stop.nama,
        tipe:    stop.tipe,
        urutan:  stop.urutan,
        fitness: stop.fitness_score ?? null,
    }));

    function iconAsal() {
        return L.divIcon({
            className: '',
            html: `<div style="width:36px;height:36px;border-radius:50%;background:#3b82f6;border:3px solid white;
                        box-shadow:0 2px 8px rgba(0,0,0,0.35);display:flex;align-items:center;justify-content:center;">
                       <span style="color:white;font-size:16px;font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24"
                             class="material-symbols-outlined">my_location</span>
                   </div>`,
            iconSize: [36, 36], iconAnchor: [18, 18],
        });
    }

    function iconPulang() {
        return L.divIcon({
            className: '',
            html: `<div style="width:36px;height:36px;border-radius:50%;background:#22c55e;border:3px solid white;
                        box-shadow:0 2px 8px rgba(0,0,0,0.35);display:flex;align-items:center;justify-content:center;">
                       <span style="color:white;font-size:16px;font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24"
                             class="material-symbols-outlined">home</span>
                   </div>`,
            iconSize: [36, 36], iconAnchor: [18, 18],
        });
    }

    function iconDestinasi(nomor) {
        return L.divIcon({
            className: '',
            html: `<div style="width:34px;height:34px;border-radius:50%;background:#135bec;border:3px solid white;
                        box-shadow:0 2px 8px rgba(0,0,0,0.35);display:flex;align-items:center;justify-content:center;
                        color:white;font-weight:bold;font-size:13px;">${nomor}</div>`,
            iconSize: [34, 34], iconAnchor: [17, 17],
        });
    }

    const leafletWaypoints = [];

    waypoints.forEach(stop => {
        const latlng = L.latLng(stop.lat, stop.lng);
        leafletWaypoints.push(latlng);

        let marker;
        if (stop.tipe === 'asal') {
            marker = L.marker(latlng, { icon: iconAsal() })
                .bindPopup(`<b>🏠 START</b><br>${stop.nama}`, { maxWidth: 200 });
        } else if (stop.tipe === 'kembali') {
            marker = L.marker(latlng, { icon: iconPulang() })
                .bindPopup(`<b>🏠 FINISH — Kembali ke Rumah</b><br>${stop.nama}`, { maxWidth: 200 });
        } else {
            marker = L.marker(latlng, { icon: iconDestinasi(stop.urutan) })
                .bindPopup(
                    `<b>Destinasi ke-${stop.urutan}</b><br>${stop.nama}` +
                    (stop.fitness ? `<br><small>Fitness: ${stop.fitness}%</small>` : ''),
                    { maxWidth: 220 }
                );
        }
        marker.addTo(map);
    });

    if (leafletWaypoints.length >= 2) {
        L.Routing.control({
            waypoints: leafletWaypoints,
            lineOptions: {
                styles: [{ color: '#135bec', weight: 5, opacity: 0.85 }],
            },
            createMarker: function () { return null; },
            addWaypoints: false,
            draggableWaypoints: false,
            routeWhileDragging: false,
            fitSelectedRoutes: true,
            show: false,
        }).addTo(map);
    }

    const group = L.featureGroup(leafletWaypoints.map(ll => L.circleMarker(ll)));
    map.fitBounds(group.getBounds().pad(0.25));

    const destinations = waypoints.filter(s => s.tipe === 'destinasi');
    const gmapsUrl =
        'https://www.google.com/maps/dir/?api=1' +
        `&origin=${homeLat},${homeLng}` +
        `&destination=${homeLat},${homeLng}` +
        (destinations.length > 0
            ? `&waypoints=${destinations.map(s => `${s.lat},${s.lng}`).join('|')}`
            : '') +
        '&travelmode=driving';

    document.getElementById('gmaps-btn').href = gmapsUrl;
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModal();
});
</script>
</body>
</html>