<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Menyimpan review baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'wisata_id' => 'required',
            'comment' => 'required|min:5|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ], [
            'comment.required' => 'Komentar tidak boleh kosong.',
            'comment.min' => 'Komentar minimal 5 karakter.',
            'rating.required' => 'Silakan pilih rating.',
        ]);

        // 2. Simpan data ke tabel reviews
        Review::create([
            'user_id' => Auth::id(), // Mengambil ID user yang sedang login via Google/Manual
            'wisata_id' => $request->wisata_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        // 3. Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Review Anda berhasil dikirim!');
    }
}