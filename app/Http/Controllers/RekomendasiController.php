<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Services\NearestNeighborService;

class RekomendasiController extends Controller
{
    // =========================================================
    // PARAMETER PSO — REKOMENDASI DESTINASI (default)
    // =========================================================
    const PSO_PARTIKEL      = 30;
    const PSO_ITERASI       = 100;
    const PSO_W             = 0.5;
    const PSO_C1            = 1.5;
    const PSO_C2            = 1.5;

    // Bobot default (akan di-override oleh slider langkah4)
    const BOBOT_RATING      = 0.35;
    const BOBOT_JARAK       = 0.30;
    const BOBOT_HARGA       = 0.15;
    const BOBOT_MINAT       = 0.12;  // selalu fixed
    const BOBOT_COMPANION   = 0.08;  // selalu fixed

    // =========================================================
    // PARAMETER PSO — OPTIMASI RUTE (TSP)
    // =========================================================
    const RUTE_PARTIKEL     = 50;
    const RUTE_ITERASI      = 200;
    const RUTE_W            = 0.6;
    const RUTE_C1           = 1.8;
    const RUTE_C2           = 1.8;

    // =========================================================
    // MAPPING COMPANION (blade → controller)
    // =========================================================
    private array $companionMap = [
        'solo'      => 'solo',
        'couple'    => 'pasangan',
        'family'    => 'keluarga',
        'friends'   => 'teman',
        'pasangan'  => 'pasangan',
        'keluarga'  => 'keluarga',
        'teman'     => 'teman',
        'rombongan' => 'rombongan',
    ];

    // =========================================================
    // MAPPING KATEGORI BLADE → KATEGORI DATABASE
    // =========================================================
    private array $categoryAliasMap = [
        'pantai'            => ['Pantai'],
        'alam'              => ['Alam', 'Bukit', 'Hutan', 'Agrowisata'],
        'budaya'            => ['Budaya', 'Desa Wisata'],
        'gua'               => ['Goa'],
        'religi'            => ['Budaya'],
        'kuliner'           => ['Kuliner'],
        'goa'               => ['Goa'],
        'air terjun'        => ['Air Terjun'],
        'wisata buatan'     => ['Wisata Buatan'],
        'hotel'             => ['Hotel'],
        'agrowisata'        => ['Agrowisata'],
        'desa wisata'       => ['Desa Wisata'],
        'bukit'             => ['Bukit'],
        'hutan'             => ['Hutan'],
        'wisata religi'     => ['Budaya'],
        'religi & budaya'   => ['Budaya', 'Desa Wisata'],
        'alam & pegunungan' => ['Alam', 'Bukit', 'Hutan', 'Agrowisata'],
        'budaya & sejarah'  => ['Budaya', 'Desa Wisata'],
        'gua & karst'       => ['Goa'],
    ];

    // =========================================================
    // HELPER — Ekspansi kategori blade → DB kategori
    // =========================================================
    private function expandKategori(array $selected): array
    {
        $hasil = [];
        foreach ($selected as $kat) {
            $key    = strtolower(trim($kat));
            $mapped = $this->categoryAliasMap[$key] ?? [ucwords(strtolower($kat))];
            $hasil  = array_merge($hasil, $mapped);
        }
        return array_values(array_unique($hasil));
    }

    // =========================================================
    // LANGKAH 1 — Pilih Kategori
    // =========================================================
    public function langkah1()
    {
        $kategoriDb = Wisata::select('kategori')
            ->distinct()
            ->whereNotIn('kategori', ['Kuliner'])
            ->orderBy('kategori')
            ->pluck('kategori');

        return view('rekomendasi.langkah1', compact('kategoriDb'));
    }

    public function simpanLangkah1(Request $request)
    {
        $request->validate(
            ['categories' => 'required|array|min:1'],
            ['categories.required' => 'Pilih minimal 1 kategori wisata.']
        );

        session()->put('pso_data', $request->only('categories'));
        session()->forget(['pso_results', 'pso_rute', 'pso_meta']);

        return redirect()->route('rekomendasi.langkah2');
    }

    // =========================================================
    // LANGKAH 2 — Lokasi, Durasi & Budget
    // =========================================================
    public function langkah2()
    {
        if (!session()->has('pso_data')) {
            return redirect()->route('rekomendasi.langkah1');
        }
        return view('rekomendasi.langkah2');
    }

    public function simpanLangkah2(Request $request)
    {
        $request->validate([
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
            'budget'    => 'required|numeric|min:0',
            'duration'  => 'required|integer|min:1|max:7',
        ], [
            'latitude.required'  => 'Lokasi belum terdeteksi. Izinkan akses GPS.',
            'longitude.required' => 'Lokasi belum terdeteksi.',
            'budget.required'    => 'Masukkan estimasi budget perjalanan.',
            'duration.required'  => 'Tentukan durasi perjalanan.',
        ]);

        $namaLokasi = trim($request->input('nama_lokasi_user', ''))
                   ?: trim($request->input('location', 'Trenggalek'));

        $data = session('pso_data', []);
        session()->put('pso_data', array_merge($data, [
            'latitude'  => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'budget'    => $request->input('budget'),
            'duration'  => $request->input('duration'),
            'location'  => $namaLokasi,
        ]));

        return redirect()->route('rekomendasi.langkah3');
    }

