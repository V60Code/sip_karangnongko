<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('goats', function (Blueprint $table) {
            // Tambahkan setelah kolom farm_id atau sesuaikan posisinya
            $table->foreignId('user_id')
                  ->nullable() // Bisa null jika admin boleh input tanpa assign ke user tertentu, atau tidak nullable jika wajib ada pemilik
                  ->after('farm_id')
                  ->constrained('users') // Membuat foreign key ke tabel users
                  ->onDelete('set null'); // Atau onDelete('cascade') jika ingin data kambing ikut terhapus saat user dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('goats', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};