<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rekomendasi PSO Trenggalek - Langkah 2</title>
    
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
        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            background: var(--primary);
            cursor: pointer;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
                        <div class="flex flex-wrap justify-between gap-3 p-4 mb-6">
                            <div class="flex min-w-72 flex-col gap-3">
                                <p class="text-[#111318] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Lokasi &amp; Detail Perjalanan</p>
                                <p class="text-[#616f89] dark:text-gray-400 text-base font-normal leading-normal">Langkah 2: Tentukan titik awal dan preferensi biaya untuk optimasi rute PSO.</p>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3 p-4 mb-8">
                            <div class="flex gap-6 justify-between">
                                <p class="text-[#111318] dark:text-gray-300 text-base font-medium leading-normal">Langkah 2 dari 4</p>
                                <p class="text-primary text-sm font-bold">50% Selesai</p>
                            </div>
                            <div class="rounded-full bg-[#dbdfe6] dark:bg-gray-700">
                                <div class="h-2 rounded-full bg-primary" style="width: 50%;"></div>
                            </div>
                        </div>

                        <div class="mx-4 mb-8 p-4 bg-primary/5 border border-primary/20 rounded-xl flex gap-4 items-start">
                            <span class="material-symbols-outlined text-primary">psychology</span>
                            <div>
                                <h4 class="text-primary font-bold text-sm mb-1">Optimasi PSO (Particle Swarm Optimization)</h4>
                                <p class="text-[#616f89] dark:text-gray-400 text-xs leading-relaxed">
                                    Lokasi awal (Home), durasi, dan anggaran Anda akan menjadi koordinat target bagi "partikel" algoritma kami. Partikel-partikel ini akan menghitung <strong>Inertia</strong> dan rute optimal untuk menemukan kombinasi destinasi yang paling efisien dari posisi Anda saat ini.
                                </p>
                            </div>
                        </div>

                        <form action="{{ route('rekomendasi.simpanLangkah2') }}" method="POST" class="space-y-8">
                            @csrf
                            {{-- Input Hidden untuk Akurasi Jarak --}}
                            <input type="hidden" name="latitude" id="lat_hidden" value="{{ old('latitude', '-8.0581') }}">
                            <input type="hidden" name="longitude" id="lng_hidden" value="{{ old('longitude', '111.7118') }}">
                            <input type="hidden" name="nama_lokasi_user" id="nama_lokasi_hidden" value="{{ old('nama_lokasi_user', 'Trenggalek') }}">

                            <div class="bg-white dark:bg-background-dark dark:border dark:border-gray-700/50 p-6 rounded-xl shadow-sm">
                                <div class="space-y-12 px-4 py-4">
                                    {{-- Input Lokasi --}}
                                    <div class="relative">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center gap-3">
                                                <span class="material-symbols-outlined p-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-primary">my_location</span>
                                                <div>
                                                    <label class="block text-lg font-bold text-[#111318] dark:text-white">Titik Awal (Home)</label>
                                                    <p class="text-xs text-[#616f89] dark:text-gray-400">Lokasi ini membantu PSO menentukan efisiensi perjalanan</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-4">
                                            <button id="btn-geolocation" class="flex items-center justify-center gap-3 w-full sm:w-auto px-6 py-4 border-2 border-dashed border-primary/30 rounded-xl bg-primary/5 hover:bg-primary/10 transition-all text-primary font-bold" type="button">
                                                <span class="material-symbols-outlined">gps_fixed</span>
                                                Gunakan Lokasi Saat Ini
                                            </button>
                                            <div class="flex items-center gap-2">
                                                <div class="h-px bg-gray-200 dark:bg-gray-800 flex-1"></div>
                                                <span class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Atau masukkan manual</span>
                                                <div class="h-px bg-gray-200 dark:bg-gray-800 flex-1"></div>
                                            </div>
                                            <div class="relative group">
                                                <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-400">map</span>
                                                <input name="location" id="location_display" value="{{ old('location', 'Trenggalek') }}" class="w-full pl-10 pr-4 py-3 rounded-lg border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 focus:border-primary focus:ring-primary text-sm" placeholder="Masukkan nama kota atau koordinat..." type="text" required/>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="border-gray-100 dark:border-gray-800"/>

                                    {{-- Slider Durasi --}}
                                    <div class="relative">
                                        <div class="flex items-center justify-between mb-6">
                                            <div class="flex items-center gap-3">
                                                <span class="material-symbols-outlined p-2 bg-gray-100 dark:bg-gray-800 rounded-lg text-primary">calendar_today</span>
                                                <div>
                                                    <label class="block text-lg font-bold text-[#111318] dark:text-white" for="duration-slider">Durasi Perjalanan</label>
                                                    <p class="text-xs text-[#616f89] dark:text-gray-400">Menentukan jangkauan radius pencarian objek wisata</p>
                                                </div>
                                            </div>
                                            <div class="bg-primary/10 text-primary px-4 py-1 rounded-full font-bold">
                                                <span id="duration-val">{{ old('duration', 3) }}</span> Hari
                                            </div>
                                        </div>
                                        <input name="duration" class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer accent-primary" id="duration-slider" max="7" min="1" oninput="document.getElementById('duration-val').innerText = this.value" type="range" value="{{ old('duration', 3) }}"/>
                                        <div class="flex justify-between text-xs font-medium text-gray-500 dark:text-gray-400 mt-4 px-1">
                                            <span>1 Hari (Singkat)</span>
                                            <span>4 Hari</span>
                                            <span>7+ Hari</span>
                                        </div>
                                    </div>

                                    <hr class="border-gray-100 dark:border-gray-800"/>

                                    {{-- Slider Anggaran --}}
                                    <div class="relative">
                                        <div class="flex items-center justify-between mb-6">
                                            <div class="flex items-center gap-3">
                                                <span class="material-symbols-outlined p-2 bg-gray-100 dark:bg-gray-800 rounded-lg text-primary">payments</span>
                                                <div>
                                                    <label class="block text-lg font-bold text-[#111318] dark:text-white" for="budget-slider">Estimasi Anggaran</label>
                                                    <p class="text-xs text-[#616f89] dark:text-gray-400">Parameter biaya per orang untuk pemfilteran partikel</p>
                                                </div>
                                            </div>
                                            <div class="bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 px-4 py-1 rounded-full font-bold">
                                                Rp <span id="budget-val">{{ number_format(old('budget', 500000), 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                        <input name="budget" class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer accent-primary" id="budget-slider" max="2000000" min="100000" oninput="document.getElementById('budget-val').innerText = parseInt(this.value).toLocaleString('id-ID')" step="50000" type="range" value="{{ old('budget', 500000) }}"/>
                                        <div class="flex justify-between text-xs font-medium text-gray-500 dark:text-gray-400 mt-4 px-1">
                                            <span>Rp 100rb</span>
                                            <span>Rp 1jt</span>
                                            <span>Rp 2jt+</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6">
                                <a href="{{ route('rekomendasi.langkah1') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 rounded-lg h-12 px-8 border border-gray-300 dark:border-gray-700 text-[#111318] dark:text-white text-base font-bold hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                    <span class="material-symbols-outlined">arrow_back</span>
                                    Kembali
                                </a>
                                <button class="w-full sm:w-auto flex min-w-[200px] items-center justify-center gap-2 rounded-lg h-12 px-10 bg-primary text-white text-base font-bold hover:bg-primary/90 transition-colors shadow-lg shadow-primary/20" type="submit">
                                    Lanjut ke Langkah 3
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
        document.addEventListener('DOMContentLoaded', function() {
            const btnGeo = document.getElementById('btn-geolocation');
            const latHidden = document.getElementById('lat_hidden');
            const lngHidden = document.getElementById('lng_hidden');
            const locDisplay = document.getElementById('location_display');
            const namaLokasiHidden = document.getElementById('nama_lokasi_hidden');

            // Fungsi Reverse Geocoding untuk mendapatkan nama wilayah dari koordinat
            async function getPlaceName(lat, lng) {
                try {
                    const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`);
                    const data = await response.json();
                    
                    const address = data.address;
                    const kecamatan = address.suburb || address.village || address.district || address.town || "";
                    const kota = address.city || address.regency || address.county || "";
                    
                    return kecamatan && kota ? `${kecamatan}, ${kota}` : data.display_name.split(',').slice(0, 2).join(',');
                } catch (error) {
                    return `Lokasi Terdeteksi (${lat.toFixed(4)}, ${lng.toFixed(4)})`;
                }
            }

            // Fungsi saat Geolokasi Berhasil
            async function handleSuccess(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                
                latHidden.value = lat;
                lngHidden.value = lng;

                locDisplay.value = "Menganalisis wilayah...";
                
                const wilayah = await getPlaceName(lat, lng);
                
                locDisplay.value = `📍 ${wilayah}`;
                namaLokasiHidden.value = wilayah; // Masukkan ke hidden input untuk backend
                
                btnGeo.innerHTML = '<span class="material-symbols-outlined">check_circle</span> Lokasi Terkunci';
                btnGeo.classList.remove('text-primary', 'bg-primary/5');
                btnGeo.classList.add('text-green-600', 'bg-green-50', 'border-green-200');
            }

            // Meminta izin lokasi otomatis saat halaman dimuat (Opsional)
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(handleSuccess, (err) => {
                    console.log("Menunggu interaksi user untuk GPS");
                });
            }

            // Event Listener Tombol GPS
            btnGeo.addEventListener('click', function() {
                if (navigator.geolocation) {
                    this.innerHTML = '<span class="material-symbols-outlined animate-spin">sync</span> Mencari Wilayah...';
                    navigator.geolocation.getCurrentPosition(handleSuccess, (error) => {
                        let msg = "Gagal mengakses lokasi.";
                        if(error.code === 1) msg = "Izin lokasi ditolak. Harap aktifkan izin GPS di browser.";
                        alert(msg);
                        this.innerHTML = '<span class="material-symbols-outlined">gps_fixed</span> Gunakan Lokasi Saat Ini';
                    });
                } else {
                    alert("Browser Anda tidak mendukung fitur lokasi.");
                }
            });

            // Update nama_lokasi_hidden jika user mengetik manual di input display
            locDisplay.addEventListener('input', function() {
                namaLokasiHidden.value = this.value;
            });
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