    // =========================================================
    // LANGKAH 3 — Rombongan & Minat
    // =========================================================
    public function langkah3()
    {
        if (!session()->has('pso_data')) {
            return redirect()->route('rekomendasi.langkah1');
        }
        return view('rekomendasi.langkah3');
    }

    public function simpanLangkah3(Request $request)
    {
        $request->validate(
            ['companion' => 'required|string'],
            ['companion.required' => 'Pilih jenis rombongan perjalanan.']
        );

        $companionRaw    = $request->input('companion', 'solo');
        $companionMapped = $this->companionMap[$companionRaw] ?? 'solo';

        $data = session('pso_data', []);
        session()->put('pso_data', array_merge($data, [
            'companion'       => $companionMapped,
            'companion_label' => $companionRaw,
            'interests'       => $request->input('interests', []),
        ]));

        return redirect()->route('rekomendasi.langkah4');
    }

    // =========================================================
    // LANGKAH 4 — Jumlah Destinasi & Bobot PSO
    // =========================================================
    public function langkah4()
    {
        if (!session()->has('pso_data')) {
            return redirect()->route('rekomendasi.langkah1');
        }

        $kategoriDipilih = session('pso_data.categories', []);
        $jumlahKategori  = count($kategoriDipilih);

        return view('rekomendasi.langkah4', compact('kategoriDipilih', 'jumlahKategori'));
    }

