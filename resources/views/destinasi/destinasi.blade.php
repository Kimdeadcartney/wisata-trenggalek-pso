<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Destinasi Wisata Trenggalek</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
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
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="font-display bg-background-light dark:bg-background-dark">
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

    <main class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-wrap justify-between gap-4 mb-8">
            <div class="flex flex-col gap-2">
                <h1 class="text-gray-900 dark:text-white text-4xl font-black tracking-[-0.033em]">Jelajahi Destinasi Wisata di Trenggalek</h1>
                <p class="text-gray-500 dark:text-gray-400 text-base font-normal">Temukan pesona alam dan budaya yang menanti Anda di setiap sudut Trenggalek.</p>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <aside class="w-full lg:w-1/4 xl:w-1/5 space-y-6">
                <form action="{{ route('destinasi.index') }}" method="GET">
                    <div class="bg-white dark:bg-gray-900/50 p-4 rounded-xl border border-gray-200 dark:border-gray-800 mb-6">
                        <label class="flex flex-col w-full">
                            <div class="flex w-full flex-1 items-stretch rounded-lg h-12">
                                <div class="text-gray-500 dark:text-gray-400 flex bg-background-light dark:bg-background-dark items-center justify-center pl-4 rounded-l-lg">
                                    <span class="material-symbols-outlined">search</span>
                                </div>
                                <input name="search" value="{{ request('search') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-r-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-none bg-background-light dark:bg-background-dark h-full placeholder:text-gray-500 dark:placeholder:text-gray-400 px-4 pl-2 text-sm" placeholder="Cari nama destinasi..."/>
                            </div>
                        </label>
                    </div>

                    <div class="bg-white dark:bg-gray-900/50 p-4 rounded-xl border border-gray-200 dark:border-gray-800">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 px-2">Filter</h3>
                        <div class="flex flex-col">
                            <details class="flex flex-col border-t border-gray-200 dark:border-gray-800 py-2 group" open="">
                                <summary class="flex cursor-pointer list-none items-center justify-between gap-6 py-2">
                                    <p class="text-gray-800 dark:text-gray-200 text-sm font-medium">Kategori Wisata</p>
                                    <span class="material-symbols-outlined text-gray-600 dark:text-gray-400 group-open:rotate-180 transition-transform duration-200">expand_more</span>
                                </summary>
                                <div class="px-2 pt-2">
                                    @foreach(['Pantai', 'Air Terjun', 'Goa', 'Budaya', 'Kuliner', 'Hotel'] as $kat)
    <label class="flex items-center gap-x-3 py-1.5">
        <input name="kategori[]" value="{{ $kat }}" {{ in_array($kat, (array)request('kategori')) ? 'checked' : '' }} class="h-5 w-5 rounded border-gray-300 dark:border-gray-600 bg-transparent text-primary focus:ring-2 focus:ring-primary/50" type="checkbox"/>
        <p class="text-gray-600 dark:text-gray-300 text-sm">{{ $kat }}</p>
    </label>
