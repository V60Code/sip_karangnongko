<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('goats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_id')->constrained()->onDelete('cascade');
            $table->string('tag_number')->unique(); // Kode unik otomatis: KB001, KT001, dst
            $table->enum('gender', ['jantan', 'betina']);
            $table->string('type')->nullable(); // ✅ Jenis kambing (input manual)
            $table->date('birth_date')->nullable();
            $table->float('weight')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goats');
    }
};
