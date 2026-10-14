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
        Schema::create('recipe_ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained('herbal_recipes')->onDelete('cascade');
            $table->foreignId('plant_id')->constrained()->onDelete('cascade');
            $table->string('quantity'); // Jumlah/takaran (misal: 10, 1/2, secukupnya)
            $table->string('unit'); // Satuan (gram, sendok, lembar, dll)
            $table->text('preparation_notes')->nullable(); // Catatan persiapan khusus bahan ini
            $table->enum('part_used', [
                'leaf', // daun
                'root', // akar
                'stem', // batang
                'flower', // bunga
                'fruit', // buah
                'seed', // biji
                'bark', // kulit kayu
                'rhizome', // rimpang
                'whole_plant' // seluruh bagian
            ])->default('leaf'); // Bagian tanaman yang digunakan
            $table->integer('order')->default(0); // Urutan bahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_ingredients');
    }
};