@endforeach
                                </div>
                            </details>

                            <details class="flex flex-col border-t border-gray-200 dark:border-gray-800 py-2 group">
                                <summary class="flex cursor-pointer list-none items-center justify-between gap-6 py-2">
                                    <p class="text-gray-800 dark:text-gray-200 text-sm font-medium">Lokasi (Kecamatan)</p>
                                    <span class="material-symbols-outlined text-gray-600 dark:text-gray-400 group-open:rotate-180 transition-transform duration-200">expand_more</span>
                                </summary>
                                <div class="px-2 pt-2">
                                    @foreach(['Watulimo', 'Panggul', 'Bendungan', 'Munjungan', 'Tugu'] as $kec)
                                    <label class="flex items-center gap-x-3 py-1.5">
                                        <input name="kecamatan[]" value="{{ $kec }}" {{ in_array($kec, (array)request('kecamatan')) ? 'checked' : '' }} class="h-5 w-5 rounded border-gray-300 dark:border-gray-600 bg-transparent text-primary focus:ring-2 focus:ring-primary/50" type="checkbox"/>
                                        <p class="text-gray-600 dark:text-gray-300 text-sm">{{ $kec }}</p>
                                    </label>
                                    @endforeach
                                </div>
                            </details>
                        </div>
                        <div class="flex gap-2 mt-4 pt-4 border-t border-gray-200 dark:border-gray-800">
                            <button type="submit" class="flex-1 text-sm font-bold text-white bg-primary rounded-lg h-10 flex items-center justify-center">Terapkan</button>
                            <a href="{{ route('destinasi.index') }}" class="flex-1 text-sm font-bold text-gray-700 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 rounded-lg h-10 flex items-center justify-center text-center">Reset</a>
                        </div>
                    </div>
                </form>
            </aside>

            <div class="flex-1">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <p class="text-gray-600 dark:text-gray-300 text-sm">
                        Menampilkan <strong>{{ $wisata->count() }}</strong> dari <strong>{{ $wisata->total() }}</strong> destinasi
                    </p>
                    <div class="relative w-full sm:w-auto">
                        <form action="{{ route('destinasi.index') }}" method="GET" id="sortForm">
                            {{-- Tetap simpan filter saat sorting --}}
                            @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                            @foreach((array)request('kategori') as $k) <input type="hidden" name="kategori[]" value="{{ $k }}"> @endforeach
                            
                            <select name="sort" onchange="this.form.submit()" class="form-select w-full appearance-none pl-3 pr-8 py-2 text-sm text-gray-800 dark:text-gray-200 bg-white dark:bg-gray-900/50 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-primary/50 focus:border-primary">
                                <option value="popularitas" {{ request('sort') == 'popularitas' ? 'selected' : '' }}>Urutkan: Popularitas</option>
                                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Urutkan: Rating Tertinggi</option>
                                <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>Urutkan: Abjad A-Z</option>
                                <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Urutkan: Abjad Z-A</option>
                            </select>
                        </form>
                        <span class="material-symbols-outlined text-gray-500 dark:text-gray-400 absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none">unfold_more</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @forelse($wisata as $item)
                    <div class="flex flex-col bg-white dark:bg-gray-900/50 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden group transition-shadow hover:shadow-lg">
                        <div class="relative">
                            <img class="h-48 w-full object-cover transition-transform duration-300 group-hover:scale-105" 
                                 src="{{ $item->gambar ?? 'https://via.placeholder.com/400x300?text=No+Image' }}" 
                                 alt="{{ $item->nama }}"/>
                            <div class="absolute top-3 right-3 bg-white/90 dark:bg-gray-900/90 px-2 py-1 rounded-md shadow-sm">
                                <p class="text-[10px] font-bold text-primary uppercase">{{ $item->kategori }}</p>
                            </div>
                        </div>
                        <div class="p-4 flex flex-col flex-grow">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">{{ $item->nama }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Kecamatan {{ $item->kecamatan }}</p>
                            
                            <div class="flex items-center gap-1 text-sm text-gray-700 dark:text-gray-300 mb-4">
                               <span class="text-yellow-400">★</span>
    <span class="ml-1">{{ number_format($item->rating, 1) }}</span>
    <span class="ml-1">({{ $item->reviews_count }} reviews)</span>
                            </div>

                            <a href="{{ route('destinasi.show', $item->id) }}" class="mt-auto w-full text-center rounded-lg px-4 py-2 text-sm font-bold bg-primary/10 dark:bg-primary/20 text-primary dark:text-primary hover:bg-primary/20 dark:hover:bg-primary/30 transition-colors">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-20 text-center">
                        <span class="material-symbols-outlined text-gray-300 text-6xl mb-4">search_off</span>
                        <p class="text-gray-500 dark:text-gray-400">Tidak ada destinasi yang cocok dengan kriteria Anda.</p>
                    </div>
                    @endforelse
                </div>

                <div class="mt-10 pt-6 border-t border-gray-200 dark:border-gray-800">
                    {{ $wisata->appends(request()->query())->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>                                         