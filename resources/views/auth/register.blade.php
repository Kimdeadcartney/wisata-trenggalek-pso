<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign Up | Trenggalek Tourism Portal</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container-low": "#f2f3fd",
                        "error": "#ba1a1a",
                        "surface-dim": "#d8d9e3",
                        "primary": "#2f6287",
                        "error-container": "#ffdad6",
                        "secondary-container": "#b2c9fe",
                        "on-tertiary-fixed": "#341100",
                        "on-secondary": "#ffffff",
                        "on-tertiary": "#ffffff",
                        "on-surface-variant": "#414754",
                        "surface-tint": "#2f6388",
                        "primary-fixed": "#cbe6ff",
                        "inverse-on-surface": "#eff0fa",
                        "surface-container-lowest": "#ffffff",
                        "on-surface": "#191c23",
                        "on-primary-fixed": "#001e30",
                        "surface-container-highest": "#e0e2ec",
                        "secondary-fixed-dim": "#afc7fb",
                        "on-error-container": "#93000a",
                        "surface-bright": "#f9f9ff",
                        "on-secondary-fixed": "#001a41",
                        "tertiary": "#9e4300",
                        "primary-fixed-dim": "#9bccf6",
                        "on-primary-fixed-variant": "#0e4b6e",
                        "inverse-surface": "#2d3038",
                        "tertiary-fixed": "#ffdbcb",
                        "on-secondary-container": "#3d5481",
                        "on-primary-container": "#ffffff",
                        "outline": "#727785",
                        "on-primary": "#ffffff",
                        "tertiary-fixed-dim": "#ffb691",
                        "surface-variant": "#e0e2ec",
                        "on-background": "#191c23",
                        "tertiary-container": "#c55500",
                        "on-tertiary-fixed-variant": "#783100",
                        "primary-container": "#4a7ba2",
                        "surface": "#f9f9ff",
                        "on-error": "#ffffff",
                        "surface-container-high": "#e6e8f2",
                        "on-secondary-fixed-variant": "#2e4673",
                        "on-tertiary-container": "#0e0200",
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
        .glass-header {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface selection:bg-primary-fixed selection:text-on-primary-fixed">

<header class="sticky top-0 w-full flex justify-between items-center px-12 py-4 z-50 bg-white/70 backdrop-blur-xl shadow-sm">
    <div class="text-2xl font-bold tracking-tighter text-sky-900">Trenggalek</div>
    <nav class="hidden md:flex items-center gap-8">
        <a class="font-['Public_Sans'] font-semibold tracking-tight text-slate-600 hover:text-sky-800 transition-colors" href="{{ route('home') }}">Destinations</a>
        <a class="font-['Public_Sans'] font-semibold tracking-tight text-slate-600 hover:text-sky-800 transition-colors" href="{{ route('rekomendasi.pso') }}">Experiences</a>
        <a class="font-['Public_Sans'] font-semibold tracking-tight text-slate-600 hover:text-sky-800 transition-colors" href="#">Culture</a>
        <a class="font-['Public_Sans'] font-semibold tracking-tight text-slate-600 hover:text-sky-800 transition-colors" href="#">Plan</a>
    </nav>
    <div class="flex items-center gap-4">
        <a href="{{ route('login') }}" class="px-6 py-2 rounded-lg bg-primary text-on-primary font-semibold hover:bg-primary-container transition-all duration-300 text-center">Sign In</a>
    </div>
</header>

<main class="min-h-[calc(100vh-80px)] flex flex-col md:flex-row">
    <section class="relative w-full md:w-1/2 min-h-[400px] md:min-h-0 flex items-end overflow-hidden">
        <img alt="Trenggalek Landscape" class="absolute inset-0 w-full h-full object-cover" src="https://images.unsplash.com/photo-1596401057633-53105143e627?q=80&w=2070&auto=format&fit=crop"/>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent"></div>
        <div class="relative z-10 p-12 md:p-20 max-w-xl">
            <h1 class="font-display font-black text-4xl md:text-5xl lg:text-6xl text-white leading-tight tracking-tighter mb-6">
                Join our journey to discover the hidden gems of Trenggalek.
            </h1>
            <div class="h-1 w-24 bg-tertiary-fixed-dim rounded-full"></div>
        </div>
    </section>

    <section class="w-full md:w-1/2 flex items-center justify-center bg-surface-container-low p-8 md:p-16 lg:p-24">
        <div class="w-full max-w-md bg-surface-container-lowest p-10 md:p-12 rounded-xl shadow-sm border border-outline-variant/10">
            <div class="mb-10">
                <h2 class="font-display font-bold text-3xl text-on-surface tracking-tight mb-2">Create Your Account</h2>
                <p class="text-on-surface-variant text-sm">Experience the elite hospitality of the Digital Concierge.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-on-surface-variant tracking-wide" for="name">Full Name</label>
                    <input class="w-full px-4 py-3 rounded-lg bg-surface-container-high border-none focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all placeholder:text-outline" 
                           id="name" name="name" value="{{ old('name') }}" placeholder="John Doe" type="text" required autofocus />
                    @error('name')
                        <p class="text-error text-xs font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-bold text-on-surface-variant tracking-wide" for="email">Email Address</label>
                    <input class="w-full px-4 py-3 rounded-lg bg-surface-container-high border-none focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all placeholder:text-outline" 
                           id="email" name="email" value="{{ old('email') }}" placeholder="john@example.com" type="email" required />
                    @error('email')
                        <p class="text-error text-xs font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-bold text-on-surface-variant tracking-wide" for="password">Password</label>
                    <div class="relative">
                        <input class="w-full px-4 py-3 rounded-lg bg-surface-container-high border-none focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all placeholder:text-outline" 
                               id="password" name="password" placeholder="••••••••" type="password" required />
                        <button class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-primary" type="button" onclick="togglePassword()">
                            <span class="material-symbols-outlined text-xl" id="pw_icon">visibility</span>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-error text-xs font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-bold text-on-surface-variant tracking-wide" for="password_confirmation">Confirm Password</label>
                    <input class="w-full px-4 py-3 rounded-lg bg-surface-container-high border-none focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all placeholder:text-outline" 
                           id="password_confirmation" name="password_confirmation" placeholder="••••••••" type="password" required />
                </div>

                <div class="pt-2">
                    <button class="w-full py-4 bg-primary text-on-primary font-bold rounded-lg shadow-md hover:bg-primary-container hover:shadow-lg transition-all duration-300" type="submit">
                        Create Account
                    </button>
                </div>

                <div class="relative flex items-center py-2">
                    <div class="flex-grow border-t border-outline-variant/30"></div>
                    <span class="flex-shrink mx-4 text-xs font-bold text-outline tracking-widest uppercase">Or</span>
                    <div class="flex-grow border-t border-outline-variant/30"></div>
                </div>

                <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center gap-3 py-3 border border-outline-variant/50 rounded-lg font-semibold text-on-surface-variant hover:bg-surface-container hover:border-outline transition-all">
                    <svg class="w-5 h-5" viewbox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"></path>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
                    </svg>
                    Sign up with Google
                </a>
            </form>

            <div class="mt-8 text-center">
                <p class="text-on-surface-variant text-sm">
                    Already have an account? 
                    <a class="text-primary font-bold hover:underline underline-offset-4 ml-1" href="{{ route('login') }}">Log In</a>
                </p>
            </div>
        </div>
    </section>
</main>

<footer class="w-full py-12 px-12 flex flex-col md:flex-row justify-between items-center gap-6 bg-slate-50 border-t border-surface-container">
    <div class="flex flex-col gap-2 items-center md:items-start">
        <div class="text-lg font-black text-sky-900">Trenggalek</div>
        <p class="font-['Inter'] text-sm tracking-wide text-slate-500">© 2026 Trenggalek Tourism Authority. All rights reserved.</p>
    </div>
    <nav class="flex flex-wrap justify-center gap-6">
        <a class="font-['Inter'] text-sm tracking-wide text-slate-500 hover:text-sky-600 underline underline-offset-4 opacity-80 hover:opacity-100 transition-opacity" href="#">Privacy Policy</a>
        <a class="font-['Inter'] text-sm tracking-wide text-slate-500 hover:text-sky-600 underline underline-offset-4 opacity-80 hover:opacity-100 transition-opacity" href="#">Terms of Service</a>
        <a class="font-['Inter'] text-sm tracking-wide text-slate-500 hover:text-sky-600 underline underline-offset-4 opacity-80 hover:opacity-100 transition-opacity" href="#">Accessibility</a>
        <a class="font-['Inter'] text-sm tracking-wide text-slate-500 hover:text-sky-600 underline underline-offset-4 opacity-80 hover:opacity-100 transition-opacity" href="#">Contact Us</a>
    </nav>
</footer>

<script>
    function togglePassword() {
        const pwInput = document.getElementById('password');
        const icon = document.getElementById('pw_icon');
        if (pwInput.type === 'password') {
            pwInput.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            pwInput.type = 'password';
            icon.textContent = 'visibility';
        }
    }
</script>

</body>
</html>