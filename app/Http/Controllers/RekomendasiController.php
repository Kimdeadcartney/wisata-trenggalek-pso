<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata;

class RekomendasiController extends Controller
{
    /**
     * Langkah 1: Pilih Kategori Wisata (Hard Constraint)
     */
    public function langkah1()
    {
        return view('rekomendasi.langkah1');
    }

    public function simpanLangkah1(Request $request)
    {
        $request->validate([
            'categories' => 'required|array|min:1'
        ]);

        session()->put('pso_data', $request->only('categories'));
        session()->forget('pso_results');

        return redirect()->route('rekomendasi.langkah2');
    }

    /**
     * Langkah 2: Parameter Lokasi & Budget
     */
    public function langkah2()
    {
        if (!session()->has('pso_data')) {
            return redirect()->route('rekomendasi.langkah1');
        }
        return view('rekomendasi.langkah2');
    }

    public function simpanLangkah2(Request $request)
    {
        $data = session('pso_data', []);
        $newData = array_merge($data, $request->only([
            'latitude', 'longitude', 'duration', 'budget', 'location'
        ]));
        session()->put('pso_data', $newData);

        return redirect()->route('rekomendasi.langkah3');
    }

    /**
     * Langkah 3: Rombongan & Minat (Social & Cognitive Factors)
     */
    public function langkah3()
    {
        if (!session()->has('pso_data')) {
            return redirect()->route('rekomendasi.langkah1');
        }
        return view('rekomendasi.langkah3');
    }

    public function simpanLangkah3(Request $request)
    {
        $data = session('pso_data', []);
        $newData = array_merge($data, $request->only(['companion', 'interests']));
        session()->put('pso_data', $newData);

        return redirect()->route('rekomendasi.langkah4');
    }

    /**
     * Langkah 4: Penentuan Jumlah Destinasi (Limit g-Best)
     */
    public function langkah4()
    {
        if (!session()->has('pso_data')) {
            return redirect()->route('rekomendasi.langkah1');
        }
        return view('rekomendasi.langkah4');
    }

    /**
     * INTI ALGORITMA PSO
     */
    public function prosesPSO(Request $request)
    {
        $userPreferences = session('pso_data', []);
        $limitTujuan = (int) $request->input('limit_tujuan', 3);

        // 1. Koordinat User (Titik Awal Swarm)
        $userLat = (float) ($userPreferences['latitude'] ?? -8.0581);
        $userLng = (float) ($userPreferences['longitude'] ?? 111.7118);
        $kategoriTerpilih = $userPreferences['categories'] ?? [];
        $minatUser = $userPreferences['interests'] ?? [];
        $companion = $userPreferences['companion'] ?? 'solo';
        $maxBudget = (float) ($userPreferences['budget'] ?? 1000000);

        // 2. Swarm Filtering (Initial Population)
        $query = Wisata::query();

        if (!empty($kategoriTerpilih)) {
            $query->where(function($q) use ($kategoriTerpilih) {
                foreach ($kategoriTerpilih as $kat) {
                    $q->orWhereRaw('LOWER(kategori) LIKE ?', ['%' . strtolower($kat) . '%']);
                }
            });
        }

        $daftarWisata = $query->get();

        if ($daftarWisata->isEmpty()) {
            session()->put('pso_results', collect());
            return redirect()->route('rekomendasi.hasil')->with('error', 'Tidak ditemukan wisata yang sesuai kriteria.');
        }

        // 3. Evaluasi Fitness (Menghitung p-Best tiap partikel)
        $daftarWisata = $daftarWisata->map(function ($wisata) use ($userLat, $userLng, $minatUser, $companion) {
            $earthRadius = 6371; 
            $dLat = deg2rad((float)$wisata->latitude - $userLat);
            $dLon = deg2rad((float)$wisata->longitude - $userLng);
            $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($userLat)) * cos(deg2rad((float)$wisata->latitude)) * sin($dLon/2) * sin($dLon/2);
            $c = 2 * atan2(sqrt($a), sqrt(1-$a));
            $distance = $earthRadius * $c;

            $bonusScore = 0;
            $fasilitas = strtolower($wisata->fasilitas ?? '');
            
            foreach ($minatUser as $m) {
                if (!empty($m) && str_contains($fasilitas, strtolower($m))) {
                    $bonusScore += 15; 
                }
            }

            if ($companion == 'keluarga' && (str_contains($fasilitas, 'anak') || str_contains($fasilitas, 'bermain'))) $bonusScore += 20;
            if ($companion == 'pasangan' && str_contains($fasilitas, 'foto')) $bonusScore += 15;
            if ($companion == 'teman' && str_contains($fasilitas, 'camping')) $bonusScore += 15;

            $wisata->jarak_realtime = $distance; 
            $wisata->pso_bonus = $bonusScore;
            return $wisata;
        });

        // 4. Update Global Best (Ranking Berdasarkan Fitness)
        $minDist = $daftarWisata->min('jarak_realtime') ?: 0.1;
        $maxDist = $daftarWisata->max('jarak_realtime') ?: 1;
        $range = ($maxDist - $minDist) ?: 1;

        $results = $daftarWisata->map(function ($wisata) use ($minDist, $range) {
            $fitnessJarak = (1 - (($wisata->jarak_realtime - $minDist) / $range)) * 70;
            $finalScore = $fitnessJarak + $wisata->pso_bonus;
            
            return [
                'nama' => $wisata->nama,
                'kategori' => $wisata->kategori,
                'jarak' => round($wisata->jarak_realtime, 1),
                'harga' => (int) $wisata->harga_tiket,
                'rating' => $wisata->rating,
                'gambar' => $wisata->gambar,
                'latitude' => (float) $wisata->latitude,
                'longitude' => (float) $wisata->longitude,
                'fitness_score' => round(min(100, $finalScore))
            ];
        })
        ->sortByDesc('fitness_score') 
        ->take($limitTujuan)          
        ->values();

        session()->put('pso_results', $results); 
        
        // REDIRECT KE LOADING SEBELUM KE HASIL
        return redirect()->route('rekomendasi.loading');
    }

    /**
     * Tampilkan Halaman Animasi Loading
     */
    public function loading()
    {
        if (!session()->has('pso_results')) {
            return redirect()->route('rekomendasi.langkah1');
        }
        return view('rekomendasi.loading');
    }

    /**
     * Tampilkan Hasil Akhir
     */
    public function hasil()
    {
        $results = session('pso_results');
        $pso_data = session('pso_data');

        if ($results === null) {
            return redirect()->route('rekomendasi.langkah1');
        }
        
        return view('rekomendasi.hasil', compact('results', 'pso_data'));
    }
}