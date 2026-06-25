<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $destinasi->nama }} - Wisata Trenggalek</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;700;900&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        background: "#f9f9ff",
                        "primary": "#135bec",
                        secondary: "#475e8c",
                        "surface-container-low": "#f2f3fd",
                        "surface-container-high": "#e6e8f2",
                        "on-surface-variant": "#414754",
                        surface: "#f9f9ff"
                    },
                    borderRadius: {
                        xxl: "1.5rem",
                        full: "9999px"
                    },
                    fontFamily: {
                        headline: ["Public Sans"],
                        body: ["Inter"],
                        label: ["Inter"]
                    }
                }
            }
        };
    </script>
    <style>
        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined' !important;
            font-weight: normal;
            font-style: normal;
            font-size: 24px;
            line-height: 1;
            display: inline-block;
            white-space: nowrap;
            -webkit-font-smoothing: antialiased;
        }
        .ambient-shadow { box-shadow: 0 12px 40px rgba(25, 28, 24, 0.06); }
        .primary-gradient { background: linear-gradient(135deg, #2f6287 0%, #475e8c 100%); }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .glass-nav { background: rgba(255, 255, 255, 0.75); backdrop-filter: blur(12px); }
    </style>
</head>
<body class="bg-surface font-body text-slate-900">

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

<main>
    <section class="relative h-[700px] w-full overflow-hidden bg-slate-900">
        <img class="w-full h-full object-cover opacity-80" src="{{ asset($destinasi->gambar) }}" alt="{{ $destinasi->nama }}"/>
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full p-12 lg:p-24 flex flex-col items-start gap-4">
            <div class="flex items-center gap-2 bg-white/20 backdrop-blur-md px-4 py-2 rounded-full border border-white/30">
                <span class="material-symbols-outlined text-yellow-400" style="font-variation-settings: 'FILL' 1;">star</span>
                <span class="text-white font-bold tracking-widest text-sm uppercase">{{ number_format($destinasi->rating, 1) }} • Top Destination</span>
            </div>
            <h1 class="font-headline text-6xl md:text-8xl font-black text-white tracking-tighter leading-tight max-w-4xl">
                {{ $destinasi->nama }}
            </h1>
            <div class="flex items-center gap-3 text-white/90">
                <span class="material-symbols-outlined">location_on</span>
                <span class="font-label tracking-wide">{{ $destinasi->kecamatan }}, Trenggalek, East Java</span>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-8 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            
            <div class="lg:col-span-8 space-y-16">
                <div class="space-y-6">
                    <h2 class="font-headline text-4xl font-bold tracking-tight text-primary">The Experience</h2>
                    <p class="text-lg leading-relaxed text-on-surface-variant font-body">
                        {{ $destinasi->deskripsi }}
                    </p>
                </div>

                <div class="space-y-8">
                    <h2 class="font-headline text-3xl font-bold tracking-tight text-primary">Amenities</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach(array_filter(explode(',', $destinasi->fasilitas)) as $item)
                        <div class="bg-surface-container-high p-6 rounded-xl flex flex-col gap-4 border border-blue-50 hover:bg-white transition-all cursor-default shadow-sm">
                            <span class="material-symbols-outlined text-primary text-3xl">
                                @php $f = strtolower(trim($item)); @endphp
                                @if(Str::contains($f, ['makan', 'kuliner', 'warung', 'cafe'])) restaurant 
                                @elseif(Str::contains($f, ['parkir', 'luas'])) local_parking
                                @elseif(Str::contains($f, ['mushola', 'masjid', 'ibadah'])) mosque
                                @elseif(Str::contains($f, ['toilet', 'mandi', 'wc'])) shower
                                @elseif(Str::contains($f, ['foto', 'spot'])) photo_camera
                                @elseif(Str::contains($f, ['camp', 'tenda'])) camping
                                @elseif(Str::contains($f, ['sunrise', 'matahari'])) light_mode
                                @elseif(Str::contains($f, ['adat', 'budaya', 'upacara', 'festival'])) festival
                                @else check_circle @endif
                            </span>
                            <span class="font-label font-semibold text-on-surface">{{ trim($item) }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="space-y-10">
                    <div class="flex items-center justify-between">
                        <h2 class="font-headline text-3xl font-bold tracking-tight text-primary">Guest Reviews</h2>
                        <a href="#review-form" class="text-primary font-bold border-b-2 border-primary transition-all hover:opacity-70">Write a Review</a>
                    </div>
                    
                    <div class="space-y-8">
                        @forelse($destinasi->reviews as $review)
                        <div class="bg-surface-container-low p-8 rounded-xxl space-y-4 border border-blue-50">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-primary font-bold">
                                        {{ strtoupper(substr($review->user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="font-bold">{{ $review->user->name }}</div>
                                        <div class="text-sm text-on-surface-variant">{{ $review->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <div class="flex text-yellow-500">
                                    @for($i=0; $i < $review->rating; $i++) 
                                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span> 
                                    @endfor
                                </div>
                            </div>
                            <p class="italic text-on-surface-variant font-body leading-relaxed">
                                "{{ $review->comment }}"
                            </p>
                        </div>
                        @empty
                        <p class="text-on-surface-variant italic">Belum ada review untuk destinasi ini. Jadilah yang pertama!</p>
                        @endforelse
                    </div>

                    <div id="review-form" class="bg-white p-8 rounded-xxl ambient-shadow border border-outline-variant/10">
                        <h3 class="font-headline text-xl font-bold mb-6">Share Your Story</h3>
                        
                        @auth
                            <form action="{{ route('review.store') }}" method="POST" class="space-y-6">
                                @csrf
                                <input type="hidden" name="wisata_id" value="{{ $destinasi->id }}">
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-sm font-label font-bold text-on-surface-variant uppercase tracking-wider">Your Rating</label>
                                        <select name="rating" class="w-full bg-surface border-gray-100 rounded-xl p-4 focus:ring-2 focus:ring-primary outline-none transition-all">
                                            <option value="5">⭐⭐⭐⭐⭐ - Excelent</option>
                                            <option value="4">⭐⭐⭐⭐ - Good</option>
                                            <option value="3">⭐⭐⭐ - Average</option>
                                            <option value="2">⭐⭐ - Poor</option>
                                            <option value="1">⭐ - Very Poor</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 text-right self-end">
                                        <p class="text-xs text-zinc-500 italic">Logged in as: {{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-label font-bold text-on-surface-variant uppercase tracking-wider">Experience</label>
                                    <textarea name="comment" class="w-full bg-surface border-gray-100 rounded-xl p-4 focus:ring-2 focus:ring-primary outline-none transition-all" placeholder="How was your visit to {{ $destinasi->nama }}?" rows="4" required></textarea>
                                </div>
                                <button class="text-white px-10 py-4 rounded-full font-bold font-label hover:opacity-90 transition-all bg-primary shadow-lg" type="submit">Submit Review</button>
                            </form>
                        @else
                            <div class="text-center py-10 bg-slate-50 rounded-xl border border-dashed border-slate-300">
                                <p class="mb-4 text-on-surface-variant">Kamu harus login untuk menulis review</p>
                                <a href="{{ route('login') }}" class="bg-primary text-white px-8 py-3 rounded-full font-bold hover:bg-blue-700 transition-all">Login Sekarang</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="bg-white p-8 rounded-xxl ambient-shadow sticky top-28 border border-gray-50">
                    <h3 class="font-headline text-2xl font-bold mb-8 text-primary">Practical Info</h3>
                    <div class="space-y-8">
                        <div class="flex items-start gap-4">
                            @if($destinasi->kategori == 'Budaya')
                                <span class="material-symbols-outlined text-secondary">calendar_month</span>
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-1">Event Date</p>
                                    <p class="font-semibold text-slate-800">{{ $destinasi->tanggal_pelaksanaan ?? 'Menunggu Jadwal' }}</p>
                                    <p class="text-xs text-zinc-500">Berdasarkan kalender adat</p>
                                </div>
                            @else
                                <span class="material-symbols-outlined text-secondary">schedule</span>
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-1">Opening Hours</p>
                                    <p class="font-semibold text-slate-800">{{ $destinasi->jam_buka && $destinasi->jam_tutup ? $destinasi->jam_buka . ' - ' . $destinasi->jam_tutup : 'Buka 24 Jam' }}</p>
                                    <p class="text-xs text-zinc-500">Best time: 05:30 - 17:30</p>
                                </div>
                            @endif
                        </div>
                        <div class="flex items-start gap-4">
                            <span class="material-symbols-outlined text-secondary">payments</span>
                            <div>
                                <p class="text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-1">Entrance Fee</p>
                                <p class="font-semibold text-primary text-xl">Rp {{ number_format($destinasi->harga_tiket, 0, ',', '.') }}</p>
                                <p class="text-xs text-zinc-500">Per person (subject to change)</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <span class="material-symbols-outlined text-secondary">call</span>
                            <div>
                                <p class="text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-1">Contact Center</p>
                                <p class="font-semibold text-slate-800">-</p>
                                <p class="text-xs text-zinc-500">Official Inquiry</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 space-y-4">
                        <p class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">Location Mapping</p>
                        <div class="relative w-full h-64 rounded-xxl overflow-hidden border border-gray-100 bg-slate-100">
                            <iframe 
                                width="100%" 
                                height="100%" 
                                frameborder="0" 
                                style="border:0"
                                src="https://maps.google.com/maps?q={{ $destinasi->latitude }},{{ $destinasi->longitude }}&hl=id&z=15&output=embed"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                    
                    <a href="https://www.google.com/maps/dir/?api=1&destination={{ $destinasi->latitude }},{{ $destinasi->longitude }}" 
                       target="_blank" 
                       class="w-full mt-10 primary-gradient text-white py-4 rounded-full font-bold flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all">
                        <span class="material-symbols-outlined">directions</span>
                        Get Directions
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-surface-container-low py-24">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex items-end justify-between mb-12">
                <div class="space-y-4">
                    <span class="text-secondary font-bold uppercase tracking-[0.2em] text-sm">Nearby Treasures</span>
                    <h2 class="font-headline text-4xl font-bold tracking-tight text-primary">Discover More Nearby</h2>
                </div>
            </div>
            
            <div class="flex overflow-x-auto gap-8 pb-8 hide-scrollbar">
              @foreach($destinasiLain as $lain)
<a href="{{ route('destinasi.show', $lain->id) }}" class="min-w-[320px] md:min-w-[400px] group cursor-pointer block">
    <div class="h-64 rounded-3xl overflow-hidden mb-6 shadow-sm relative">
        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
             src="{{ Str::startsWith($lain->gambar, ['http', 'https']) ? $lain->gambar : asset($lain->gambar) }}" 
             alt="{{ $lain->nama }}"
             onerror="this.src='https://placehold.co/600x400?text=Wisata+Trenggalek'"/>
        
        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-primary shadow-sm">
            {{ number_format($lain->rating, 1) }} ★
        </div>
    </div>
    
    <h4 class="font-headline text-xl font-bold group-hover:text-primary transition-colors">{{ $lain->nama }}</h4>
    <p class="text-gray-500 font-label text-sm flex items-center gap-1 mt-2">
        <span class="material-symbols-outlined text-[18px]">location_on</span>
        {{ $lain->kecamatan }}, Trenggalek
    </p>
</a>
@endforeach
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