    // =========================================================
    // INTI — PSO Rekomendasi + PSO Optimasi Rute (TSP)
    // POST dari langkah4 → route('rekomendasi.proses')
    // =========================================================
    public function prosesPSO(Request $request)
    {
        $request->validate(
            ['limit_tujuan' => 'required|integer|min:1|max:10'],
            [
                'limit_tujuan.required' => 'Tentukan jumlah destinasi yang diinginkan.',
                'limit_tujuan.max'      => 'Maksimal 10 destinasi dalam satu perjalanan.',
                'limit_tujuan.min'      => 'Minimal 1 destinasi harus dipilih.',
            ]
        );

        $pref            = session('pso_data', []);
        $limitTujuan     = (int) $request->input('limit_tujuan', 3);
        $userLat         = (float) ($pref['latitude']  ?? -8.0581);
        $userLng         = (float) ($pref['longitude'] ?? 111.7118);
        $lokasiNama      = $pref['location']   ?? 'Lokasi Anda';
        $kategoriDipilih = $pref['categories'] ?? [];
        $minatUser       = $pref['interests']  ?? [];
        $companion       = $pref['companion']  ?? 'solo';

        $wPrice      = max(0, (int) $request->input('weight_price',      50));
        $wDistance   = max(0, (int) $request->input('weight_distance',   90));
        $wPopularity = max(0, (int) $request->input('weight_popularity', 70));
        $wTotal      = $wPrice + $wDistance + $wPopularity;

        if ($wTotal > 0) {
            $bobotHarga  = round(($wPrice      / $wTotal) * 0.80, 4);
            $bobotJarak  = round(($wDistance   / $wTotal) * 0.80, 4);
            $bobotRating = round(($wPopularity / $wTotal) * 0.80, 4);
        } else {
            $bobotHarga  = self::BOBOT_HARGA;
            $bobotJarak  = self::BOBOT_JARAK;
            $bobotRating = self::BOBOT_RATING;
        }
        $bobotMinat     = self::BOBOT_MINAT;
        $bobotCompanion = self::BOBOT_COMPANION;

        // ── Apakah user memilih Kuliner secara eksplisit? ─────
        $userPilihKuliner = !empty(array_intersect(
            array_map('strtolower', $kategoriDipilih),
            ['kuliner']
        ));

        $expandedKategori    = $this->expandKategori($kategoriDipilih);
        $kategoryFallbackInfo = $this->buildFallbackInfo($kategoriDipilih, $expandedKategori);

        $baseQuery = Wisata::whereNotNull('latitude')
                           ->whereNotNull('longitude');

        if (!$userPilihKuliner) {
            $baseQuery->whereNotIn('kategori', ['Kuliner']);
        }

        if (!empty($expandedKategori)) {
            $rawWisata = (clone $baseQuery)
                ->whereIn('kategori', $expandedKategori)
                ->get();
        } else {
            $rawWisata = collect();
        }

        $isFallback = false;
        if ($rawWisata->isEmpty()) {
            $rawWisata  = (clone $baseQuery)->get();
            $isFallback = true;
        }

        if ($rawWisata->isEmpty()) {
            session()->put('pso_results', collect());
            session()->put('pso_meta', [
                'error'             => true,
                'pesan_error'       => 'Tidak ada data wisata yang tersedia di database. Silakan hubungi administrator.',
                'kategori_terpilih' => $kategoriDipilih,
            ]);
            return redirect()->route('rekomendasi.hasil');
        }

        // ── Hitung fitness dasar tiap wisata ──────────────────
        $daftarWisata = $rawWisata->map(function ($w) use ($userLat, $userLng, $minatUser, $companion) {
            return [
                'id'              => $w->id,
                'nama'            => $w->nama,
                'kategori'        => $w->kategori,
                'latitude'        => (float) $w->latitude,
                'longitude'       => (float) $w->longitude,
                'rating'          => (float) ($w->rating      ?? 0),
                'harga'           => (float) ($w->harga_tiket ?? 0),
                'fasilitas'       => strtolower($w->fasilitas ?? ''),
                'gambar'          => $w->gambar    ?? '',
                'deskripsi'       => $w->deskripsi ?? '',
                'jam_buka'        => $w->jam_buka  ?? '',
                'jam_tutup'       => $w->jam_tutup ?? '',
                'jarak'           => $this->haversine(
                    $userLat, $userLng,
                    (float) $w->latitude, (float) $w->longitude
                ),
                'bonus_minat'     => $this->hitungBonusMinat($w->fasilitas ?? '', $minatUser),
                'bonus_companion' => $this->hitungBonusCompanion($w->fasilitas ?? '', $companion),
            ];
        })->values()->toArray();

        $maxRating = max(array_column($daftarWisata, 'rating')) ?: 1;
        $maxJarak  = max(array_column($daftarWisata, 'jarak'))  ?: 1;
        $maxHarga  = max(array_column($daftarWisata, 'harga'))  ?: 1;
        $maxMinat  = max(array_column($daftarWisata, 'bonus_minat'))     ?: 1;
        $maxComp   = max(array_column($daftarWisata, 'bonus_companion')) ?: 1;

        foreach ($daftarWisata as &$item) {
            $item['norm_rating']    = $item['rating']          / $maxRating;
            $item['norm_jarak']     = 1 - ($item['jarak']      / $maxJarak);
            $item['norm_harga']     = 1 - ($item['harga']      / $maxHarga);
            $item['norm_minat']     = $item['bonus_minat']     / $maxMinat;
            $item['norm_companion'] = $item['bonus_companion'] / $maxComp;

            $item['fitness_dasar'] =
                ($bobotRating    * $item['norm_rating'])
              + ($bobotJarak     * $item['norm_jarak'])
              + ($bobotHarga     * $item['norm_harga'])
              + ($bobotMinat     * $item['norm_minat'])
              + ($bobotCompanion * $item['norm_companion']);
        }
        unset($item);

        $wisataPerKategori = [];
        foreach ($daftarWisata as $idx => $item) {
            $wisataPerKategori[$item['kategori']][] = $idx;
        }
        $kategoriAda = array_keys($wisataPerKategori);
        $n           = count($daftarWisata);

        $limitTujuan = max(1, min($limitTujuan, min($n, 10)));

        // ── Inisialisasi Partikel PSO ─────────────────────────
        $partikel = [];
        for ($p = 0; $p < self::PSO_PARTIKEL; $p++) {
            $posisi  = $this->inisialisasiPosisi(
                $daftarWisata, $limitTujuan, $wisataPerKategori, $kategoriAda, $n
            );
            $fitness = $this->fitnessCombination($posisi, $daftarWisata);
            $partikel[$p] = [
                'posisi'       => $posisi,
                'velocity'     => array_fill(0, $limitTujuan, 0.0),
                'pBest'        => $posisi,
                'pBestFitness' => $fitness,
            ];
        }

        $gBest        = $partikel[0]['pBest'];
        $gBestFitness = $partikel[0]['pBestFitness'];
        foreach ($partikel as $p) {
            if ($p['pBestFitness'] > $gBestFitness) {
                $gBestFitness = $p['pBestFitness'];
                $gBest        = $p['pBest'];
            }
        }

        // ── Iterasi PSO ───────────────────────────────────────
        $logRekomendasiIterasi = [];
        for ($iter = 1; $iter <= self::PSO_ITERASI; $iter++) {
            foreach ($partikel as &$p) {
                $posisiBaru = [];
                for ($d = 0; $d < $limitTujuan; $d++) {
                    $r1 = mt_rand() / mt_getrandmax();
                    $r2 = mt_rand() / mt_getrandmax();
                    $p['velocity'][$d] =
                        self::PSO_W  * $p['velocity'][$d]
                      + self::PSO_C1 * $r1 * (($p['pBest'][$d] ?? 0) - $p['posisi'][$d])
                      + self::PSO_C2 * $r2 * (($gBest[$d]      ?? 0) - $p['posisi'][$d]);
                    $idxBaru        = (int) round($p['posisi'][$d] + $p['velocity'][$d]);
                    $posisiBaru[$d] = max(0, min($n - 1, $idxBaru));
                }
                $posisiBaru  = $this->perbaikiPosisi(
                    $posisiBaru, $limitTujuan, $daftarWisata, $wisataPerKategori, $kategoriAda, $n
                );
                $p['posisi'] = $posisiBaru;
                $fitnessBaru = $this->fitnessCombination($posisiBaru, $daftarWisata);

                if ($fitnessBaru > $p['pBestFitness']) {
                    $p['pBest']        = $posisiBaru;
                    $p['pBestFitness'] = $fitnessBaru;
                }
                if ($fitnessBaru > $gBestFitness) {
                    $gBestFitness = $fitnessBaru;
                    $gBest        = $posisiBaru;
                }
            }
            unset($p);

            if ($iter % 10 === 0 || $iter === 1 || $iter === self::PSO_ITERASI) {
                $logRekomendasiIterasi[] = [
                    'iterasi'       => $iter,
                    'gbest_fitness' => round($gBestFitness, 6),
                ];
            }
        }

        // ── Kumpulkan Destinasi Terpilih ──────────────────────
        $destinasiTerpilih = [];
        foreach (array_unique($gBest) as $idx) {
            if (!isset($daftarWisata[$idx])) continue;
            $item = $daftarWisata[$idx];
            $destinasiTerpilih[] = [
                'id'             => $item['id'],
                'nama'           => $item['nama'],
                'kategori'       => $item['kategori'],
                'latitude'       => $item['latitude'],
                'longitude'      => $item['longitude'],
                'jarak'          => round($item['jarak'], 1),
                'harga'          => (int) $item['harga'],
                'rating'         => $item['rating'],
                'gambar'         => $item['gambar'],
                'deskripsi'      => $item['deskripsi'],
                'jam_buka'       => $item['jam_buka'],
                'jam_tutup'      => $item['jam_tutup'],
                'fitness_score'  => round($item['fitness_dasar'] * 100, 2),
                'detail_fitness' => [
                    'rating_score'    => round($item['norm_rating']    * $bobotRating    * 100, 2),
                    'jarak_score'     => round($item['norm_jarak']     * $bobotJarak     * 100, 2),
                    'harga_score'     => round($item['norm_harga']     * $bobotHarga     * 100, 2),
                    'minat_score'     => round($item['norm_minat']     * $bobotMinat     * 100, 2),
                    'companion_score' => round($item['norm_companion'] * $bobotCompanion * 100, 2),
                ],
            ];
        }

        $hasilRekomendasi = collect($destinasiTerpilih)
            ->sortByDesc('fitness_score')
            ->values();

     // ── PSO Optimasi Rute (TSP) ───────────────────────────
$hasilRute = $this->psoOptimasiRute(
    
    $userLat, $userLng,
    $destinasiTerpilih,
    $lokasiNama
);

// ── Nearest Neighbor ───────────────────────────
$nn = new NearestNeighborService();

$hasilNN = $nn->jalankan(
    $userLat,
    $userLng,
    $destinasiTerpilih,
    $lokasiNama
);

$komparasi = $nn->komparasi(
    $hasilRute['total_jarak'],
    $hasilNN['total_jarak']
);
\Log::info('PSO KOMPARASI:', $komparasi);
        // ── Susun metadata PSO ────────────────────────────────
        $psoMeta = [
            'rekomendasi' => [
                'partikel'        => self::PSO_PARTIKEL,
                'iterasi'         => self::PSO_ITERASI,
                'w'               => self::PSO_W,
                'c1'              => self::PSO_C1,
                'c2'              => self::PSO_C2,
                'bobot_rating'    => $bobotRating,
                'bobot_jarak'     => $bobotJarak,
                'bobot_harga'     => $bobotHarga,
                'bobot_minat'     => $bobotMinat,
                'bobot_companion' => $bobotCompanion,
                'gbest_fitness'   => round($gBestFitness, 6),
                'total_wisata'    => $n,
                'log_iterasi'     => $logRekomendasiIterasi,
            ],
            'rute' => [
                'partikel'       => self::RUTE_PARTIKEL,
                'iterasi'        => self::RUTE_ITERASI,
                'w'              => self::RUTE_W,
                'c1'             => self::RUTE_C1,
                'c2'             => self::RUTE_C2,
                'total_jarak_km' => $hasilRute['total_jarak'],
                'log_iterasi'    => $hasilRute['log_iterasi'],
            ],
            'komparasi' => $komparasi,
'rute_nn' => $hasilNN,
            'kategori_terpilih' => $kategoriDipilih,
            'expanded_kategori' => $expandedKategori,
            'fallback_info'     => $kategoryFallbackInfo,
            'is_fallback'       => $isFallback,
            'limit_tujuan'      => $limitTujuan,
            'titik_awal'        => [
                'nama' => $lokasiNama,
                'lat'  => $userLat,
                'lng'  => $userLng,
            ],
            'bobot_digunakan' => [
                'rating'    => $bobotRating,
                'jarak'     => $bobotJarak,
                'harga'     => $bobotHarga,
                'minat'     => $bobotMinat,
                'companion' => $bobotCompanion,
            ],
        ];

        session()->put('pso_results', $hasilRekomendasi);
        session()->put('pso_rute',    $hasilRute);
        session()->put('pso_meta',    $psoMeta);

        return redirect()->route('rekomendasi.loading');
    }

