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
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama umum tanaman
            $table->string('local_name')->nullable(); // Nama lokal/daerah
            $table->string('scientific_name')->nullable(); // Nama ilmiah
            $table->text('description'); // Deskripsi umum tanaman
            $table->text('characteristics')->nullable(); // Karakteristik fisik tanaman
            $table->text('benefits'); // Khasiat dan manfaat
            $table->text('usage_notes')->nullable(); // Catatan penggunaan
            $table->string('image_path')->nullable(); // Path foto tanaman
            $table->boolean('is_active')->default(true); // Status aktif
            $table->timestamps();
            $table->softDeletes(); // Soft delete untuk data history
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};
