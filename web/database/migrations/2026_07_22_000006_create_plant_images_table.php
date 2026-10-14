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
        Schema::create('plant_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plant_id')->constrained()->onDelete('cascade');
            $table->string('image_path'); // Path ke file gambar
            $table->string('title')->nullable(); // Judul gambar
            $table->text('description')->nullable(); // Deskripsi gambar
            $table->enum('image_type', [
                'main', // Gambar utama
                'leaf', // Detail daun
                'flower', // Detail bunga
                'fruit', // Detail buah
                'root', // Detail akar
                'stem', // Detail batang
                'habitat', // Habitat tumbuh
                'processed' // Bentuk setelah diproses
            ])->default('main');
            $table->boolean('is_primary')->default(false); // Gambar utama untuk thumbnail
            $table->integer('order')->default(0); // Urutan tampilan
            $table->timestamps();
            
            // Index untuk mempercepat query
            $table->index(['plant_id', 'image_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plant_images');
    }
};
