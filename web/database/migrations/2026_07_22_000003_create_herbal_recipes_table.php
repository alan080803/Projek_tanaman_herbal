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
        Schema::create('herbal_recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disease_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Nama racikan
            $table->text('description')->nullable(); // Deskripsi racikan
            $table->text('instructions'); // Cara pembuatan/pengolahan
            $table->string('dosage'); // Dosis penggunaan (misal: 2x sehari)
            $table->string('duration')->nullable(); // Durasi penggunaan (misal: 7 hari)
            $table->text('warnings')->nullable(); // Peringatan khusus
            $table->text('side_effects')->nullable(); // Efek samping yang mungkin
            $table->string('preparation_time')->nullable(); // Waktu persiapan
            $table->enum('difficulty_level', ['easy', 'medium', 'hard'])->default('medium');
            $table->integer('servings')->default(1); // Untuk berapa kali konsumsi
            $table->boolean('is_recommended')->default(false); // Racikan yang direkomendasikan
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('herbal_recipes');
    }
};
