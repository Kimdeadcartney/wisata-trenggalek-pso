<?php

namespace App\Services;

class NearestNeighborService
{
    // =========================================================
    // ENTRY POINT UTAMA
    // Panggil method ini dari RekomendasiController
    // =========================================================

    /**
     * Jalankan Nearest Neighbor dan kembalikan hasil + komparasi.
     *
     * Contoh pemanggilan di RekomendasiController:
     *
     *   use App\Services\NearestNeighborService;
     *
     *   $nn        = new NearestNeighborService();
     *   $hasilNN   = $nn->jalankan($userLat, $userLng, $destinasiTerpilih, $lokasiNama);
     *   $komparasi = $nn->komparasi($hasilRute['total_jarak'], $hasilNN['total_jarak']);
     */
    public function jalankan(
        float  $userLat,
        float  $userLng,
        array  $destinasi,
        string $lokasiNama
    ): array {
        $jumlah = count($destinasi);

        if ($jumlah === 0) {
            return ['urutan_rute' => [], 'total_jarak' => 0, 'detail' => []];
        }

        // Bangun array titik:
        // index 0       = lokasi user
        // index 1 .. n  = destinasi pilihan
        $titik  = $this->buildTitik($userLat, $userLng, $destinasi, $lokasiNama);
        $nTitik = count($titik);

        // Pre-compute matriks jarak (Haversine)
        $mj = $this->buildMatriksJarak($titik, $nTitik);

        // Jalankan algoritma Nearest Neighbor
        $indeksAsli      = range(1, $jumlah);
        $belumDikunjungi = $indeksAsli;
        $urutanIndex     = [];
        $detail          = [];
        $totalJarak      = 0;
        $cur             = 0; // mulai dari lokasi user

        while (!empty($belumDikunjungi)) {
            [$terdekat, $jarakMin] = $this->cariTerdekat($cur, $belumDikunjungi, $mj);

            $detail[] = [
                'dari'  => $titik[$cur]['nama'],
                'ke'    => $titik[$terdekat]['nama'],
                'jarak' => round($jarakMin, 2),
            ];

            $urutanIndex[]   = $terdekat;
            $totalJarak     += $jarakMin;
            $cur             = $terdekat;
            $belumDikunjungi = array_values(array_diff($belumDikunjungi, [$terdekat]));
        }

        // Kembali ke titik awal — closed tour (sama seperti PSO)
        $jarakKembali = $mj[$cur][0];
        $totalJarak  += $jarakKembali;
        $detail[]     = [
            'dari'  => $titik[$cur]['nama'],
            'ke'    => $lokasiNama . ' (Kembali)',
            'jarak' => round($jarakKembali, 2),
        ];

        // Susun urutan rute — format sama dengan PSO agar mudah dibandingkan
        $urutanRute = $this->buildUrutanRute(
            $urutanIndex, $destinasi, $titik, $mj,
            $userLat, $userLng, $lokasiNama, $jumlah
        );

        return [
            'urutan_rute' => $urutanRute,
            'total_jarak' => round($totalJarak, 2),
            'detail'      => $detail,
        ];
    }

    // =========================================================
    // KOMPARASI PSO vs NEAREST NEIGHBOR
    // =========================================================

    /**
     * Hitung perbandingan jarak PSO vs Nearest Neighbor.
     *
     * @param  float $jarakPSO  Total jarak hasil PSO (km)
     * @param  float $jarakNN   Total jarak hasil Nearest Neighbor (km)
     * @return array
     */
    public function komparasi(float $jarakPSO, float $jarakNN): array
    {
        $selisih   = round($jarakNN - $jarakPSO, 2);
        $efisiensi = $jarakNN > 0
            ? round(($selisih / $jarakNN) * 100, 2)
            : 0;

        return [
            'jarak_pso'        => $jarakPSO,
            'jarak_nn'         => $jarakNN,
            'selisih_km'       => $selisih,
            'efisiensi_persen' => $efisiensi,
            'pso_lebih_baik'   => $jarakPSO < $jarakNN,
        ];
    }

    // =========================================================
    // PRIVATE HELPERS
    // =========================================================

    private function buildTitik(
        float $userLat, float $userLng,
        array $destinasi, string $lokasiNama
    ): array {
        return array_merge(
            [['nama' => $lokasiNama, 'latitude' => $userLat, 'longitude' => $userLng]],
            array_map(fn($d) => [
                'nama'      => $d['nama'],
                'latitude'  => $d['latitude'],
                'longitude' => $d['longitude'],
            ], $destinasi)
        );
    }

    private function buildMatriksJarak(array $titik, int $nTitik): array
    {
        $mj = [];
        for ($i = 0; $i < $nTitik; $i++) {
            for ($j = 0; $j < $nTitik; $j++) {
                $mj[$i][$j] = $i === $j ? 0 : $this->haversine(
                    $titik[$i]['latitude'], $titik[$i]['longitude'],
                    $titik[$j]['latitude'], $titik[$j]['longitude']
                );
            }
        }
        return $mj;
    }

    private function cariTerdekat(int $cur, array $belum, array $mj): array
    {
        $terdekat = null;
        $jarakMin = PHP_FLOAT_MAX;
        foreach ($belum as $idx) {
            if ($mj[$cur][$idx] < $jarakMin) {
                $jarakMin = $mj[$cur][$idx];
                $terdekat = $idx;
            }
        }
        return [$terdekat, $jarakMin];
    }

    private function buildUrutanRute(
        array $urutanIndex, array $destinasi,
        array $titik, array $mj,
        float $userLat, float $userLng,
        string $lokasiNama, int $jumlah
    ): array {
        $rute   = [];
        $rute[] = [
            'urutan'           => 0,
            'nama'             => $lokasiNama,
            'tipe'             => 'asal',
            'latitude'         => $userLat,
            'longitude'        => $userLng,
            'jarak_ke_berikut' => round($mj[0][$urutanIndex[0]], 2),
        ];

        foreach ($urutanIndex as $urutan => $titikIdx) {
            $dest    = $destinasi[$titikIdx - 1];
            $berikut = isset($urutanIndex[$urutan + 1])
                ? $mj[$titikIdx][$urutanIndex[$urutan + 1]]
                : $mj[$titikIdx][0];

            $rute[] = [
                'urutan'           => $urutan + 1,
                'id'               => $dest['id'],
                'nama'             => $dest['nama'],
                'tipe'             => 'destinasi',
                'latitude'         => $dest['latitude'],
                'longitude'        => $dest['longitude'],
                'jarak_ke_berikut' => round($berikut, 2),
            ];
        }

        $rute[] = [
            'urutan'           => $jumlah + 1,
            'nama'             => $lokasiNama . ' (Kembali)',
            'tipe'             => 'kembali',
            'latitude'         => $userLat,
            'longitude'        => $userLng,
            'jarak_ke_berikut' => 0,
        ];

        return $rute;
    }

    private function haversine(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        $R    = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        $a    = sin($dLat / 2) ** 2
              + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng / 2) ** 2;
        return $R * 2 * atan2(sqrt($a), sqrt(1 - $a));
    }
}