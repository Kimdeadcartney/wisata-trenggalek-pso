<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    {{-- Tambahkan CSRF Token untuk keamanan Laravel --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Login - Azure Compass Trenggalek</title>

    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@600;700;800;900&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#2f6287",
                        "on-secondary-container": "#3d5481",
                        "on-primary": "#ffffff",
                        "error-container": "#ffdad6",
                        "error": "#ba1a1a",
                        "on-surface": "#191c23",
                        "inverse-surface": "#2d3038",
                        "background": "#f9f9ff",
                        "surface-container-high": "#e6e8f2",
                        "on-tertiary-fixed-variant": "#783100",
                        "tertiary-fixed": "#ffdbcb",
                        "tertiary-container": "#c55500",
                        "surface-tint": "#2f6388",
                        "on-primary-fixed-variant": "#0e4b6e",
                        "tertiary-fixed-dim": "#ffb691",
                        "surface-container-low": "#f2f3fd",
                        "surface-bright": "#f9f9ff",
                        "on-secondary-fixed": "#001a41",
                        "tertiary": "#9e4300",
                        "primary-fixed-dim": "#9bccf6",
                        "on-primary-fixed": "#001e30",
                        "on-primary-container": "#ffffff",
                        "on-background": "#191c23",
                        "on-tertiary": "#ffffff",
                        "primary-container": "#4a7ba2",
                        "outline-variant": "#c1c6d6",
                        "surface-container-lowest": "#ffffff",
                        "secondary-fixed-dim": "#afc7fb",
                        "on-error-container": "#93000a",
                        "surface-variant": "#e0e2ec",
                        "on-surface-variant": "#414754",
                        "on-secondary-fixed-variant": "#2e4673",
                        "secondary": "#475e8c",
                        "surface-container": "#ecedf7",
                        "outline": "#727785",
                        "inverse-on-surface": "#eff0fa",
                        "surface-dim": "#d8d9e3",
                        "secondary-container": "#b2c9fe",
                        "on-tertiary-container": "#0e0200",
                        "inverse-primary": "#9bccf6",
                        "surface-container-highest": "#e0e2ec",
                        "secondary-fixed": "#d8e2ff",
                        "on-secondary": "#ffffff",
                        "surface": "#f9f9ff",
                        "on-tertiary-fixed": "#341100",
                        "on-error": "#ffffff",
                        "primary-fixed": "#cbe6ff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Public Sans"],
                        "display": ["Public Sans"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .text-glass-shadow {
            text-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface min-h-screen flex flex-col">

<header class="bg-white/70 dark:bg-slate-900/70 backdrop-blur-md font-['Public_Sans'] font-semibold tracking-tight docked full-width top-0 sticky z-50">
    <div class="flex justify-between items-center w-full px-8 py-4 max-w-screen-2xl mx-auto">
        <div class="text-xl font-black text-sky-800 dark:text-sky-200">Azure Compass</div>
        <nav class="hidden md:flex items-center gap-8">
            <a class="text-slate-600 dark:text-slate-400 hover:text-sky-600 transition-colors" href="{{ url('/') }}">Explore</a>
            <a class="text-slate-600 dark:text-slate-400 hover:text-sky-600 transition-colors" href="#">Destinations</a>
            <a class="text-slate-600 dark:text-slate-400 hover:text-sky-600 transition-colors" href="#">Packages</a>
            <a class="text-slate-600 dark:text-slate-400 hover:text-sky-600 transition-colors" href="#">Culture</a>
        </nav>
        <a href="{{ route('login') }}" class="bg-primary text-on-primary px-6 py-2 rounded-lg scale-95 active:scale-90 transition-transform duration-200">Sign In</a>
    </div>
</header>

<main class="flex-grow flex flex-col md:flex-row min-h-[calc(100vh-160px)]">
    <section class="relative w-full md:w-1/2 min-h-[400px] md:min-h-full overflow-hidden">
        {{-- Menggunakan asset() untuk gambar lokal jika tersedia --}}
        <img alt="Trenggalek Landscape" class="absolute inset-0 w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDgNrT8aGi-5EtTlsYbEeHBe-QWlSuvnzu9QrG2vBCm_ccgFbhIjwtOpX0p1nvVMkDPpps70x45sJSC6GnPqRWJKFEs-rg4jySgpnR0QnTvWy5IoSIFnILbzi_GKLjptvaawTeCPwcyCvIpB8F3OzQmUjdrHm-gyJyPw30jQHSNR_xrhpreh9KhQpegIMyR65gsDNr6LmbOT2hVZlJHl2UYQZi6gQY31znBrISbVzzZ62xvmlqDrD_dJP5B3_gW6kf0Jc9imHRz7g"/>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent flex flex-col justify-end p-12 md:p-20">
            <h1 class="font-headline font-black text-5xl md:text-7xl text-white tracking-tight leading-none text-glass-shadow mb-4">
                Discover<br/>Trenggalek
            </h1>
            <p class="text-white/90 text-lg md:text-xl font-medium max-w-md text-glass-shadow">
                Experience the hidden jewel of East Java, where pristine beaches meet emerald hills.
            </p>
        </div>
    </section>

    <section class="w-full md:w-1/2 flex items-center justify-center p-8 md:p-16 bg-surface">
        <div class="w-full max-w-md flex flex-col gap-8">
            <div class="space-y-2">
                <h2 class="font-headline font-extrabold text-4xl text-primary tracking-tight">Welcome Back</h2>
                <p class="text-on-surface-variant font-medium">Please enter your details to access your itinerary.</p>
            </div>
            
            <div class="flex flex-col gap-4">
                {{-- Fitur Login Google --}}
                <a href="{{ url('auth/google') }}" class="w-full flex items-center justify-center gap-3 py-3 px-6 bg-surface-container-lowest border border-outline-variant/20 rounded-lg font-semibold text-on-surface hover:bg-surface-container-low transition-colors duration-200">
                    <svg class="w-5 h-5" viewbox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"></path>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
                    </svg>
                    Login with Google
                </a>

                <div class="relative flex items-center py-4">
                    <div class="flex-grow border-t border-outline-variant/30"></div>
                    <span class="flex-shrink mx-4 text-xs font-bold uppercase tracking-widest text-outline">Or use email</span>
                    <div class="flex-grow border-t border-outline-variant/30"></div>
                </div>

                {{-- Form Login Laravel --}}
                <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
                    @csrf {{-- Token keamanan wajib di Laravel --}}
                    
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-on-surface-variant px-1" for="email">Email Address</label>
                        <input class="w-full px-4 py-3 rounded-lg bg-surface-container-high border-none focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all duration-200" 
                               id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" type="email" required autofocus/>
                        @error('email')
                            <span class="text-error text-xs font-semibold px-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex justify-between items-center px-1">
                            <label class="text-sm font-bold text-on-surface-variant" for="password">Password</label>
                            @if (Route::has('password.request'))
                                <a class="text-xs font-semibold text-primary hover:underline" href="{{ route('password.request') }}">Forgot?</a>
                            @endif
                        </div>
                        <input class="w-full px-4 py-3 rounded-lg bg-surface-container-high border-none focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all duration-200" 
                               id="password" name="password" placeholder="••••••••" type="password" required/>
                        @error('password')
                            <span class="text-error text-xs font-semibold px-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="w-full py-4 bg-primary text-on-primary font-bold rounded-lg mt-2 shadow-lg shadow-primary/20 hover:bg-primary-container transition-all active:scale-[0.98]" type="submit">
                        Login
                    </button>
                </form>
            </div>

            <div class="text-center pt-4">
                <p class="text-on-surface-variant font-medium">
                    Don't have an account? 
                    <a class="text-primary font-bold hover:underline underline-offset-4 ml-1" href="{{ route('register') }}">Sign Up</a>
                </p>
            </div>
        </div>
    </section>
</main>

<footer class="bg-slate-50 dark:bg-slate-950 font-['Inter'] text-sm tracking-wide w-full py-12 px-8 flex flex-col md:flex-row justify-between items-center gap-6 mt-auto">
    <p class="text-slate-500 dark:text-slate-500">© 2026 Azure Compass Tourism. Crafted for the Digital Concierge.</p>
    <div class="flex gap-8">
        <a class="text-slate-500 dark:text-slate-500 hover:text-sky-600 dark:hover:text-sky-300 transition-colors underline-offset-4 hover:underline" href="#">Privacy Policy</a>
        <a class="text-slate-500 dark:text-slate-500 hover:text-sky-600 dark:hover:text-sky-300 transition-colors underline-offset-4 hover:underline" href="#">Terms of Service</a>
        <a class="text-slate-500 dark:text-slate-500 hover:text-sky-600 dark:hover:text-sky-300 transition-colors underline-offset-4 hover:underline" href="#">Local Guides</a>
        <a class="text-slate-500 dark:text-slate-500 hover:text-sky-600 dark:hover:text-sky-300 transition-colors underline-offset-4 hover:underline" href="#">Contact</a>
    </div>
</footer>

</body>
</html>