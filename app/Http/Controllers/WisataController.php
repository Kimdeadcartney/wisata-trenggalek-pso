<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    /**
     * Menampilkan halaman home dengan destinasi random
     */
    public function index(Request $request)
    {
        // 1. Memulai Query dengan hitung review
        $query = Destinasi::withCount('reviews');

        // 2. Fitur Pencarian (Search)
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('kategori', 'like', '%' . $request->search . '%')
                  ->orWhere('kecamatan', 'like', '%' . $request->search . '%');
            });
        }

        // 3. Fitur Filter Kategori
        if ($request->has('kategori') && !empty($request->kategori)) {
            $query->whereIn('kategori', (array)$request->kategori);
        }

        // 4. Fitur Filter Kecamatan (DIUBAH agar menangkap input 'lokasi')
        if ($request->has('lokasi') && !empty($request->lokasi)) {
            // Kita mengambil input 'lokasi' dari Blade, lalu mencocokkan ke kolom 'kecamatan' di DB
            $query->whereIn('kecamatan', (array)$request->lokasi);
        }

        // 5. Eksekusi Query berdasarkan Route
        if ($request->routeIs('home')) {
            // TAMPILKAN 5 SAJA & BERUBAH-UBAH (RANDOM)
            $wisata = $query->inRandomOrder()->take(5)->get(); 
            return view('welcome', compact('wisata'));
        }

        // Fitur Sorting (Hanya untuk halaman destinasi)
        $sort = $request->input('sort');
        switch ($sort) {
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'az':
                $query->orderBy('nama', 'asc');
                break;
            case 'za':
                $query->orderBy('nama', 'desc');
                break;
            case 'popularitas':
            default:
                $query->orderBy('reviews_count', 'desc'); 
                break;
        }

        // Menggunakan appends agar filter tidak hilang saat pindah halaman (pagination)
        $wisata = $query->paginate(9)->appends($request->all());
        
        return view('destinasi.destinasi', compact('wisata'));
    }

    /**
     * Menampilkan detail destinasi tunggal
     */
    public function show($id)
    {
        $destinasi = Destinasi::with(['reviews.user'])->findOrFail($id);
        
        $destinasiLain = Destinasi::where('id', '!=', $id)
            ->where('kecamatan', $destinasi->kecamatan)
            ->limit(4)
            ->get();

        if ($destinasiLain->isEmpty()) {
            $destinasiLain = Destinasi::where('id', '!=', $id)->limit(4)->get();
        }

        return view('destinasi.show', compact('destinasi', 'destinasiLain'));
    }

    /**
     * Menampilkan halaman tentang Trenggalek dengan data Budaya dan Kuliner
     */
    public function about()
    {
        // Ambil data budaya dari kategori "Budaya" - maksimal 3 item
        $budaya = Destinasi::where('kategori', 'Budaya')
            ->limit(3)
            ->get();
        
        // Ambil data kuliner dari kategori "Kuliner" - maksimal 3 item
        $kuliner = Destinasi::where('kategori', 'Kuliner')
            ->limit(3)
            ->get();

        return view('about', compact('budaya', 'kuliner'));
    }
}