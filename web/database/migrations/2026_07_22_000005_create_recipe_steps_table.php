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
        Schema::create('recipe_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained('herbal_recipes')->onDelete('cascade');
            $table->integer('step_number'); // Nomor urut langkah
            $table->string('title')->nullable(); // Judul langkah (opsional)
            $table->text('instruction'); // Instruksi detail untuk langkah ini
            $table->string('image_path')->nullable(); // Gambar ilustrasi langkah
            $table->string('duration')->nullable(); // Durasi untuk langkah ini (misal: 15 menit)
            $table->text('tips')->nullable(); // Tips khusus untuk langkah ini
            $table->timestamps();
            
            // Index untuk mempercepat query berdasarkan recipe dan urutan
            $table->index(['recipe_id', 'step_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_steps');
    }
};
