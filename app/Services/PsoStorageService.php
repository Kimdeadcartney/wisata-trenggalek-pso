<?php

namespace App\Services;

use App\Models\PsoSavedRoute;
use Illuminate\Support\Facades\Auth;

/**
 * PsoStorageService
 *
 * Menyimpan hasil PSO ke tabel pso_saved_routes (MySQL) agar data
 * tetap ada walaupun user pindah halaman atau session expire.
 * Data hanya dihapus saat user menekan "Reset Rute" (langkah 1).
 *
 * Key strategy:
 *  - User login  → "user_{id}"        (permanen, tidak terpengaruh session)
 *  - Guest       → "sess_{session_id}" (bertahan selama cookie ada)
 */
class PsoStorageService
{
    /**
     * Key unik per user/browser.
     */
    public static function getKey(): string
    {
        if (Auth::check()) {
            return 'user_' . Auth::id();
        }

        // Untuk guest, simpan key di session supaya konsisten
        // meski session_id() tidak berubah setelah regenerate pada guest
        if (!session()->has('_pso_storage_key')) {
            session()->put('_pso_storage_key', 'sess_' . session()->getId());
        }

        return session('_pso_storage_key');
    }

    /**
     * Simpan hasil PSO ke database.
     */
    public static function save(
        array $psoData,
              $psoResults,   // Collection atau array
        array $psoRute,
        array $psoMeta
    ): void {
        $key = self::getKey();

        if ($psoResults instanceof \Illuminate\Support\Collection) {
            $psoResults = $psoResults->values()->toArray();
        }

        PsoSavedRoute::updateOrCreate(
            ['session_key' => $key],
            [
                'pso_data'    => $psoData,
                'pso_results' => $psoResults,
                'pso_rute'    => $psoRute,
                'pso_meta'    => $psoMeta,
            ]
        );
    }

    /**
     * Ambil record tersimpan.
     */
    public static function load(): ?PsoSavedRoute
    {
        return PsoSavedRoute::where('session_key', self::getKey())->first();
    }

    /**
     * Hapus data (Reset Rute).
     */
    public static function clear(): void
    {
        PsoSavedRoute::where('session_key', self::getKey())->delete();
    }

    /**
     * Restore dari DB ke session Laravel.
     * Dipanggil di controller bila session kosong tapi DB masih punya data.
     */
    public static function restoreToSession(): bool
    {
        $saved = self::load();
        if (!$saved) return false;

        if ($saved->pso_data)    session()->put('pso_data',    $saved->pso_data);
        if ($saved->pso_results) session()->put('pso_results', collect($saved->pso_results));
        if ($saved->pso_rute)    session()->put('pso_rute',    $saved->pso_rute);
        if ($saved->pso_meta)    session()->put('pso_meta',    $saved->pso_meta);

        return true;
    }

    /**
     * Cek apakah ada data tersimpan (session ATAU database).
     */
    public static function hasActive(): bool
    {
        // Cek session dulu (lebih cepat)
        if (
            session()->has('pso_results') &&
            session('pso_results') !== null &&
            count(session('pso_results')) > 0
        ) {
            return true;
        }

        // Fallback ke DB
        return PsoSavedRoute::where('session_key', self::getKey())->exists();
    }
}
