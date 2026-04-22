<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Wisata; // Pastikan model Wisata sudah ada

class PsoController extends Controller
{
    public function index()
    {
        return view('pso.form');
    }

    public function proses(Request $request)
    {
        // 1. Ambil Parameter PSO
        $jumlahPartikel = $request->partikel ?? 10;
        $maxIterasi     = $request->iterasi ?? 5;
        $w  = $request->w  ?? 0.5;
        $c1 = $request->c1 ?? 1.5;
        $c2 = $request->c2 ?? 1.5;

        // 2. Ambil Data Wisata dari Database
        // $daftarWisata = Wisata::all(); 
        
        // Contoh Data Dummy (Hapus ini jika sudah pakai database)
        $daftarWisata = [
            ['id' => 1, 'nama' => 'Pantai Prigi', 'jarak' => 40, 'rating' => 4.5],
            ['id' => 2, 'nama' => 'Goa Lowo', 'jarak' => 25, 'rating' => 4.2],
            ['id' => 3, 'nama' => 'Pantai Pelang', 'jarak' => 55, 'rating' => 4.7],
        ];

        // 3. Jalankan Logika PSO (Sederhana)
        $results = [];
        foreach ($daftarWisata as $wisata) {
            // Rumus Fitness Sederhana (contoh: Rating tinggi & Jarak dekat lebih bagus)
            // Dalam PSO asli, ini dihitung berkali-kali dalam iterasi
            $fitness_score = ($wisata['rating'] * 20) - ($wisata['jarak'] * 0.1); 
            
            $results[] = [
                'nama' => $wisata['nama'],
                'jarak' => $wisata['jarak'],
                'fitness_score' => max(0, min(100, $fitness_score)), // Batasi 0-100
                'rating' => $wisata['rating']
            ];
        }

        // Urutkan berdasarkan fitness tertinggi
        usort($results, function($a, $b) {
            return $b['fitness_score'] <=> $a['fitness_score'];
        });

        // 4. Kirim ke View
        return view('pso.hasil', compact(
            'results', // INI YANG PENTING AGAR HASIL MUNCUL
            'jumlahPartikel',
            'maxIterasi',
            'w',
            'c1',
            'c2'
        ));
    }
}