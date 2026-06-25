<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('destinasi', function (Blueprint $table) {
        // Menambahkan kolom setelah jam_tutup
        $table->string('tanggal_pelaksanaan')->nullable()->after('updated_at');
    });
}

public function down()
{
    Schema::table('destinasi', function (Blueprint $table) {
        $table->dropColumn('tanggal_pelaksanaan');
    });
}
};
