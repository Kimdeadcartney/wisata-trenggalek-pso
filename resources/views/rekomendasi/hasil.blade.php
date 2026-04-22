<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Itinerary PSO - Wisata Trenggalek</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />

    <style type="text/tailwindcss">
        :root {
            --primary: #135bec;
            --background-light: #f6f6f8;
            --background-dark: #101622;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        @media print {
            .no-print { display: none !important; }
            .print-only { display: block !important; }
            body { background: white !important; }
            .layout-content-container { max-width: 100% !important; padding: 0 !important; }
            .itinerary-card { border: 1px solid #ddd !important; box-shadow: none !important; }
        }
        /* Kontainer Map */
        #map-container { height: 100%; width: 100%; min-height: 400px; z-index: 1; }
        .leaflet-routing-container { display: none !important; } /* Sembunyikan teks instruksi rute agar rapi */
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
                },
            },
        }
    </script>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-[#111318] dark:text-gray-200">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            
            {{-- Header --}}
            <header class="no-print flex items-center justify-between whitespace-nowrap border-b border-solid border-[#f0f2f4] dark:border-gray-700/50 px-4 sm:px-8 md:px-20 lg:px-40 py-3 bg-white dark:bg-background-dark z-10 sticky top-0">
                <div class="flex items-center gap-4 text-[#111318] dark:text-white">
                    <div class="size-6 text-primary">
                        <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path d="M42.4379 44C42.4379 44 36.0744 33.9038 41.1692 24C46.8624 12.9336 42.2078 4 42.2078 4L7.01134 4C7.01134 4 11.6577 12.932 5.96912 23.9969C0.876273 33.9029 7.27094 44 7.27094 44L42.4379 44Z" fill="currentColor"></path>
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold leading-tight tracking-[-0.015em] uppercase">Wisata Trenggalek</h2>
                </div>
                <div class="hidden lg:flex flex-1 justify-end gap-8 items-center">
                    <div class="flex items-center gap-9">
                        <a class="text-sm font-medium hover:text-primary transition-colors" href="/">Home</a>
                        <a class="text-primary text-sm font-bold" href="#">Rekomendasi Cerdas</a>
                    </div>
                    <a href="{{ route('rekomendasi.langkah1') }}" class="bg-primary text-white text-sm font-bold px-4 py-2 rounded-lg hover:bg-primary/90 transition-all">
                        Reset Rute
                    </a>
                </div>
            </header>

            <main class="flex-1 px-4 sm:px-8 md:px-20 lg:px-40 py-10">
                <div class="layout-content-container flex flex-col max-w-[1200px] mx-auto flex-1">
                    
                    {{-- Title Section --}}
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                        <div>
                            <h1 class="text-[#111318] dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Itinerary Berbasis Lokasi Pengguna</h1>
                            <p class="text-[#616f89] dark:text-gray-400 text-base font-normal mt-2 flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm text-green-500">my_location</span>
                                Lokasi Awal: <strong class="text-primary">{{ session('pso_data.location', 'Terdeteksi Otomatis') }}</strong>
                            </p>
                        </div>
                        <div class="no-print flex gap-3">
                            <button onclick="window.print()" class="flex items-center gap-2 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                <span class="material-symbols-outlined text-lg">print</span>
                                <span class="text-sm font-bold">Cetak Rute</span>
                            </button>
                        </div>
                    </div>

                    
                   {{-- Stats Grid --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">

    {{-- Durasi --}}
    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm relative overflow-hidden">
        <p class="text-xs text-[#616f89] dark:text-gray-400 font-bold uppercase tracking-wider">
            Durasi
        </p>

        <p class="text-xl font-bold text-primary">
            @if(session('pso_data.duration') == 1)
                One Day Trip
            @elseif(session('pso_data.duration') == 2)
                Two Day Trip
            @else
                {{ session('pso_data.duration') }} Hari Trip
            @endif
        </p>
    </div>

    {{-- Total Destinasi --}}
    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm relative overflow-hidden">
        <p class="text-xs text-[#616f89] dark:text-gray-400 font-bold uppercase tracking-wider">
            Total Destinasi
        </p>
        <p class="text-xl font-bold text-primary">
            {{ count($results) }} Lokasi
        </p>
    </div>

    {{-- Metode Optimasi --}}
    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm relative overflow-hidden">
        <p class="text-xs text-[#616f89] dark:text-gray-400 font-bold uppercase tracking-wider">
            Metode Optimasi
        </p>
        <p class="text-xl font-bold text-primary">
            PSO Engine
        </p>
    </div>

   {{-- Skor Efisiensi --}}
<div class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm relative overflow-hidden">
    <p class="text-xs text-[#616f89] dark:text-gray-400 font-bold uppercase tracking-wider">
        Skor Efisiensi
    </p>

    @php
        // Hitung jumlah hasil untuk pembagi
        $jumlahData = count($results);
        
        // ===== 1. Rata-rata Fitness PSO =====
        $totalFitness = 0;
        foreach ($results as $r) {
            $totalFitness += (int) $r['fitness_score'];
        }

        // PERBAIKAN: Cek jika jumlahData > 0 agar tidak Division by Zero
        $avgFitness = ($jumlahData > 0) ? ($totalFitness / $jumlahData) : 0;


        // ===== 2. Total Jarak =====
        $totalJarak = 0;
        foreach ($results as $r) {
            $totalJarak += (float) $r['jarak'];
        }

        // Skor jarak realistis
        $maxJarak = 500;
        $skorJarak = max(0, 100 - (($totalJarak / $maxJarak) * 100));


        // ===== 3. Efisiensi Gabungan =====
        $efisiensi = (0.7 * $avgFitness) + (0.3 * $skorJarak);
    @endphp

    <div class="flex items-center gap-2">
        <p class="text-xl font-bold text-primary">
            {{ round($efisiensi) }}%
        </p>
        <span class="material-symbols-outlined text-green-500 text-sm">
            verified
        </span>
    </div>

    <p class="text-xs text-gray-400 mt-1">
        Fitness rata-rata: {{ round($avgFitness) }}%
    </p>

    <p class="text-xs text-gray-400">
        Total jarak: {{ round($totalJarak, 1) }} km
    </p>
</div>

</div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                        {{-- Left Column: Timeline --}}
                        <div class="lg:col-span-7 space-y-8">
                            <div class="itinerary-card bg-white dark:bg-gray-800/50 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm">
                                <div class="bg-primary px-6 py-4 flex justify-between items-center text-white">
                                    <h3 class="text-lg font-bold">Rencana Perjalanan Hari Ini</h3>
                                    <span class="text-sm bg-white/20 px-3 py-1 rounded-full backdrop-blur-sm">Urutan Terpendek</span>
                                </div>
                                <div class="p-6">
                                    <div class="relative flex flex-col gap-8 before:content-[''] before:absolute before:left-[17px] before:top-2 before:bottom-2 before:w-[2px] before:bg-gray-200 dark:before:bg-gray-700">
                                        
                                        {{-- User Starting Point --}}
                                        <div class="relative pl-12">
                                            <div class="absolute left-0 top-1 size-9 rounded-full bg-blue-50 dark:bg-blue-900/30 border-4 border-blue-500 flex items-center justify-center z-10">
                                                <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-lg">my_location</span>
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-2">
                                                    <h4 class="font-bold text-lg text-blue-600 dark:text-blue-400">Titik Keberangkatan</h4>
                                                    <span class="text-[10px] bg-blue-500 text-white px-2 py-0.5 rounded-full uppercase font-bold tracking-wider">START</span>
                                                </div>
                                                <p class="text-sm text-[#616f89] dark:text-gray-400 mb-2">{{ session('pso_data.location') }}</p>
                                            </div>
                                        </div>

                                        {{-- Dynamic Destinations --}}
                                        @foreach($results as $index => $item)
                                        <div class="relative pl-12">
                                            <div class="absolute left-0 top-1 size-9 rounded-full bg-white dark:bg-gray-800 border-4 border-primary flex items-center justify-center z-10">
                                                <span class="text-xs font-bold text-primary">{{ $index + 1 }}</span>
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-2 mb-1">
                                                    <h4 class="font-bold text-lg">{{ $item['nama'] }}</h4>
                                                    <span class="text-[10px] bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 px-2 py-0.5 rounded uppercase font-bold tracking-tighter italic">Fitness {{ $item['fitness_score'] }}%</span>
                                                </div>
                                                <p class="text-sm text-[#616f89] dark:text-gray-400 mb-2">Destinasi ini dipilih karena kecocokan kriteria.</p>
                                                <div class="flex flex-wrap gap-4 text-xs font-medium text-gray-500">
                                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">directions_car</span> {{ $item['jarak'] }} km</span>
                                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">payments</span> Rp {{ number_format($item['harga'], 0, ',', '.') }}</span>
                                                    <span class="flex items-center gap-1 text-orange-500"><span class="material-symbols-outlined text-sm">star</span> {{ $item['rating'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Right Column: Map --}}
                        <div class="lg:col-span-5 space-y-6">
                            <div class="sticky top-24 space-y-6">
                                <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700 shadow-lg">
                                    <div class="p-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                                        <h4 class="font-bold flex items-center gap-2">
                                            <span class="material-symbols-outlined text-primary">map</span> Visualisasi Optimasi Rute
                                        </h4>
                                    </div>
                                    <div class="relative h-[400px] bg-gray-200 dark:bg-gray-900 overflow-hidden">
                                        {{-- LEAFLET MAP CONTAINER --}}
                                        <div id="map-container"></div>
                                        
                                        <div class="absolute bottom-0 left-0 right-0 p-6 flex flex-col justify-end bg-gradient-to-t from-gray-950/80 to-transparent pointer-events-none z-[1000]">
                                            <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20">
                                                <p class="text-xs text-white leading-relaxed">
                                                    <span class="text-blue-400 font-black uppercase tracking-widest block mb-1">PSO Intelligence</span>
                                                    Menghitung {{ count($results) }} partikel destinasi dalam ruang koordinat {{ session('pso_data.location') }}.
                                                </p>
                                            </div>
                                        </div>   
                                    </div>
                                       {{-- TOMBOL GOOGLE MAPS DI BAWAH MAP --}}
            <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                <a id="gmaps-btn"
                   target="_blank"
                   class="w-full block text-center bg-primary text-white font-bold py-3 rounded-xl hover:bg-primary/90 transition">
                    Buka Rute di Google Maps
                </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

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

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

  <script>
document.addEventListener('DOMContentLoaded', function() {

    const homeLat = "{{ session('pso_data.latitude', -8.0581) }}";
    const homeLng = "{{ session('pso_data.longitude', 111.7118) }}";

    let results = @json($results);

    const map = L.map('map-container');

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    if (results.length > 0) {

        // Waypoints: Rumah -> Semua Wisata -> Balik Rumah
        const waypoints = [
            { lat: homeLat, lng: homeLng },

            ...results.map(item => ({
                lat: item.latitude,
                lng: item.longitude
            })),

            { lat: homeLat, lng: homeLng }
        ];

        // Routing Leaflet
        L.Routing.control({
            waypoints: waypoints.map(w => L.latLng(w.lat, w.lng)),

            lineOptions: {
                styles: [{ color: '#135bec', weight: 6, opacity: 0.8 }]
            },

            createMarker: function(i, wp) {

                if (i === 0) {
                    return L.marker(wp.latLng).bindPopup("<b>RUMAH (START)</b>");
                }

                if (i === waypoints.length - 1) {
                    return L.marker(wp.latLng).bindPopup("<b>RUMAH (FINISH)</b>");
                }

                const nomor = i;

                const iconAngka = L.divIcon({
                    className: "custom-marker",
                    html: `
                        <div style="
                            background:#135bec;
                            color:white;
                            font-weight:bold;
                            width:32px;
                            height:32px;
                            border-radius:50%;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            border:3px solid white;
                            box-shadow:0 2px 6px rgba(0,0,0,0.3);
                        ">
                            ${nomor}
                        </div>
                    `,
                    iconSize: [32, 32],
                    iconAnchor: [16, 16]
                });

                return L.marker(wp.latLng, { icon: iconAngka })
                    .bindPopup("<b>Tujuan ke-" + nomor + "</b><br>" + results[i - 1].nama);
            },

            addWaypoints: false,
            draggableWaypoints: false,
            routeWhileDragging: false,
            fitSelectedRoutes: true

        }).addTo(map);

        // Auto zoom semua titik
        const group = L.featureGroup(
            waypoints.map(w => L.marker([w.lat, w.lng]))
        );
        map.fitBounds(group.getBounds().pad(0.2));

        // ===== LINK GOOGLE MAPS ROUTE =====
        const origin = `${homeLat},${homeLng}`;
        const destination = `${homeLat},${homeLng}`;

        // Tengahnya jadi waypoint Google Maps
        const middleStops = results.map(item =>
            `${item.latitude},${item.longitude}`
        ).join("|");

        const gmapsUrl =
            `https://www.google.com/maps/dir/?api=1` +
            `&origin=${origin}` +
            `&destination=${destination}` +
            `&waypoints=${middleStops}` +
            `&travelmode=driving`;

        // Pasang ke tombol
        document.getElementById("gmaps-btn").href = gmapsUrl;
    }

});
</script>
</body>
</html>