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
        Schema::create('plant_detections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('plant_id')->nullable()->constrained()->onDelete('set null');
            $table->string('uploaded_image_path'); // Gambar yang diupload user
            $table->decimal('confidence_score', 5, 2)->nullable(); // Skor confidence dari ML model (0-100)
            $table->json('detection_result')->nullable(); // Hasil raw dari ML model
            $table->string('detection_status')->default('pending'); // pending, success, failed
            $table->text('notes')->nullable(); // Catatan user tentang deteksi ini
            $table->ipAddress('ip_address')->nullable(); // IP address user
            $table->string('user_agent')->nullable(); // Browser/device info
            $table->timestamp('detected_at')->nullable(); // Waktu deteksi selesai
            $table->timestamps();
            
            // Index untuk analytics dan reporting
            $table->index(['user_id', 'created_at']);
            $table->index(['plant_id', 'created_at']);
            $table->index('detection_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plant_detections');
    }
};
