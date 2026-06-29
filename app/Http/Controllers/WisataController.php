<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Services\PsoStorageService;
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

        // 4. Fitur Filter Kecamatan
        if ($request->has('lokasi') && !empty($request->lokasi)) {
            $query->whereIn('kecamatan', (array)$request->lokasi);
        }

        // 5. Eksekusi Query berdasarkan Route
        if ($request->routeIs('home')) {
            $wisata = $query->inRandomOrder()->take(5)->get();

            // Jika session PSO kosong (expired), coba restore dari database
            // supaya banner "Rute Saya" tetap muncul di home
            $hasPso = session()->has('pso_results')
                   && session('pso_results') !== null
                   && count(session('pso_results')) > 0;

            if (!$hasPso) {
                PsoStorageService::restoreToSession();
            }

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
        $budaya = Destinasi::where('kategori', 'Budaya')->limit(3)->get();
        $kuliner = Destinasi::where('kategori', 'Kuliner')->limit(3)->get();

        return view('about', compact('budaya', 'kuliner'));
    }
}
