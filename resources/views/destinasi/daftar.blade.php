<!DOCTYPE html>

<html lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Wisata Trenggalek - Jelajahi Pesona Tersembunyi</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
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
      font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24
    }
  </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-800 dark:text-slate-200">
<div class="relative flex min-h-screen w-full flex-col group/design-root overflow-x-hidden">
<!-- TopNavBar -->
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
<main class="flex-grow">
<!-- HeroSection -->
<section>
<div class="container mx-auto px-4 py-10 md:py-20">
<div class="@container">
<div class="@[480px]:p-4">
<div class="flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat @[480px]:gap-8 @[480px]:rounded-xl items-center justify-center p-4 text-center" data-alt="A captivating landscape view of a beach in Trenggalek at sunset" style='background-image: linear-gradient(rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.5) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuDQ0eEgEYHO02JN5ib6K7GTJX9SeiLHDKVi88B9oO3w4PoUFCaDYXjM9wRjfvBcc0GFYG43HXAtXFgDSfwHuqv_ZFKKuuK0okeJvjnrPiVB2ME5Btmdsn6fnXHSHoq6sY-8oemiEB8hcyEhL4IDj5jRCIibz4UbPRhL9nW27CGmLShSSuQGeLFNzDJz7nmv8yk8vOzbXhpY0A_-vXspcgVVRj1vE0hZhsYyFxzs4JZ-PwDKdJQTiqx2gSPjAK9A7W-OOc7BNKujVg");'>
<div class="flex flex-col gap-2">
<h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl">Jelajahi Pesona Tersembunyi Trenggalek</h1>
<h2 class="text-white text-sm font-normal leading-normal @[480px]:text-base max-w-2xl mx-auto">Temukan keindahan alam, kekayaan budaya, dan pengalaman tak terlupakan yang menanti Anda di setiap sudutnya.</h2>
</div>
<label class="flex flex-col min-w-40 h-14 w-full max-w-[480px] @[480px]:h-16">
<div class="flex w-full flex-1 items-stretch rounded-lg h-full shadow-lg">
<div class="text-slate-500 flex bg-white items-center justify-center pl-[15px] rounded-l-lg border-r-0">
<span class="material-symbols-outlined">search</span>
</div>
<input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden text-slate-900 focus:outline-0 focus:ring-0 border-0 bg-white h-full placeholder:text-slate-500 px-[15px] border-l-0 text-sm font-normal leading-normal @[480px]:text-base" placeholder="Cari pantai, air terjun, atau kuliner..." value=""/>
<div class="flex items-center justify-center rounded-r-lg bg-white pr-[7px]">
<button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 @[480px]:h-12 @[480px]:px-5 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] @[480px]:text-base hover:bg-primary/90 transition-colors">
<span class="truncate">Cari</span>
</button>
</div>
</div>
</label>
</div>
</div>
</div>
</div>
</section>
<!-- Popular Destinations Section -->
<section class="py-10 md:py-16">
<div class="container mx-auto px-4">
<!-- SectionHeader -->
<h2 class="text-slate-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-5 pt-5 text-center md:text-left">Destinasi Terpopuler di Trenggalek</h2>
<!-- ImageGrid -->
<div class="grid grid-cols-[repeat(auto-fit,minmax(220px,1fr))] gap-6 p-4">
<div class="flex flex-col gap-3 group">
<div class="w-full bg-center bg-no-repeat aspect-[3/4] bg-cover rounded-xl overflow-hidden transform group-hover:scale-105 transition-transform duration-300" data-alt="Photo of Pantai Prigi beach with blue waters and sandy shores." style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAMK5NIbp3AWXvFAvSCdjU_0JN3rds7HHXimtqsn-r8AsHdS6o0qANcTYhhxwLJAEPca-l6PPjT8SKvd-ppu5sUujK1bvFmCXNSRExAKUhBNczmrKpgDuqFEtiSyuwNyKxg12oJYIXy_NQTUwf_TdzteAwy7c-kNJzz08fSpQR3ZTEARpwUjB9NKmy-0OHJHEs0NVM2J1ooprqzjRRGE1uqfpAoTW0fw63Zd9kaC1e2Glmvv4kGEM3r-OBOrFJxhHF4ltxGf2d2oA");'></div>
<div>
<p class="text-slate-900 dark:text-white text-base font-bold leading-normal">Pantai Prigi</p>
<p class="text-slate-600 dark:text-slate-400 text-sm font-normal leading-normal">Pantai</p>
</div>
</div>
<div class="flex flex-col gap-3 group">
<div class="w-full bg-center bg-no-repeat aspect-[3/4] bg-cover rounded-xl overflow-hidden transform group-hover:scale-105 transition-transform duration-300" data-alt="Entrance to the large and dark Goa Lowo cave." style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCYUOFjVEvRo33bDnB9r9a6jG_L6W1RU4RsgBrWJVrhxpqarEi6u0IUkiQE9csbj0Bpl-pXfyUvCXNr5KR_x7UZw5PvxxsPJ2JMoEN_nQoUNaRJuR-SkVPph7V_yi2lxDjUOVnTWFO64UEV0YubwWDBVDo2tqZ6XVqL3Oj89EBFtSMhmxvJ44OyXhsSYOsk9zbKn_4J0f4lNgd4b1ArHDam8l7AgsDePzcElMrHjW6EENKaeOvK3udRg3HzuBuf2v7xQ2HOp38weg");'></div>
<div>
<p class="text-slate-900 dark:text-white text-base font-bold leading-normal">Goa Lowo</p>
<p class="text-slate-600 dark:text-slate-400 text-sm font-normal leading-normal">Goa</p>
</div>
</div>
<div class="flex flex-col gap-3 group">
<div class="w-full bg-center bg-no-repeat aspect-[3/4] bg-cover rounded-xl overflow-hidden transform group-hover:scale-105 transition-transform duration-300" data-alt="View of Pantai Pasir Putih Karanggongso with its iconic white sand." style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDLcSVWzXm7WMXt0WJEs3WheEKwaIqrOGfmQqYMNLndntcxkAZTxsf4WhhBulylyX31J0c-549r_LqoRHayqc7ZELe8tSDo-FuDE1VJU4Il55uiKgERrJIuVB7-WK7d11EV-olzfLkxMRkrk7U9_NG6jN6neVlPFQfjI8XJwLrLaKbjt0-7qGRop_3TovpleQE43rtur2C4QavDud-XVzRxxCaitpCS612k5PPJ9lJy83JifDurU0ph5HAApSRJg-eabgjTSDT2Og");'></div>
<div>
<p class="text-slate-900 dark:text-white text-base font-bold leading-normal">Pantai Pasir Putih Karanggongso</p>
<p class="text-slate-600 dark:text-slate-400 text-sm font-normal leading-normal">Pantai</p>
</div>
</div>
<div class="flex flex-col gap-3 group">
<div class="w-full bg-center bg-no-repeat aspect-[3/4] bg-cover rounded-xl overflow-hidden transform group-hover:scale-105 transition-transform duration-300" data-alt="Wooden pathway through the lush Hutan Mangrove Pancer Cengkrong." style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDWhIajkjIKgBskgmAm1l5NaDh835EVfiQhd6hRqzyeV5GiW58kL7dmQq2z1LU7x0psoxh-CSgntGHxCtwgphca-LqETBRFWe7TzSdoFBV2BfWF0AAqySoDhBUOokhX4ToieqNMMS6MOxpGsveGstpoBox0PLwkT8HPyw6VIVXqtya_4olcmKJ-Ra0mkOVl98-kQU89pGJLdRaPD_fXWab9xs_KtCSkImT45Lg6miffHf7B5QUdw1arcSgFugEAsS0-qAia5Kx3Vg");'></div>
<div>
<p class="text-slate-900 dark:text-white text-base font-bold leading-normal">Hutan Mangrove Pancer Cengkrong</p>
<p class="text-slate-600 dark:text-slate-400 text-sm font-normal leading-normal">Wisata Alam</p>
</div>
</div>
</div>
</div>
</section>
<!-- CTASection -->
<section class="py-10 md:py-20 bg-white dark:bg-slate-900">
<div class="container mx-auto px-4">
<div class="@container">
<div class="flex flex-col justify-end gap-6 text-center px-4 py-10 @[480px]:gap-8 @[480px]:px-10 @[480px]:py-20 items-center">
<div class="flex flex-col gap-2">
<h1 class="text-slate-900 dark:text-white tracking-tight text-[32px] font-bold leading-tight @[480px]:text-4xl @[480px]:font-black @[480px]:leading-tight @[480px]:tracking-[-0.033em] max-w-2xl">Bingung Mau ke Mana? Kami Bantu!</h1>
<p class="text-slate-600 dark:text-slate-300 text-base font-normal leading-normal max-w-2xl">Dapatkan rekomendasi destinasi wisata yang paling sesuai dengan preferensi Anda menggunakan teknologi Particle Swarm Optimization kami.</p>
</div>
<div class="flex justify-center">
<button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-colors shadow-lg shadow-primary/30">
<span class="truncate">Dapatkan Rekomendasi Personal Anda</span>
</button>
</div>
</div>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-slate-900 text-white">
<div class="container mx-auto px-4 py-16">
<div class="grid grid-cols-1 md:grid-cols-4 gap-8">
<!-- About -->
<div class="col-span-1 md:col-span-2">
<div class="flex items-center gap-3 mb-4">
<div class="w-7 h-7 text-white">
<svg fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
<path d="M42.4379 44C42.4379 44 36.0744 33.9038 41.1692 24C46.8624 12.9336 42.2078 4 42.2078 4L7.01134 4C7.01134 4 11.6577 12.932 5.96912 23.9969C0.876273 33.9029 7.27094 44 7.27094 44L42.4379 44Z" fill="currentColor"></path>
</svg>
</div>
<h3 class="text-xl font-bold">Wisata Trenggalek</h3>
</div>
<p class="text-slate-400 text-sm">Portal informasi pariwisata resmi Kabupaten Trenggalek, membantu Anda menemukan pesona tersembunyi dengan rekomendasi cerdas.</p>
</div>
<!-- Links -->
<div>
<h4 class="font-bold mb-4">Tautan Cepat</h4>
<ul class="space-y-2">
<li><a class="text-slate-400 hover:text-white text-sm transition-colors" href="#">Destinasi</a></li>
<li><a class="text-slate-400 hover:text-white text-sm transition-colors" href="#">Event</a></li>
<li><a class="text-slate-400 hover:text-white text-sm transition-colors" href="#">Tentang Kami</a></li>
<li><a class="text-slate-400 hover:text-white text-sm transition-colors" href="#">Hubungi Kami</a></li>
</ul>
</div>
<!-- Contact -->
<div>
<h4 class="font-bold mb-4">Kontak</h4>
<ul class="space-y-2 text-slate-400 text-sm">
<li class="flex items-start gap-2">
<span class="material-symbols-outlined text-lg mt-0.5">location_on</span>
<span>Dinas Pariwisata Trenggalek, Jl. Soekarno Hatta No.1, Trenggalek, Jawa Timur</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-lg">mail</span>
<a class="hover:text-white transition-colors" href="mailto:info@trenggalektourism.go.id">info@trenggalektourism.go.id</a>
</li>
</ul>
</div>
</div>
<div class="border-t border-slate-800 mt-12 pt-8 text-center text-slate-500 text-sm">
<p>© 2024 Wisata Trenggalek. Hak Cipta Dilindungi.</p>
</div>
</div>
</footer>
</div>
</body></html>