    // =========================================================
    // HELPER — Bangun info fallback kategori
    // =========================================================
    private function buildFallbackInfo(array $kategoriDipilih, array $expandedKategori): array
    {
        $info = [];
        $availableDb = Wisata::select('kategori')
            ->distinct()
            ->whereNotIn('kategori', ['Hotel'])
            ->pluck('kategori')
            ->map(fn($k) => strtolower($k))
            ->toArray();

        foreach ($kategoriDipilih as $kat) {
            $key    = strtolower(trim($kat));
            $mapped = $this->categoryAliasMap[$key] ?? null;

            if ($mapped !== null) {
                $isExactMatch = in_array(ucwords($key), array_map('ucwords', $availableDb));
                if (!$isExactMatch) {
                    $info[] = [
                        'dipilih' => $kat,
                        'diremap' => $mapped,
                        'pesan'   => "Kategori \"{$kat}\" tidak tersedia secara terpisah, ditampilkan dari: " . implode(', ', $mapped),
                    ];
                }
            }
        }
        return $info;
    }

    // =========================================================
    // PSO OPTIMASI RUTE — FASE 3 (TSP)
    // =========================================================
    private function psoOptimasiRute(
        float $userLat,
        float $userLng,
        array $destinasi,
        string $lokasiNama
    ): array {
        $jumlah = count($destinasi);

        if ($jumlah === 0) {
            return ['urutan_rute' => [], 'total_jarak' => 0, 'log_iterasi' => []];
        }

        // Edge case: 1 destinasi
        if ($jumlah === 1) {
            $d   = $destinasi[0];
            $jAB = round($this->haversine($userLat, $userLng, $d['latitude'], $d['longitude']), 2);
            $jBA = round($this->haversine($d['latitude'], $d['longitude'], $userLat, $userLng), 2);
            return [
                'urutan_rute' => [
                    [
                        'urutan'           => 0,
                        'nama'             => $lokasiNama,
                        'tipe'             => 'asal',
                        'latitude'         => $userLat,
                        'longitude'        => $userLng,
                        'jarak_ke_berikut' => $jAB,
                    ],
                    [
                        'urutan'           => 1,
                        'id'               => $d['id'],
                        'nama'             => $d['nama'],
                        'tipe'             => 'destinasi',
                        'latitude'         => $d['latitude'],
                        'longitude'        => $d['longitude'],
                        'kategori'         => $d['kategori'],
                        'rating'           => $d['rating'],
                        'harga'            => $d['harga'],
                        'gambar'           => $d['gambar'],
                        'fitness_score'    => $d['fitness_score'],
                        'jam_buka'         => $d['jam_buka'],
                        'jam_tutup'        => $d['jam_tutup'],
                        'jarak_ke_berikut' => $jBA,
                    ],
                    [
                        'urutan'           => 2,
                        'nama'             => $lokasiNama . ' (Kembali)',
                        'tipe'             => 'kembali',
                        'latitude'         => $userLat,
                        'longitude'        => $userLng,
                        'jarak_ke_berikut' => 0,
                    ],
                ],
                'total_jarak' => round($jAB + $jBA, 2),
                'log_iterasi' => [],
            ];
        }

        // Bangun array titik: index 0 = titik awal user, index 1..n = destinasi
        $titik = array_merge(
            [['nama' => $lokasiNama, 'latitude' => $userLat, 'longitude' => $userLng]],
            array_map(fn($d) => [
                'nama'      => $d['nama'],
                'latitude'  => $d['latitude'],
                'longitude' => $d['longitude'],
            ], $destinasi)
        );
        $nTitik = count($titik);

        // Pre-compute matriks jarak
        $mj = [];
        for ($i = 0; $i < $nTitik; $i++) {
            for ($j = 0; $j < $nTitik; $j++) {
                $mj[$i][$j] = $i === $j ? 0 : $this->haversine(
                    $titik[$i]['latitude'],  $titik[$i]['longitude'],
                    $titik[$j]['latitude'],  $titik[$j]['longitude']
                );
            }
        }

        $totalJarak = function (array $perm) use ($mj, $jumlah): float {
            $total = $mj[0][$perm[0]];
            for ($i = 0; $i < $jumlah - 1; $i++) {
                $total += $mj[$perm[$i]][$perm[$i + 1]];
            }
            $total += $mj[$perm[$jumlah - 1]][0];
            return $total;
        };

        $indeksAsli = range(1, $jumlah);

        $gBest      = $this->nearestNeighborSeed($indeksAsli, $mj);
        $gBestJarak = $totalJarak($gBest);

        $partikel = [];
        for ($p = 0; $p < self::RUTE_PARTIKEL; $p++) {
            $perm  = $indeksAsli;
            shuffle($perm);
            $jarak = $totalJarak($perm);
            $partikel[$p] = [
                'posisi'     => $perm,
                'velocity'   => $this->randomSwaps($jumlah),
                'pBest'      => $perm,
                'pBestJarak' => $jarak,
            ];
            if ($jarak < $gBestJarak) {
                $gBestJarak = $jarak;
                $gBest      = $perm;
            }
        }

        $logRute = [];
        for ($iter = 1; $iter <= self::RUTE_ITERASI; $iter++) {
            foreach ($partikel as &$p) {
                $swapV = $this->scaleSwaps($p['velocity'], self::RUTE_W);
                $swapK = $this->permDiff($p['posisi'], $p['pBest'], self::RUTE_C1);
                $swapS = $this->permDiff($p['posisi'], $gBest,      self::RUTE_C2);

                $allSwaps      = array_merge($swapV, $swapK, $swapS);
                $p['velocity'] = $allSwaps;

                $baru = $p['posisi'];
                foreach ($allSwaps as [$i, $j]) {
                    [$baru[$i], $baru[$j]] = [$baru[$j], $baru[$i]];
                }

                $baru        = $this->perbaikiPermutasi($baru, $indeksAsli);
                $p['posisi'] = $baru;
                $jarakBaru   = $totalJarak($baru);

                if ($jarakBaru < $p['pBestJarak']) {
                    $p['pBest']      = $baru;
                    $p['pBestJarak'] = $jarakBaru;
                }
                if ($jarakBaru < $gBestJarak) {
                    $gBestJarak = $jarakBaru;
                    $gBest      = $baru;
                }
            }
            unset($p);

            if ($iter % 20 === 0 || $iter === 1 || $iter === self::RUTE_ITERASI) {
                $logRute[] = [
                    'iterasi'     => $iter,
                    'total_jarak' => round($gBestJarak, 4),
                ];
            }
        }

        // ── Susun urutan rute final ───────────────────────────
        $urutanRute   = [];
        $urutanRute[] = [
            'urutan'           => 0,
            'nama'             => $lokasiNama,
            'tipe'             => 'asal',
            'latitude'         => $userLat,
            'longitude'        => $userLng,
            'jarak_ke_berikut' => round($mj[0][$gBest[0]], 2),
        ];

        foreach ($gBest as $urutan => $titikIdx) {
            $dest    = $destinasi[$titikIdx - 1];
            $berikut = isset($gBest[$urutan + 1])
                ? $mj[$titikIdx][$gBest[$urutan + 1]]
                : $mj[$titikIdx][0];

            $urutanRute[] = [
                'urutan'           => $urutan + 1,
                'id'               => $dest['id'],
                'nama'             => $dest['nama'],
                'tipe'             => 'destinasi',
                'latitude'         => $dest['latitude'],
                'longitude'        => $dest['longitude'],
                'kategori'         => $dest['kategori'],
                'rating'           => $dest['rating'],
                'harga'            => $dest['harga'],
                'gambar'           => $dest['gambar'],
                'fitness_score'    => $dest['fitness_score'],
                'jam_buka'         => $dest['jam_buka'],
                'jam_tutup'        => $dest['jam_tutup'],
                'jarak_ke_berikut' => round($berikut, 2),
            ];
        }

        $urutanRute[] = [
            'urutan'           => $jumlah + 1,
            'nama'             => $lokasiNama . ' (Kembali)',
            'tipe'             => 'kembali',
            'latitude'         => $userLat,
            'longitude'        => $userLng,
            'jarak_ke_berikut' => 0,
        ];

        return [
            'urutan_rute' => $urutanRute,
            'total_jarak' => round($gBestJarak, 2),
            'log_iterasi' => $logRute,
        ];
    }

