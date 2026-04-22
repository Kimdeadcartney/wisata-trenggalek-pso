<?php

namespace App\Http\Controllers;

use App\Models\Destinasi; // Menggunakan Destinasi sesuai model terbaru Anda
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function index(Request $request)
    {
        // 1. Memulai Query dengan withCount('reviews') 
        // Ini akan menambahkan kolom virtual 'reviews_count' secara otomatis
        $query = Destinasi::withCount('reviews');

        // 2. Fitur Pencarian (Search)
        if ($request->has('search') && !empty($request->search)) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // 3. Fitur Filter Kategori
        if ($request->has('kategori') && !empty($request->kategori)) {
            $query->whereIn('kategori', $request->kategori);
        }

        // 4. Fitur Filter Kecamatan
        if ($request->has('kecamatan') && !empty($request->kecamatan)) {
            $query->whereIn('kecamatan', $request->kecamatan);
        }

        // 5. Fitur Sorting (Urutkan)
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
                // Sekarang Anda bisa mengurutkan berdasarkan jumlah review terbanyak
                $query->orderBy('reviews_count', 'desc'); 
                break;
        }

        // 6. Eksekusi Query dengan Pagination
        $wisata = $query->paginate(9);

        return view('destinasi.destinasi', compact('wisata'));
    }

    /**
     * Menampilkan detail destinasi tunggal
     */
    public function show($id)
    {
        // Eager loading reviews dan user-nya
        $destinasi = Destinasi::with(['reviews.user'])->findOrFail($id);
        
        // Mengambil 4 destinasi lain untuk "Nearby Treasures"
        $destinasiLain = Destinasi::where('id', '!=', $id)
            ->where('kecamatan', $destinasi->kecamatan)
            ->limit(4)
            ->get();

        if ($destinasiLain->isEmpty()) {
            $destinasiLain = Destinasi::where('id', '!=', $id)->limit(4)->get();
        }

        return view('destinasi.show', compact('destinasi', 'destinasiLain'));
    }
}