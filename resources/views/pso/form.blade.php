<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Personalized Trip Recommendations - Trenggalek Tourism</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<script>
tailwind.config = {
darkMode: "class",
theme: {
extend: {
colors: {
"primary": "#3498DB",
"secondary": "#2ECC71",
"background-light": "#F4F6F9",
"background-dark": "#102216",
"text-light": "#333333",
"text-dark": "#F4F6F9",
"card-light": "#FFFFFF",
"card-dark": "#1a2c20",
"border-light": "#E0E0E0",
"border-dark": "#3a4c40"
},
fontFamily: {
"display": ["Space Grotesk", "sans-serif"]
},
borderRadius: {
"DEFAULT": "0.5rem",
"lg": "0.75rem",
"xl": "1rem",
"full": "9999px",
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

<body class="font-display bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark">
<div class="relative flex min-h-screen w-full flex-col">

<div class="relative z-10 flex h-full grow flex-col items-center">

<main class="w-full max-w-2xl px-4 py-12 sm:px-6 sm:py-16">

<form method="POST" action="/pso/proses">
@csrf

<div class="flex flex-col gap-10 rounded-xl bg-card-light/80 dark:bg-card-dark/80 p-6 shadow-lg backdrop-blur-sm sm:p-10">

<div class="flex flex-col gap-4">
<h3 class="text-lg font-bold">What kind of destinations are you interested in?</h3>

<div class="grid grid-cols-2 gap-x-6 gap-y-3 sm:grid-cols-3">

<label class="flex items-center gap-x-3 py-2">
<input type="checkbox" name="tipe_wisata[]" value="beach"/>
<p>Beach</p>
</label>

<label class="flex items-center gap-x-3 py-2">
<input type="checkbox" name="tipe_wisata[]" value="mountain"/>
<p>Mountain</p>
</label>

<label class="flex items-center gap-x-3 py-2">
<input type="checkbox" name="tipe_wisata[]" value="culture"/>
<p>Culture</p>
</label>

<label class="flex items-center gap-x-3 py-2">
<input type="checkbox" name="tipe_wisata[]" value="waterfall"/>
<p>Waterfall</p>
</label>

<label class="flex items-center gap-x-3 py-2">
<input type="checkbox" name="tipe_wisata[]" value="cave"/>
<p>Cave</p>
</label>

<label class="flex items-center gap-x-3 py-2">
<input type="checkbox" name="tipe_wisata[]" value="forest"/>
<p>Forest</p>
</label>

</div>
</div>

<div class="flex flex-col gap-4">
<label class="text-lg font-bold">How long is your trip? (days)</label>
<input type="range" min="1" max="7" value="3" name="durasi"/>
</div>

<div class="flex flex-col gap-4">
<h3 class="text-lg font-bold">What is your estimated budget?</h3>

<label class="flex items-center gap-3">
<input type="radio" name="budget" value="budget"/>
<p>Budget</p>
</label>

<label class="flex items-center gap-3">
<input type="radio" name="budget" value="moderate" checked/>
<p>Moderate</p>
</label>

<label class="flex items-center gap-3">
<input type="radio" name="budget" value="premium"/>
<p>Premium</p>
</label>
</div>

<div class="pt-4">
<button type="submit" class="flex w-full items-center justify-center rounded-lg bg-primary py-4 text-lg font-bold text-white">
Find My Recommendations
</button>
</div>

</div>
</form>

</main>
</div>
</div>
</body>
</html>