    // =========================================================
    // Loading & Hasil
    // =========================================================
    public function loading()
    {
        if (!session()->has('pso_results')) {
            return redirect()->route('rekomendasi.langkah1');
        }
        return view('rekomendasi.loading');
    }

    // =========================================================
    // HASIL — Tampilkan itinerary hasil PSO
    // =========================================================
    public function hasil()
{
    $results  = session('pso_results');
    $pso_rute = session('pso_rute');
    $pso_data = session('pso_data');
    $pso_meta = session('pso_meta');

    if ($results === null) {
        return redirect()->route('rekomendasi.langkah1');
    }

    $semuaWisata = Wisata::query()
        ->orderBy('kategori')
        ->orderByDesc('rating')
        ->get([
            'id', 'nama', 'kategori', 'kecamatan',
            'rating', 'harga_tiket', 'gambar',
            'latitude', 'longitude',
            'jam_buka', 'jam_tutup', 'fasilitas',
        ]);

    // ← Tambahkan ini
    $currentIdsJs = $results->pluck('id')->values()->toArray();

    return view('rekomendasi.hasil', compact(
        'results', 'pso_rute', 'pso_data', 'pso_meta', 'semuaWisata', 'currentIdsJs'
    ));
}

    // =========================================================
    // UPDATE RUTE — Hapus / Tambah destinasi dari halaman hasil
    // POST /rekomendasi/update-rute
    // =========================================================
    public function updateRute(Request $request)
    {
        // Guard: pastikan session PSO ada
        $results  = session('pso_results');
        $pso_meta = session('pso_meta');
        $pso_data = session('pso_data');

        if ($results === null) {
            return redirect()->route('rekomendasi.langkah1');
        }

        // Ambil perubahan dari form
        $removedIds = array_map('intval', $request->input('removed_ids', []));
        $addedIds   = array_map('intval', $request->input('added_ids',   []));

        // Data lokasi user
        $userLat    = (float) ($pso_data['latitude']  ?? -8.0581);
        $userLng    = (float) ($pso_data['longitude'] ?? 111.7118);
        $lokasiNama = $pso_data['location'] ?? 'Lokasi Anda';
        $minatUser  = $pso_data['interests']  ?? [];
        $companion  = $pso_data['companion']  ?? 'solo';

        // Bobot PSO yang digunakan saat ini
        $bobotData      = $pso_meta['bobot_digunakan'] ?? [];
        $bobotRating    = (float) ($bobotData['rating']    ?? self::BOBOT_RATING);
        $bobotJarak     = (float) ($bobotData['jarak']     ?? self::BOBOT_JARAK);
        $bobotHarga     = (float) ($bobotData['harga']     ?? self::BOBOT_HARGA);
        $bobotMinat     = (float) ($bobotData['minat']     ?? self::BOBOT_MINAT);
        $bobotCompanion = (float) ($bobotData['companion'] ?? self::BOBOT_COMPANION);

        // ── FASE 1: Terapkan penghapusan ─────────────────────
        $currentDestinasi = collect($results)
            ->filter(fn($r) => !in_array((int) $r['id'], $removedIds))
            ->values()
            ->toArray();

        // ── FASE 2: Terapkan penambahan ──────────────────────
        if (!empty($addedIds)) {
            // Hindari duplikat
            $existingIds    = array_column($currentDestinasi, 'id');
            $benarBenarBaru = array_diff($addedIds, $existingIds);

            if (!empty($benarBenarBaru)) {
                $newWisata = Wisata::whereIn('id', $benarBenarBaru)->get();

                // Nilai max dari pool saat ini untuk normalisasi
                $allRatings = array_merge(array_column($currentDestinasi, 'rating'), [1]);
                $allHargas  = array_merge(array_column($currentDestinasi, 'harga'),  [1]);

                foreach ($newWisata as $w) {
                    $jarak          = $this->haversine($userLat, $userLng, (float)$w->latitude, (float)$w->longitude);
                    $bonusMinat     = $this->hitungBonusMinat($w->fasilitas ?? '', $minatUser);
                    $bonusCompanion = $this->hitungBonusCompanion($w->fasilitas ?? '', $companion);

                    $allRatings[] = (float)($w->rating     ?? 0);
                    $allHargas[]  = (float)($w->harga_tiket ?? 0);

                    $maxRating = max($allRatings) ?: 1;
                    $maxHarga  = max($allHargas)  ?: 1;

                    $allJarak = array_merge(
    array_map(
        fn($d) => $this->haversine($userLat, $userLng, (float)$d['latitude'], (float)$d['longitude']),
        $currentDestinasi
    ),
    [$jarak, 1]
);
                    $maxJarak = max($allJarak) ?: 1;

                    $normRating = (float)($w->rating      ?? 0) / $maxRating;
                    $normJarak  = 1 - ($jarak               / $maxJarak);
                    $normHarga  = 1 - ((float)($w->harga_tiket ?? 0) / $maxHarga);
                    $normMinat  = $bonusMinat     > 0 ? min(1.0, $bonusMinat     / 3.0) : 0.0;
                    $normComp   = $bonusCompanion > 0 ? min(1.0, $bonusCompanion / 2.0) : 0.0;

                    $fitnessDasar =
                        ($bobotRating    * $normRating)
                      + ($bobotJarak     * $normJarak)
                      + ($bobotHarga     * $normHarga)
                      + ($bobotMinat     * $normMinat)
                      + ($bobotCompanion * $normComp);

                    $currentDestinasi[] = [
                        'id'            => $w->id,
                        'nama'          => $w->nama,
                        'kategori'      => $w->kategori,
                        'latitude'      => (float) $w->latitude,
                        'longitude'     => (float) $w->longitude,
                        'jarak'         => round($jarak, 1),
                        'harga'         => (int) ($w->harga_tiket ?? 0),
                        'rating'        => (float) ($w->rating    ?? 0),
                        'gambar'        => $w->gambar    ?? '',
                        'deskripsi'     => $w->deskripsi ?? '',
                        'jam_buka'      => $w->jam_buka  ?? '',
                        'jam_tutup'     => $w->jam_tutup ?? '',
                        'fitness_score' => round($fitnessDasar * 100, 2),
                    ];
                }
            }
        }

        // Guard: minimal 1 destinasi
        if (empty($currentDestinasi)) {
            return redirect()->route('rekomendasi.hasil')
                ->with('error', 'Minimal 1 destinasi harus ada dalam itinerary.');
        }

        // ── FASE 3: Re-run PSO optimasi rute (TSP) ───────────
        $hasilRute        = $this->psoOptimasiRute($userLat, $userLng, $currentDestinasi, $lokasiNama);
        $hasilRekomendasi = collect($currentDestinasi)->sortByDesc('fitness_score')->values();

        // Perbarui session
        session()->put('pso_results', $hasilRekomendasi);
        session()->put('pso_rute',    $hasilRute);

        return redirect()->route('rekomendasi.hasil');
    }

