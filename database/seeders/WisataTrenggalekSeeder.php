<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wisata;

class WisataTrenggalekSeeder extends Seeder
{
    public function run()
    {
        Wisata::truncate();

        $data = [

            // ================= WISATA ALAM =================
            [
                'nama'=>'Pantai Prigi',
                'kategori'=>'Pantai',
                'latitude'=>-8.2828,
                'longitude'=>111.7289,
                'harga_tiket'=>10000,
                'rating'=>4.6,
                'fasilitas'=>'Pantai, kuliner, taman, parkir',
                'hotel_terdekat'=>'Hotel Prigi, Pondok Prigi Cottage',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Pantai Prigi terletak di Desa Tasikmadu, Watulimo. Pantai ini menjadi ikon wisata dengan fasilitas lengkap, area bermain, dan pusat kuliner laut.' // hal 5
            ],

            [
                'nama'=>'Pantai Kuyon',
                'kategori'=>'Pantai',
                'latitude'=>-8.3050,
                'longitude'=>111.6030,
                'harga_tiket'=>5000,
                'rating'=>4.5,
                'fasilitas'=>'Pantai alami, perahu, wisata desa',
                'hotel_terdekat'=>'Hotel Ratu Panggul',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Pantai Kuyon berada di Desa Nglebeng, wisata desa dengan pengalaman nelayan, memasak ikan segar, dan menikmati laut alami.' // hal 6
            ],

            [
                'nama'=>'Pantai Pasir Putih Karanggongso',
                'kategori'=>'Pantai',
                'latitude'=>-8.2863,
                'longitude'=>111.7225,
                'harga_tiket'=>15000,
                'rating'=>4.8,
                'fasilitas'=>'Banana boat, snorkeling, pasir putih',
                'hotel_terdekat'=>'Hotel Prigi',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Pantai pasir putih dengan air jernih dan berbagai wahana seperti banana boat dan snorkeling.' // hal 6
            ],

            [
                'nama'=>'Pantai Mutiara',
                'kategori'=>'Pantai',
                'latitude'=>-8.2870,
                'longitude'=>111.7350,
                'harga_tiket'=>10000,
                'rating'=>4.7,
                'fasilitas'=>'Snorkeling, paddling, gazebo',
                'hotel_terdekat'=>'Hotel Prigi',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Pantai Mutiara berada dekat Karanggongso, cocok untuk wisata air dan menikmati suasana tenang.' // hal 7
            ],

            [
                'nama'=>'Hutan Mangrove Cengkrong',
                'kategori'=>'Hutan',
                'latitude'=>-8.2750,
                'longitude'=>111.7150,
                'harga_tiket'=>10000,
                'rating'=>4.6,
                'fasilitas'=>'Tracking, perahu, edukasi',
                'hotel_terdekat'=>'Hotel Prigi',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Hutan mangrove dengan jalur kayu dan wisata edukasi ekosistem pesisir.' // hal 8
            ],

            [
                'nama'=>'Goa Lowo',
                'kategori'=>'Goa',
                'latitude'=>-8.2435,
                'longitude'=>111.7210,
                'harga_tiket'=>10000,
                'rating'=>4.7,
                'fasilitas'=>'Goa, lampu, pemandu',
                'hotel_terdekat'=>'Hotel Prigi',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Goa Lowo merupakan goa terbesar di Asia Tenggara dengan stalaktit dan stalagmit unik.' // hal 10
            ],

            [
                'nama'=>'Tebing Lingga',
                'kategori'=>'Alam',
                'latitude'=>-8.10,
                'longitude'=>111.80,
                'harga_tiket'=>10000,
                'rating'=>4.6,
                'fasilitas'=>'Camping, panjat tebing',
                'hotel_terdekat'=>'Hotel Hayam Wuruk',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Wisata tebing dengan panorama alam dan aktivitas outdoor seperti camping dan panjat tebing.' // hal 11
            ],

            [
                'nama'=>'Ngerit Stone Park',
                'kategori'=>'Alam',
                'latitude'=>-8.12,
                'longitude'=>111.65,
                'harga_tiket'=>10000,
                'rating'=>4.5,
                'fasilitas'=>'Batu alam, sungai',
                'hotel_terdekat'=>'Hotel Hayam Wuruk',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Wisata batu alam dan sungai dengan pemandangan eksotis.' // hal 12
            ],

            [
                'nama'=>'Pantai Kili Kili',
                'kategori'=>'Pantai',
                'latitude'=>-8.36,
                'longitude'=>111.58,
                'harga_tiket'=>5000,
                'rating'=>4.7,
                'fasilitas'=>'Konservasi penyu',
                'hotel_terdekat'=>'Hotel Ratu Panggul',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Pantai konservasi penyu dengan panorama indah.' // hal 13
            ],

            [
                'nama'=>'Pantai Pelang',
                'kategori'=>'Pantai',
                'latitude'=>-8.27,
                'longitude'=>111.51,
                'harga_tiket'=>8000,
                'rating'=>4.6,
                'fasilitas'=>'Air terjun, pantai',
                'hotel_terdekat'=>'Hotel Ratu Panggul',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Pantai dengan air terjun alami yang unik.' // hal 14
            ],

            [
                'nama'=>'Pantai Damas',
                'kategori'=>'Pantai',
                'latitude'=>-8.31,
                'longitude'=>111.69,
                'harga_tiket'=>5000,
                'rating'=>4.5,
                'fasilitas'=>'Pantai alami, nelayan',
                'hotel_terdekat'=>'Hotel Prigi',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Pantai alami dengan suasana tenang dan aktivitas nelayan.' // hal 17
            ],

            [
                'nama'=>'Bukit Paralayang Tunggangan',
                'kategori'=>'Bukit',
                'latitude'=>-8.10,
                'longitude'=>111.83,
                'harga_tiket'=>5000,
                'rating'=>4.8,
                'fasilitas'=>'Paralayang, camping',
                'hotel_terdekat'=>'Hotel Hayam Wuruk',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Spot paralayang dengan panorama indah.' // hal 18
            ],

            [
                'nama'=>'Bukit Banyon',
                'kategori'=>'Bukit',
                'latitude'=>-8.08,
                'longitude'=>111.76,
                'harga_tiket'=>5000,
                'rating'=>4.8,
                'fasilitas'=>'Sunrise, camping',
                'hotel_terdekat'=>'Hotel Hayam Wuruk',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Bukit terkenal dengan pemandangan negeri di atas awan.' // hal 19
            ],

            [
                'nama'=>'Pantai Rajaan',
                'kategori'=>'Pantai',
                'latitude'=>-8.41,
                'longitude'=>111.52,
                'harga_tiket'=>5000,
                'rating'=>4.4,
                'fasilitas'=>'Karang, sunset',
                'hotel_terdekat'=>'Hotel Ratu Panggul',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Pantai karang dengan pemandangan eksotis.' // hal 21
            ],

            [
                'nama'=>'Pantai Konang',
                'kategori'=>'Pantai',
                'latitude'=>-8.34,
                'longitude'=>111.61,
                'harga_tiket'=>5000,
                'rating'=>4.6,
                'fasilitas'=>'Kuliner, pasir luas',
                'hotel_terdekat'=>'Hotel Ratu Panggul',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Pantai luas dengan aktivitas kuliner.' // hal 23
            ],

            [
                'nama'=>'Coban Wonoasri',
                'kategori'=>'Air Terjun',
                'latitude'=>-8.50,
                'longitude'=>111.47,
                'harga_tiket'=>5000,
                'rating'=>4.6,
                'fasilitas'=>'Air terjun, tracking',
                'hotel_terdekat'=>'Omah Blado Resort',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Air terjun alami di tengah hutan.' // hal 24
            ],

            [
                'nama'=>'Pantai Kebo',
                'kategori'=>'Pantai',
                'latitude'=>-8.43,
                'longitude'=>111.51,
                'harga_tiket'=>5000,
                'rating'=>4.5,
                'fasilitas'=>'Laguna, perahu',
                'hotel_terdekat'=>'Omah Blado Resort',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Pantai dengan laguna alami.' // hal 24
            ],

            [
                'nama'=>'Pantai Blado',
                'kategori'=>'Pantai',
                'latitude'=>-8.45,
                'longitude'=>111.50,
                'harga_tiket'=>5000,
                'rating'=>4.4,
                'fasilitas'=>'Pantai panjang',
                'hotel_terdekat'=>'Omah Blado Resort',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Pantai panjang dengan suasana alami.' // hal 25
            ],

            [
                'nama'=>'Pantai Ngampiran',
                'kategori'=>'Pantai',
                'latitude'=>-8.47,
                'longitude'=>111.49,
                'harga_tiket'=>5000,
                'rating'=>4.4,
                'fasilitas'=>'Pantai alami',
                'hotel_terdekat'=>'Omah Blado Resort',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Pantai tersembunyi dengan suasana sepi.' // hal 25
            ],

            // ================= HOTEL =================
            [
                'nama'=>'Hotel Prigi',
                'kategori'=>'Hotel',
                'latitude'=>-8.283,
                'longitude'=>111.728,
                'harga_tiket'=>0,
                'rating'=>4.5,
                'fasilitas'=>'AC, TV, restoran',
                'hotel_terdekat'=>'-',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Hotel dekat Pantai Prigi dengan fasilitas lengkap.' // tabel hotel
            ],

            [
                'nama'=>'Hotel Hayam Wuruk',
                'kategori'=>'Hotel',
                'latitude'=>-8.058,
                'longitude'=>111.712,
                'harga_tiket'=>0,
                'rating'=>4.5,
                'fasilitas'=>'AC, restoran, parkir',
                'hotel_terdekat'=>'-',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Hotel pusat kota Trenggalek.' // tabel hotel
            ],

            [
                'nama'=>'Hotel Atriaz',
                'kategori'=>'Hotel',
                'latitude'=>-8.06,
                'longitude'=>111.71,
                'harga_tiket'=>0,
                'rating'=>4.4,
                'fasilitas'=>'WiFi, kamar',
                'hotel_terdekat'=>'-',
                'gambar'=>'default.jpg',
                'deskripsi'=>'Hotel strategis dengan fasilitas lengkap.' // tabel hotel
            ],

            // ================= KULINER =================
[
    'nama' => 'Bu Sini',
    'kategori' => 'Kuliner',
    'latitude' => -8.0580,
    'longitude' => 111.7130,
    'harga_tiket' => 0,
    'rating' => 4.5,
    'fasilitas' => 'Nasi Pecel, makan pagi, makan siang',
    'hotel_terdekat' => 'Hotel Hayam Wuruk, Hotel Atriaz',
    'gambar' => 'default.jpg',
    'deskripsi' => 'Rumah makan Bu Sini berada di Jalan Panglima Sudirman dan terkenal dengan menu nasi pecel.' // tabel kuliner PDF
],

[
    'nama' => 'Warung Mbah Sul',
    'kategori' => 'Kuliner',
    'latitude' => -8.0600,
    'longitude' => 111.7150,
    'harga_tiket' => 0,
    'rating' => 4.4,
    'fasilitas' => 'Nasi Pecel, tradisional',
    'hotel_terdekat' => 'Hotel Hayam Wuruk',
    'gambar' => 'default.jpg',
    'deskripsi' => 'Warung makan tradisional dengan menu nasi pecel khas Trenggalek.' // tabel kuliner PDF
],

[
    'nama' => 'Mekar Sari',
    'kategori' => 'Kuliner',
    'latitude' => -8.0570,
    'longitude' => 111.7120,
    'harga_tiket' => 0,
    'rating' => 4.5,
    'fasilitas' => 'Sop Buntut, makan siang',
    'hotel_terdekat' => 'Hotel Hayam Wuruk, Hotel Atriaz',
    'gambar' => 'default.jpg',
    'deskripsi' => 'Rumah makan Mekar Sari terkenal dengan sop buntut dan menu keluarga.' // tabel kuliner PDF
],

[
    'nama' => 'Ayam Goreng Jogja',
    'kategori' => 'Kuliner',
    'latitude' => -8.0565,
    'longitude' => 111.7142,
    'harga_tiket' => 0,
    'rating' => 4.6,
    'fasilitas' => 'Ayam Goreng, makan malam',
    'hotel_terdekat' => 'Hotel Hayam Wuruk',
    'gambar' => 'default.jpg',
    'deskripsi' => 'Tempat makan favorit dengan menu ayam goreng renyah.' // tabel kuliner PDF
],

[
    'nama' => 'Madona',
    'kategori' => 'Kuliner',
    'latitude' => -8.0610,
    'longitude' => 111.7100,
    'harga_tiket' => 0,
    'rating' => 4.4,
    'fasilitas' => 'Pindang Sapi',
    'hotel_terdekat' => 'Hotel Atriaz',
    'gambar' => 'default.jpg',
    'deskripsi' => 'Warung makan Madona dikenal dengan pindang sapi khas daerah.' // tabel kuliner PDF
],

[
    'nama' => 'Pak Usup',
    'kategori' => 'Kuliner',
    'latitude' => -8.0630,
    'longitude' => 111.7180,
    'harga_tiket' => 0,
    'rating' => 4.3,
    'fasilitas' => 'Ayam Lodho',
    'hotel_terdekat' => 'Hotel Widoyah',
    'gambar' => 'default.jpg',
    'deskripsi' => 'Kuliner khas ayam lodho dengan cita rasa pedas gurih.' // tabel kuliner PDF
],

[
    'nama' => 'Arimbi',
    'kategori' => 'Kuliner',
    'latitude' => -8.0625,
    'longitude' => 111.7165,
    'harga_tiket' => 0,
    'rating' => 4.4,
    'fasilitas' => 'Aneka Menu',
    'hotel_terdekat' => 'Hotel Widoyah',
    'gambar' => 'default.jpg',
    'deskripsi' => 'Rumah makan keluarga dengan berbagai pilihan menu.' // tabel kuliner PDF
],

[
    'nama' => 'Warung Malidi',
    'kategori' => 'Kuliner',
    'latitude' => -8.0640,
    'longitude' => 111.7190,
    'harga_tiket' => 0,
    'rating' => 4.2,
    'fasilitas' => 'Nasi Pecel',
    'hotel_terdekat' => 'Hotel Widoyah',
    'gambar' => 'default.jpg',
    'deskripsi' => 'Warung sederhana dengan nasi pecel favorit warga lokal.' // tabel kuliner PDF
],

[
    'nama' => 'Mbah Temin',
    'kategori' => 'Kuliner',
    'latitude' => -8.0585,
    'longitude' => 111.7110,
    'harga_tiket' => 0,
    'rating' => 4.3,
    'fasilitas' => 'Gurami Bakar',
    'hotel_terdekat' => 'Hotel Hayam Wuruk',
    'gambar' => 'default.jpg',
    'deskripsi' => 'Tempat makan dengan menu andalan gurami bakar.' // tabel kuliner PDF
],

[
    'nama' => 'Bojana Rasa',
    'kategori' => 'Kuliner',
    'latitude' => -8.0555,
    'longitude' => 111.7135,
    'harga_tiket' => 0,
    'rating' => 4.4,
    'fasilitas' => 'Ayam Lodho',
    'hotel_terdekat' => 'Hotel Hayam Wuruk',
    'gambar' => 'default.jpg',
    'deskripsi' => 'Rumah makan terkenal dengan menu ayam lodho khas Jawa Timur.' // tabel kuliner PDF
],
        ];

        foreach ($data as $item) {
            Wisata::create($item);
        }
    }
}