<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Memproses Rekomendasi PSO - Wisata Trenggalek</title>
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
        @keyframes particle-float {
            0%, 100% { transform: translate(0, 0); }
            25% { transform: translate(15px, -15px); }
            50% { transform: translate(-10px, 20px); }
            75% { transform: translate(-20px, -5px); }
        }
        .particle {
            animation: particle-float 4s infinite ease-in-out;
        }
        .swarm-container {
            perspective: 1000px;
        }
        .status-fade {
            animation: pulse-text 2s infinite ease-in-out;
        }
        @keyframes pulse-text {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
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
                },
            },
        }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-[#111318] dark:text-gray-200 overflow-hidden">
    <div class="relative flex h-screen w-full flex-col">
        <main class="flex-1 flex flex-col items-center justify-center p-6">
            
            {{-- Swarm Animation Container --}}
            <div class="relative w-full max-w-2xl h-64 mb-12 flex items-center justify-center swarm-container">
                <div class="absolute z-10 size-16 bg-primary/20 rounded-full flex items-center justify-center">
                    <div class="size-8 bg-primary rounded-full shadow-[0_0_30px_rgba(19,91,236,0.6)]"></div>
                </div>
                
                {{-- Particles --}}
                <div class="particle absolute size-3 bg-primary/60 rounded-full" style="top: 20%; left: 30%; animation-delay: 0.2s;"></div>
                <div class="particle absolute size-2 bg-primary/40 rounded-full" style="top: 10%; left: 70%; animation-delay: 0.5s;"></div>
                <div class="particle absolute size-4 bg-primary/50 rounded-full" style="top: 80%; left: 20%; animation-delay: 0.8s;"></div>
                <div class="particle absolute size-2 bg-primary/70 rounded-full" style="top: 70%; left: 80%; animation-delay: 1.1s;"></div>
                <div class="particle absolute size-3 bg-primary/30 rounded-full" style="top: 40%; left: 15%; animation-delay: 1.4s;"></div>
                <div class="particle absolute size-2 bg-primary/60 rounded-full" style="top: 55%; left: 85%; animation-delay: 1.7s;"></div>
                <div class="particle absolute size-4 bg-primary/40 rounded-full" style="top: 15%; left: 45%; animation-delay: 2.0s;"></div>
                <div class="particle absolute size-3 bg-primary/50 rounded-full" style="top: 85%; left: 60%; animation-delay: 2.3s;"></div>
                
                <svg class="absolute inset-0 w-full h-full opacity-10 pointer-events-none" viewBox="0 0 400 200">
                    <path class="text-primary" d="M100,50 L200,100 M300,30 L200,100 M50,150 L200,100 M350,170 L200,100" fill="none" stroke="currentColor" stroke-width="1"></path>
                </svg>
            </div>

            <div class="text-center max-w-md space-y-6">
                <div class="space-y-2">
                    <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-[#111318] dark:text-white">
                        Menyusun Rekomendasi Cerdas
                    </h1>
                    <p class="text-gray-500 dark:text-gray-400 font-medium">
                        Menggunakan Algoritma Particle Swarm Optimization (PSO)
                    </p>
                </div>

                <div class="space-y-4 pt-4">
                    {{-- Step 1 --}}
                    <div id="step-1" class="flex items-center gap-4 text-left p-4 bg-white dark:bg-gray-800/50 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm transition-all duration-500">
                        <div class="flex-shrink-0 size-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <span class="material-symbols-outlined text-green-600 dark:text-green-400">check_circle</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-[#111318] dark:text-white">Menganalisis preferensi Anda</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Preferensi petualangan dan budget telah diproses.</p>
                        </div>
                    </div>

                    {{-- Step 2 --}}
                    <div id="step-2" class="flex items-center gap-4 text-left p-4 bg-primary/5 dark:bg-primary/10 rounded-xl border border-primary/20 shadow-sm status-fade">
                        <div class="flex-shrink-0 size-10 rounded-full bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary animate-spin">sync</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-primary">Mengoptimalkan rute...</p>
                            <p class="text-xs text-primary/70">Mencari titik koordinat destinasi paling efisien.</p>
                        </div>
                    </div>

                    {{-- Step 3 --}}
                    <div id="step-3" class="flex items-center gap-4 text-left p-4 opacity-50 grayscale transition-all duration-500">
                        <div class="flex-shrink-0 size-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                            <span id="step-3-icon" class="material-symbols-outlined text-gray-400">map</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold">Menemukan destinasi terbaik</p>
                            <p class="text-xs text-gray-500">Mencocokkan skor optimal dengan database wisata.</p>
                        </div>
                    </div>
                </div>

                {{-- Progress Bar --}}
                <div class="w-full bg-gray-200 dark:bg-gray-700 h-1.5 rounded-full overflow-hidden mt-8">
                    <div id="progress-fill" class="bg-primary h-full w-[10%] transition-all duration-700 ease-out"></div>
                </div>
                <p id="progress-text" class="text-xs text-gray-400 dark:text-gray-500 uppercase tracking-widest font-bold">Proses: 10%</p>
            </div>
        </main>
<footer class="text-center py-8 px-4 border-t border-gray-200 dark:border-gray-700/50 mt-12">
    <div class="flex flex-col items-center gap-3 mb-4">
        <div class="flex items-center justify-center gap-2">
            <div class="size-5 text-primary">
                <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path d="M42.4379 44C42.4379 44 36.0744 33.9038 41.1692 24C46.8624 12.9336 42.2078 4 42.2078 4L7.01134 4C7.01134 4 11.6577 12.932 5.96912 23.9969C0.876273 33.9029 7.27094 44 7.27094 44L42.4379 44Z" fill="currentColor"></path>
                </svg>
            </div>
            <span class="text-sm font-extrabold tracking-tight text-[#111318] dark:text-white">Wisata Trenggalek</span>
        </div>
        
        <div class="flex justify-center">
            <span class="text-[10px] uppercase tracking-widest text-[#616f89] dark:text-gray-500 flex items-center gap-1 bg-gray-100 dark:bg-gray-800 px-3 py-1 rounded-full">
                <span class="material-symbols-outlined text-xs">bolt</span>
                Powered by PSO Algorithm
            </span>
        </div>
    </div>

    <p class="text-sm font-medium text-[#616f89] dark:text-gray-400">
        © {{ date('Y') }} <span class="text-[#111318] dark:text-gray-300">Sistem Informasi Pariwisata Kabupaten Trenggalek.</span>
    </p>
</footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const progressFill = document.getElementById('progress-fill');
            const progressText = document.getElementById('progress-text');
            const step3 = document.getElementById('step-3');
            const step3Icon = document.getElementById('step-3-icon');

            // Tahap 2: Sedang Optimasi (65%)
            setTimeout(() => {
                progressFill.style.width = "65%";
                progressText.innerText = "Proses: 65%";
            }, 1000);

            // Tahap 3: Menemukan Destinasi (90%)
            setTimeout(() => {
                progressFill.style.width = "90%";
                progressText.innerText = "Proses: 90%";
                step3.classList.remove('opacity-50', 'grayscale');
                step3Icon.classList.add('text-primary');
            }, 2500);

            // Tahap Akhir: Selesai & Redirect (100%)
            setTimeout(() => {
                progressFill.style.width = "100%";
                progressText.innerText = "Proses: 100% - Mengalihkan...";
                
                // PERBAIKAN: Menggunakan rute yang benar sesuai web.php
                window.location.href = "{{ route('rekomendasi.hasil') }}"; 
            }, 4000);
        });
    </script>
</body>
</html>