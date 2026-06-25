<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Tentang Trenggalek - Sistem Informasi Pariwisata</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#135bec",
                        "background-light": "#f6f6f8",
                        "background-dark": "#101622",
                        "biru-laut": "#005A8D",
                        "hijau-hutan": "#4B7F52",
                        "kuning-emas": "#FFC107",
                        "abu-gelap": "#343A40",
                        "putih-gading": "#F8F9FA",
                    },
                    fontFamily: {
                        "display": ["Public Sans", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="font-display bg-putih-gading dark:bg-background-dark text-abu-gelap dark:text-gray-200">
    <div class="relative flex min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            
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
            <main class="flex-1">
                <section class="w-full">
                    <div class="flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat items-center justify-center p-4 text-center" style='background-image: linear-gradient(rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.6) 100%), url("https://pesonakota.com/wp-content/uploads/Pantai-Trenggalek-dengan-Pemandangan-Terbaik-dan-Tiket-Murah.png");'>
                        <div class="flex flex-col gap-2 max-w-4xl">
                            <h1 class="text-white text-4xl font-black leading-tight tracking-tight md:text-5xl">Selamat Datang di Trenggalek, The Southern Paradise of Java</h1>
                            <h2 class="text-white text-base font-normal leading-normal md:text-lg">Mengenal Lebih Dekat Kekayaan Alam dan Budaya Kabupaten Trenggalek</h2>
                        </div>
                    </div>
                </section>

                <div class="px-4 md:px-10 lg:px-20 py-10 lg:py-16">
                    <div class="layout-content-container flex flex-col max-w-5xl mx-auto gap-12 lg:gap-16">
                        
                        <section>
                            <h2 class="text-hijau-hutan dark:text-green-300 text-3xl font-bold leading-tight tracking-tight text-center">Sejarah Singkat Trenggalek</h2>
                            <p class="mt-2 text-center text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Menelusuri jejak waktu Kabupaten Trenggalek — dari Prasasti Kamulan tahun 1194 M hingga menjadi kabupaten definitif yang kita kenal sekarang.</p>

                            <div class="mt-10 max-w-2xl mx-auto space-y-0">

                                {{-- Item 1 --}}
                                <div class="flex gap-4">
                                    <div class="flex flex-col items-center">
                                        <div class="w-10 h-10 rounded-full bg-hijau-hutan flex items-center justify-center flex-shrink-0">
                                            <span class="material-symbols-outlined text-white text-lg">history_edu</span>
                                        </div>
                                        <div class="w-0.5 h-full bg-gray-200 dark:bg-gray-700 mt-1"></div>
                                    </div>
                                    <div class="pb-8">
                                        <p class="text-hijau-hutan dark:text-green-300 font-bold text-base">929 M — Prasasti Kamsyaka</p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Bukti tertulis tertua keberadaan Trenggalek. Prasasti ini menyebut daerah <em>Perdikan Kampak</em> yang berbatasan dengan Samudra Indonesia — wilayah yang kini meliputi Panggul, Munjungan, dan Prigi — sebagai kawasan otonomi (swatantra).</p>
                                    </div>
                                </div>

                                {{-- Item 2 --}}
                                <div class="flex gap-4">
                                    <div class="flex flex-col items-center">
                                        <div class="w-10 h-10 rounded-full bg-hijau-hutan flex items-center justify-center flex-shrink-0">
                                            <span class="material-symbols-outlined text-white text-lg">description</span>
                                        </div>
                                        <div class="w-0.5 h-full bg-gray-200 dark:bg-gray-700 mt-1"></div>
                                    </div>
                                    <div class="pb-8">
                                        <p class="text-hijau-hutan dark:text-green-300 font-bold text-base">31 Agustus 1194 M — Hari Jadi Resmi</p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Tanggal ini ditetapkan sebagai Hari Jadi Kabupaten Trenggalek berdasarkan <em>Prasasti Kamulan</em>, yang dikeluarkan oleh Raja Kertajaya dari Kediri. Prasasti ini menjadi bukti konkret paling kuat keberadaan Trenggalek sebagai wilayah pemerintahan.</p>
                                    </div>
                                </div>

                                {{-- Item 3 --}}
                                <div class="flex gap-4">
                                    <div class="flex flex-col items-center">
                                        <div class="w-10 h-10 rounded-full bg-hijau-hutan flex items-center justify-center flex-shrink-0">
                                            <span class="material-symbols-outlined text-white text-lg">person</span>
                                        </div>
                                        <div class="w-0.5 h-full bg-gray-200 dark:bg-gray-700 mt-1"></div>
                                    </div>
                                    <div class="pb-8">
                                        <p class="text-hijau-hutan dark:text-green-300 font-bold text-base">Abad ke-16 — Menak Sopal & Legenda Nama</p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Menak Sopal, adipati pertama Trenggalek, membangun <em>Dam Bagong</em> untuk mengairi wilayah yang kering. Namanya diabadikan dalam tradisi <em>Nyadran Bagong</em> — upacara tahunan pelemparan tumbal kepala kerbau ke Dam Bagong yang masih digelar hingga kini. Nama "Trenggalek" dipercaya berasal dari <em>terang ing galih</em> (benderangnya hati), yang diucapkan Ki Ageng Sinawang.</p>
                                    </div>
                                </div>

                                {{-- Item 4 --}}
                                <div class="flex gap-4">
                                    <div class="flex flex-col items-center">
                                        <div class="w-10 h-10 rounded-full bg-hijau-hutan flex items-center justify-center flex-shrink-0">
                                            <span class="material-symbols-outlined text-white text-lg">gavel</span>
                                        </div>
                                        <div class="w-0.5 h-full bg-gray-200 dark:bg-gray-700 mt-1"></div>
                                    </div>
                                    <div class="pb-8">
                                        <p class="text-hijau-hutan dark:text-green-300 font-bold text-base">1755 — Perjanjian Giyanti</p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Kerajaan Mataram Islam pecah menjadi Kasunanan Surakarta dan Kesultanan Yogyakarta. Wilayah Trenggalek (kecuali Panggul dan Munjungan) masuk ke bawah kekuasaan Kasunanan Surakarta sebagai bagian dari wilayah Ponorogo.</p>
                                    </div>
                                </div>

                                {{-- Item 5 --}}
                                <div class="flex gap-4">
                                    <div class="flex flex-col items-center">
                                        <div class="w-10 h-10 rounded-full bg-hijau-hutan flex items-center justify-center flex-shrink-0">
                                            <span class="material-symbols-outlined text-white text-lg">flag</span>
                                        </div>
                                        <div class="w-0.5 h-full bg-gray-200 dark:bg-gray-700 mt-1"></div>
                                    </div>
                                    <div class="pb-8">
                                        <p class="text-hijau-hutan dark:text-green-300 font-bold text-base">1845 — Daerah Otonom di Bawah Hindia Belanda</p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Pemerintah Hindia Belanda menetapkan Trenggalek sebagai daerah otonom. Pada masa ini Trenggalek terdiri dari 4 kawedanan: Trenggalek, Panggul, Kampak, dan Karangan. Bupati yang paling dikenang dari era ini adalah <em>Mangoen Negoro II</em> (Kanjeng Jimat), yang makamnya di Desa Ngulankulon, Pogalan, diabadikan sebagai nama jalan di Trenggalek.</p>
                                    </div>
                                </div>

                                {{-- Item 6 --}}
                                <div class="flex gap-4">
                                    <div class="flex flex-col items-center">
                                        <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center flex-shrink-0">
                                            <span class="material-symbols-outlined text-white text-lg">account_balance</span>
                                        </div>
                                    </div>
                                    <div class="pb-2">
                                        <p class="text-primary dark:text-blue-300 font-bold text-base">1950 — Kabupaten Definitif (UU No. 12 Tahun 1950)</p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Berdasarkan Undang-Undang Nomor 12 Tahun 1950, Trenggalek resmi berdiri kembali sebagai kabupaten dalam Tata Administrasi Pemerintah Republik Indonesia — dengan 14 kecamatan, 152 desa, dan 5 kelurahan seperti yang kita kenal sekarang. Luas wilayah <strong>1.261,40 km²</strong>, berpenduduk <strong>753.810 jiwa</strong> (BPS 2024), berjarak <strong>180 km dari Surabaya</strong>.</p>
                                    </div>
                                </div>

                            </div>
                        </section>

                    <!-- BUDAYA LOKAL YANG KAYA -->
<section>
    <h2 class="text-hijau-hutan dark:text-green-300 text-3xl font-bold leading-tight tracking-tight text-center">Budaya Lokal yang Kaya</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
        @forelse($budaya as $item)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden transform hover:-translate-y-2 transition-all">
                <img alt="{{ $item->nama }}" class="w-full h-48 object-cover" src="{{ $item->gambar }}"/>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-biru-laut dark:text-blue-300">{{ $item->nama }}</h3>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($item->deskripsi, 120) }}</p>
                    <a href="{{ route('destinasi.show', $item->id) }}" class="inline-block mt-3 text-primary hover:text-primary/80 text-sm font-semibold">
                        Selengkapnya →
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500">
                <p class="text-lg">Tidak ada data budaya tersedia</p>
            </div>
        @endforelse
    </div>
</section>

<!-- SAJIAN KULINER KHAS -->
<section>
    <h2 class="text-hijau-hutan dark:text-green-300 text-3xl font-bold leading-tight tracking-tight text-center">Sajian Kuliner Khas</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        @forelse($kuliner as $item)
            <div class="relative group rounded-lg overflow-hidden h-64">
                <img class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $item->gambar }}" alt="{{ $item->nama }}" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-4 w-full">
                    <h3 class="text-white text-lg font-bold">{{ $item->nama }}</h3>
                    <p class="text-gray-200 text-xs mt-1">{{ Str::limit($item->deskripsi, 80) }}</p>
                    <a href="{{ route('destinasi.show', $item->id) }}" class="inline-block mt-2 text-kuning-emas hover:text-yellow-300 text-xs font-semibold">
                        Lihat Detail →
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500">
                <p class="text-lg">Tidak ada data kuliner tersedia</p>
            </div>
        @endforelse
    </div>
</section>
                        <section class="text-center bg-biru-laut dark:bg-blue-900 rounded-xl p-8 lg:p-12 shadow-xl">
                            <h2 class="text-3xl font-bold text-white">Siap Menjelajahi Pesona Trenggalek?</h2>
                            <p class="mt-3 max-w-2xl mx-auto text-blue-100 opacity-90">Gunakan algoritma cerdas PSO untuk mendapatkan rencana perjalanan yang paling efisien.</p>
                            <a href="{{ route('rekomendasi.pso') }}" class="mt-6 inline-flex items-center justify-center rounded-lg h-12 px-8 bg-kuning-emas text-abu-gelap text-base font-bold hover:bg-yellow-400 transition-all transform hover:scale-105">
                                Lihat Rekomendasi Wisata
                            </a>
                        </section>
                    </div>
                </div>
            </main>

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