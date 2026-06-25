<?php

namespace App\Http\Controllers;

use App\Models\Wisata;

class AboutController extends Controller
{
    public function index()
    {
        $budaya = Wisata::where('kategori', 'Budaya')->get();
        $kuliner = Wisata::where('kategori', 'Kuliner')->get();

        return view('about', compact('budaya', 'kuliner'));
    }
}