    // =========================================================
    // HELPERS — Matematika & PSO Utilities
    // =========================================================

    private function haversine(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        $R    = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        $a    = sin($dLat / 2) ** 2
              + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng / 2) ** 2;
        return $R * 2 * atan2(sqrt($a), sqrt(1 - $a));
    }

    private function hitungBonusMinat(string $fasilitas, array $minat): float
    {
        $fas = strtolower($fasilitas);
        $minatKeywords = [
            'photography' => ['foto', 'selfie', 'instagramable', 'view'],
            'waterfalls'  => ['air terjun', 'curug', 'waterfall', 'coban'],
            'beaches'     => ['pantai', 'laut', 'pasir', 'sunset', 'ombak'],
            'caves'       => ['gua', 'goa', 'cave', 'stalaktit', 'karst'],
            'crafts'      => ['kerajinan', 'souvenir', 'batik', 'oleh'],
            'historical'  => ['sejarah', 'candi', 'makam', 'religi', 'ziarah', 'budaya', 'upacara'],
        ];

        $total = 0.0;
        foreach ($minat as $m) {
            $keywords = $minatKeywords[$m] ?? [strtolower($m)];
            foreach ($keywords as $kw) {
                if (str_contains($fas, $kw)) {
                    $total += 1;
                    break;
                }
            }
        }
        return $total;
    }

    private function hitungBonusCompanion(string $fasilitas, string $companion): float
    {
        $fas = strtolower($fasilitas);
        $map = [
            'keluarga'  => ['anak' => 1.0, 'bermain' => 1.0, 'parkir' => 0.5],
            'pasangan'  => ['foto' => 1.0, 'sunset'  => 1.0, 'gazebo' => 0.5],
            'teman'     => ['camping' => 1.0, 'outbound' => 1.0, 'tracking' => 0.5],
            'solo'      => ['tracking' => 1.0, 'hiking' => 1.0],
            'rombongan' => ['homestay' => 1.0, 'pertemuan' => 1.0, 'outbound' => 0.5],
        ];
        $bobotComp = $map[$companion] ?? $map['solo'];
        return (float) array_sum(array_map(
            fn($k, $v) => str_contains($fas, $k) ? $v : 0,
            array_keys($bobotComp), $bobotComp
        ));
    }

    private function fitnessCombination(array $posisi, array $daftarWisata): float
    {
        $total = 0;
        $valid = 0;
        foreach ($posisi as $idx) {
            if (isset($daftarWisata[$idx])) {
                $total += $daftarWisata[$idx]['fitness_dasar'];
                $valid++;
            }
        }
        return $valid > 0 ? $total / $valid : 0;
    }

    private function inisialisasiPosisi(
        array $daftarWisata, int $limit,
        array $wisataPerKategori, array $kategoriAda, int $n
    ): array {
        $posisi   = [];
        $terpilih = [];
        foreach ($kategoriAda as $kat) {
            if (count($posisi) >= $limit) break;
            $idxKat = $wisataPerKategori[$kat];
            usort($idxKat, fn($a, $b) =>
                $daftarWisata[$b]['fitness_dasar'] <=> $daftarWisata[$a]['fitness_dasar']
            );
            $pool    = array_slice($idxKat, 0, min(3, count($idxKat)));
            $pilihan = $pool[array_rand($pool)];
            if (!in_array($pilihan, $terpilih)) {
                $posisi[]   = $pilihan;
                $terpilih[] = $pilihan;
            }
        }
        $acak = range(0, $n - 1);
        shuffle($acak);
        foreach ($acak as $idx) {
            if (count($posisi) >= $limit) break;
            if (!in_array($idx, $terpilih)) {
                $posisi[]   = $idx;
                $terpilih[] = $idx;
            }
        }
        return $posisi;
    }

    private function perbaikiPosisi(
        array $posisi, int $limit, array $daftarWisata,
        array $wisataPerKategori, array $kategoriAda, int $n
    ): array {
        $posisi    = array_values(array_unique($posisi));
        $terwakili = [];
        foreach ($posisi as $idx) {
            if (isset($daftarWisata[$idx])) {
                $terwakili[$daftarWisata[$idx]['kategori']] = true;
            }
        }
        foreach (array_diff($kategoriAda, array_keys($terwakili)) as $kat) {
            $kandidat = array_diff($wisataPerKategori[$kat], $posisi);
            if (empty($kandidat)) continue;
            usort($kandidat, fn($a, $b) =>
                $daftarWisata[$b]['fitness_dasar'] <=> $daftarWisata[$a]['fitness_dasar']
            );
            $baru = reset($kandidat);
            if (count($posisi) >= $limit) {
                $diganti = false;
                for ($i = count($posisi) - 1; $i >= 0; $i--) {
                    $katSlot  = $daftarWisata[$posisi[$i]]['kategori'] ?? null;
                    $jmlWakil = count(array_filter(
                        $posisi,
                        fn($ix) => isset($daftarWisata[$ix]) && $daftarWisata[$ix]['kategori'] === $katSlot
                    ));
                    if ($jmlWakil > 1) {
                        $posisi[$i] = $baru;
                        $diganti    = true;
                        break;
                    }
                }
                if (!$diganti) {
                    $posisi[count($posisi) - 1] = $baru;
                }
            } else {
                $posisi[] = $baru;
            }
        }
        if (count($posisi) < $limit) {
            $acak = range(0, $n - 1);
            shuffle($acak);
            foreach ($acak as $idx) {
                if (count($posisi) >= $limit) break;
                if (!in_array($idx, $posisi)) $posisi[] = $idx;
            }
        }
        return array_slice(array_values($posisi), 0, $limit);
    }

    private function nearestNeighborSeed(array $indeks, array $mj): array
    {
        $belum = $indeks;
        $rute  = [];
        $cur   = 0;
        while (!empty($belum)) {
            $terdekat = null;
            $min      = PHP_FLOAT_MAX;
            foreach ($belum as $idx) {
                if ($mj[$cur][$idx] < $min) {
                    $min      = $mj[$cur][$idx];
                    $terdekat = $idx;
                }
            }
            $rute[] = $terdekat;
            $cur    = $terdekat;
            $belum  = array_values(array_diff($belum, [$terdekat]));
        }
        return $rute;
    }

    private function randomSwaps(int $n): array
    {
        $swaps = [];
        for ($k = 0; $k < max(1, (int)($n / 2)); $k++) {
            $swaps[] = [mt_rand(0, $n - 1), mt_rand(0, $n - 1)];
        }
        return $swaps;
    }

    private function scaleSwaps(array $swaps, float $prob): array
    {
        return array_values(array_filter(
            $swaps,
            fn() => (mt_rand() / mt_getrandmax()) < $prob
        ));
    }

    private function permDiff(array $a, array $b, float $c): array
    {
        $swaps = [];
        $temp  = $a;
        $n     = count($a);
        for ($i = 0; $i < $n; $i++) {
            if ($temp[$i] !== $b[$i]) {
                $j = array_search($b[$i], $temp);
                if ($j !== false && (mt_rand() / mt_getrandmax()) < $c / 2) {
                    $swaps[]               = [$i, $j];
                    [$temp[$i], $temp[$j]] = [$temp[$j], $temp[$i]];
                }
            }
        }
        return $swaps;
    }

    private function perbaikiPermutasi(array $perm, array $indeksAsli): array
    {
        $n       = count($indeksAsli);
        $seen    = [];
        $missing = [];
        $result  = array_slice($perm, 0, $n);

        foreach ($indeksAsli as $v) {
            if (!in_array($v, $result)) $missing[] = $v;
        }
        $mIdx = 0;
        for ($i = 0; $i < count($result); $i++) {
            if (!in_array($result[$i], $indeksAsli) || in_array($result[$i], $seen)) {
                if ($mIdx < count($missing)) $result[$i] = $missing[$mIdx++];
            } else {
                $seen[] = $result[$i];
            }
        }
        return $result;
    }
}