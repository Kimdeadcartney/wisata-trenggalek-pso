<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Wisata Trenggalek - Jelajahi Pesona Tersembunyi</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
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
        /* Custom Swiper Style */
        .swiper-button-next, .swiper-button-prev {
            background: white;
            width: 40px !important;
            height: 40px !important;
            border-radius: 50%;
            color: #135bec !important;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }
        .swiper-button-next:after, .swiper-button-prev:after {
            font-size: 16px !important;
            font-weight: bold;
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
        <main class="flex-grow">
            <section>
                <div class="container mx-auto px-4 py-10 md:py-20">
                    <div class="@container">
                        <div class="@[480px]:p-4">
                            <div class="flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat @[480px]:gap-8 @[480px]:rounded-xl items-center justify-center p-4 text-center shadow-2xl" 
                                 style='background-image: linear-gradient(rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.7) 100%), url("https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&q=80&w=1920");'>
                                <div class="flex flex-col gap-2">
                                    <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl">Jelajahi Pesona Tersembunyi Trenggalek</h1>
                                    <h2 class="text-white text-sm font-normal leading-normal @[480px]:text-base max-w-2xl mx-auto opacity-90">Temukan keindahan alam, kekayaan budaya, dan pengalaman tak terlupakan yang menanti Anda di setiap sudutnya.</h2>
                                </div>
                                
                                <form action="{{ route('destinasi.index') }}" method="GET" class="flex flex-col min-w-40 h-14 w-full max-w-[480px] @[480px]:h-16">
                                    <div class="flex w-full flex-1 items-stretch rounded-lg h-full shadow-lg">
                                        <div class="text-slate-500 flex bg-white items-center justify-center pl-[15px] rounded-l-lg border-r-0">
                                            <span class="material-symbols-outlined text-2xl">search</span>
                                        </div>
                                        <input name="search" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden text-slate-900 focus:outline-0 focus:ring-0 border-0 bg-white h-full placeholder:text-slate-500 px-[15px] border-l-0 text-sm font-normal leading-normal @[480px]:text-base" placeholder="Cari pantai, air terjun, atau kuliner..." value="{{ request('search') }}"/>
                                        <div class="flex items-center justify-center rounded-r-lg bg-white pr-[7px]">
                                            <button type="submit" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 @[480px]:h-12 @[480px]:px-5 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] @[480px]:text-base hover:bg-primary/90 transition-colors">
                                                <span class="truncate">Cari</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-10 md:py-16 overflow-hidden">
                <div class="container mx-auto px-4 relative">
                    <h2 class="text-slate-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-10 pt-5 text-center md:text-left">Destinasi Terpopuler di Trenggalek</h2>
                    
                    <div class="swiper mySwiper !px-4">
                        <div class="swiper-wrapper">
                       @forelse($wisata as $item)
    <div class="swiper-slide">
        <a href="{{ route('destinasi.show', $item->id) }}" class="flex flex-col gap-3 group cursor-pointer">
            <div class="w-full bg-center bg-no-repeat aspect-[3/4] bg-cover rounded-xl overflow-hidden transform group-hover:scale-105 transition-transform duration-500 shadow-md" 
                 style="background-image: url('{{ $item->gambar }}');">
            </div>
            
            <div>
                <p class="text-slate-900 dark:text-white text-base font-bold leading-normal truncate">
                    {{ $item->nama }}
                </p>
                <p class="text-slate-600 dark:text-slate-400 text-sm font-normal leading-normal">
                    {{ $item->kategori }} • {{ $item->kecamatan }}
                </p>
            </div>
        </a>
    </div>
@empty
    <div class="swiper-slide text-center py-10">
        <p class="text-slate-500 italic">Data destinasi belum tersedia.</p>
    </div>
@endforelse     </div>
                        
                        
                    </div>
                </div>
            </section>

            <section class="py-10 md:py-20 bg-white dark:bg-slate-900">
                <div class="container mx-auto px-4">
                    <div class="@container text-center px-4 py-10 @[480px]:px-10 @[480px]:py-20 flex flex-col items-center">
                        <div class="flex flex-col gap-2 mb-8">
                            <h1 class="text-slate-900 dark:text-white tracking-tight text-[32px] font-bold leading-tight @[480px]:text-4xl @[480px]:font-black max-w-2xl">Bingung Mau ke Mana? Kami Bantu!</h1>
                            <p class="text-slate-600 dark:text-slate-300 text-base font-normal leading-normal max-w-2xl">Dapatkan rekomendasi destinasi wisata yang paling sesuai dengan preferensi Anda menggunakan teknologi <strong>Particle Swarm Optimization (PSO)</strong> kami.</p>
                        </div>
                        <div class="flex justify-center">
                            <a href="{{ route('rekomendasi.pso') }}" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-14 px-8 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-all shadow-xl shadow-primary/30 hover:scale-105">
                                <span class="truncate flex items-center gap-2">
                                    <span class="material-symbols-outlined">bolt</span>
                                    Dapatkan Rekomendasi Personal Anda
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
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

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 1.2, // Tampilan mobile (sedikit terpotong agar tahu bisa di-swipe)
                spaceBetween: 20,
                centeredSlides: false,
                loop: true,
                autoplay: {
                    delay: 3500,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2.2,
                    },
                    768: {
                        slidesPerView: 3,
                    },
                    1024: {
                        slidesPerView: 4,
                    },
                    1280: {
                        slidesPerView: 5,
                    },
                },
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