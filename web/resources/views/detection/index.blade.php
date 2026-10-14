@extends('layouts.app')

@section('title', 'Deteksi Tanaman Herbal dengan AI')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-green-50 via-white to-green-50/30 py-16 lg:py-24">
    <!-- Decorative Elements -->
    <div class="absolute top-10 right-10 w-64 h-64 bg-green-100/30 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 left-10 w-80 h-80 bg-green-50/40 rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-sm border border-green-100 mb-6">
                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 7H7v6h6V7z"/>
                    <path fill-rule="evenodd" d="M7 2a1 1 0 012 0v1h2V2a1 1 0 112 0v1h2a2 2 0 012 2v2h1a1 1 0 110 2h-1v2h1a1 1 0 110 2h-1v2a2 2 0 01-2 2h-2v1a1 1 0 11-2 0v-1H9v1a1 1 0 11-2 0v-1H5a2 2 0 01-2-2v-2H2a1 1 0 110-2h1V9H2a1 1 0 010-2h1V5a2 2 0 012-2h2V2zM5 5h10v10H5V5z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm font-semibold text-gray-700">Verifikasi Daun & Klasifikasi Tanaman Herbal Berbasis AI</span>
            </div>
            
            <!-- Main Content -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight tracking-tight">
                Deteksi & Identifikasi
                <span class="block mt-2 bg-gradient-to-r from-green-600 to-green-500 bg-clip-text text-transparent">
                    Tanaman Herbal dengan AI
                </span>
            </h1>
            
            <p class="text-xl md:text-2xl text-gray-600 mb-4 leading-relaxed font-light">
                Teknologi AI untuk Identifikasi Akurat & Cepat
            </p>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto font-light">
                Upload atau ambil foto tanaman herbal, sistem akan mengidentifikasi jenis tanaman secara otomatis dalam hitungan detik
            </p>
        </div>
    </div>
</section>

<!-- Upload Section -->
<section class="py-16 lg:py-20 bg-gradient-to-b from-gray-50/50 to-white">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-3xl shadow-sm border-2 border-gray-100 p-8 lg:p-12">
                <div class="text-center mb-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Upload Foto Tanaman</h2>
                    <p class="text-gray-600 text-lg">Ambil atau upload foto untuk memulai deteksi AI</p>
                </div>
                
                <form action="{{ route('detection.upload') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf
                    
                    <!-- Image Upload Area -->
                    <div class="mb-8">
                        <div class="border-2 border-dashed border-gray-300 rounded-3xl p-12 lg:p-16 text-center hover:border-green-500 hover:bg-green-50/30 transition-all duration-300 cursor-pointer group" 
                             id="dropZone"
                             onclick="document.getElementById('imageInput').click()">
                            <div id="previewArea" class="hidden">
                                <img id="imagePreview" class="max-w-full max-h-96 mx-auto rounded-2xl shadow-lg mb-6 border-2 border-gray-200">
                                <button type="button" 
                                        onclick="event.stopPropagation(); resetUpload()"
                                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-xl font-semibold text-sm transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Hapus dan Pilih Ulang
                                </button>
                            </div>
                            
                            <div id="placeholderArea">
                                <div class="inline-flex items-center justify-center w-24 h-24 bg-green-50 rounded-full mb-6 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <p class="text-2xl font-bold text-gray-900 mb-2">Klik untuk Upload Foto</p>
                                <p class="text-gray-600 text-base mb-6">atau seret dan lepas file di sini</p>
                                <div class="inline-flex items-center gap-2 bg-gray-100 rounded-xl px-4 py-2.5">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-sm text-gray-700 font-medium">Format: JPG, PNG, JPEG • Maks. 10MB</span>
                                </div>
                            </div>
                        </div>
                        
                        <input type="file" 
                               id="imageInput" 
                               name="image" 
                               accept="image/jpeg,image/png,image/jpg"
                               class="hidden"
                               onchange="handleFileSelect(event)"
                               required>
                        
                        @error('image')
                            <div class="mt-4 bg-red-50 border-2 border-red-200 rounded-xl p-4 flex items-start gap-3">
                                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-red-700 font-medium">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            id="submitBtn"
                            class="w-full bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white py-4 rounded-2xl font-bold text-lg shadow-lg shadow-green-600/20 hover:shadow-xl hover:shadow-green-600/30 transform hover:scale-[1.02] transition-all duration-300 disabled:bg-gray-400 disabled:cursor-not-allowed disabled:transform-none disabled:shadow-none">
                        <span id="submitText" class="flex items-center justify-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <span>Mulai Deteksi AI</span>
                        </span>
                        <span id="loadingText" class="hidden flex items-center justify-center gap-3">
                            <svg class="animate-spin w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Sedang Menganalisis...</span>
                        </span>
                    </button>
                </form>
            </div>

            <!-- How It Works -->
            <div class="mt-12 bg-white rounded-3xl shadow-sm border-2 border-gray-100 p-8 lg:p-10">
                <div class="flex items-center gap-4 mb-8">
                    <div class="flex-shrink-0 w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900">Cara Menggunakan</h3>
                </div>
                <div class="space-y-6">
                    <div class="flex items-start gap-4 group">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 text-white rounded-2xl flex items-center justify-center text-xl font-bold shadow-lg shadow-green-500/30 group-hover:scale-110 transition-transform">1</div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-900 mb-2 text-lg">Upload Foto Berkualitas</p>
                            <p class="text-gray-600 leading-relaxed">Ambil atau upload foto tanaman herbal yang jelas dan fokus. Sebaiknya foto daun atau bagian yang paling karakteristik.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 group">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 text-white rounded-2xl flex items-center justify-center text-xl font-bold shadow-lg shadow-green-500/30 group-hover:scale-110 transition-transform">2</div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-900 mb-2 text-lg">Verifikasi & Klasifikasi AI</p>
                            <p class="text-gray-600 leading-relaxed">Sistem memverifikasi keberadaan daun terlebih dahulu, lalu mengklasifikasikan jenis tanaman herbal dengan akurasi tinggi.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 group">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 text-white rounded-2xl flex items-center justify-center text-xl font-bold shadow-lg shadow-green-500/30 group-hover:scale-110 transition-transform">3</div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-900 mb-2 text-lg">Dapatkan Hasil Lengkap</p>
                            <p class="text-gray-600 leading-relaxed">Lihat hasil deteksi lengkap dengan nama, karakteristik, khasiat kesehatan, dan panduan pengolahan.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tips -->
            <div class="mt-8 bg-gradient-to-br from-green-50/50 to-white rounded-3xl shadow-sm border-2 border-gray-100 p-8 lg:p-10">
                <div class="flex items-center gap-4 mb-8">
                    <div class="flex-shrink-0 w-14 h-14 bg-amber-100 rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900">Tips untuk Hasil Terbaik</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-start gap-3 p-4 bg-white rounded-xl">
                        <div class="flex-shrink-0 w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center mt-0.5">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-gray-700 text-sm leading-relaxed">Ambil foto dalam <span class="font-semibold text-gray-900">pencahayaan yang cukup</span> (tidak terlalu gelap atau silau)</p>
                    </div>
                    <div class="flex items-start gap-3 p-4 bg-white rounded-xl">
                        <div class="flex-shrink-0 w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center mt-0.5">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-gray-700 text-sm leading-relaxed">Pastikan tanaman menjadi <span class="font-semibold text-gray-900">fokus utama</span> (hindari background ramai)</p>
                    </div>
                    <div class="flex items-start gap-3 p-4 bg-white rounded-xl">
                        <div class="flex-shrink-0 w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center mt-0.5">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-gray-700 text-sm leading-relaxed">Foto dari <span class="font-semibold text-gray-900">jarak dekat</span> untuk menangkap detail daun, bunga, atau batang</p>
                    </div>
                    <div class="flex items-start gap-3 p-4 bg-white rounded-xl">
                        <div class="flex-shrink-0 w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center mt-0.5">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-gray-700 text-sm leading-relaxed">Hindari foto yang <span class="font-semibold text-gray-900">blur atau buram</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Recent Detections (if any) -->
<!-- Recent Detections (if any) -->
@auth
<section class="py-16 lg:py-20 bg-white">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Deteksi Terbaru Anda</h2>
                    <p class="text-gray-600 text-base">Hasil deteksi yang baru saja Anda lakukan</p>
                </div>
                <a href="{{ route('detection.history') }}" class="inline-flex items-center gap-2 text-green-600 hover:text-green-700 font-semibold text-sm transition-colors">
                    <span>Lihat Semua Riwayat</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            
            @if(isset($recentDetections) && $recentDetections->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recentDetections as $recent)
                        <a href="{{ route('detection.result', $recent->id) }}" class="group bg-white rounded-2xl border-2 border-gray-100 hover:border-green-500 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col">
                            <div class="aspect-video bg-gray-100 relative overflow-hidden flex items-center justify-center">
                                @if($recent->uploaded_image_path)
                                    <img src="{{ asset('storage/' . $recent->uploaded_image_path) }}" 
                                         alt="Deteksi" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                @endif
                                <div class="absolute top-3 right-3">
                                    @if($recent->detection_status === 'success')
                                        <span class="px-2.5 py-1 bg-green-600 text-white text-xs font-semibold rounded-full shadow">Berhasil</span>
                                    @elseif($recent->detection_status === 'no_leaf')
                                        <span class="px-2.5 py-1 bg-amber-500 text-white text-xs font-semibold rounded-full shadow">Tidak Ada Daun</span>
                                    @elseif($recent->detection_status === 'failed')
                                        <span class="px-2.5 py-1 bg-red-600 text-white text-xs font-semibold rounded-full shadow">Gagal</span>
                                    @else
                                        <span class="px-2.5 py-1 bg-yellow-500 text-white text-xs font-semibold rounded-full shadow">Pending</span>
                                    @endif
                                </div>
                            </div>
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <h4 class="font-bold text-gray-900 group-hover:text-green-600 transition-colors text-lg mb-1 line-clamp-1">
                                        {{ $recent->plant ? $recent->plant->name : ($recent->detection_status === 'no_leaf' ? 'Tidak Ada Daun' : 'Tanpa Nama') }}
                                    </h4>
                                    <p class="text-xs text-gray-500 mb-3">{{ $recent->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="flex items-center justify-between text-sm pt-3 border-t border-gray-100">
                                    <span class="text-gray-500">
                                        @if($recent->confidence_score)
                                            Akurasi: <strong class="text-green-600">{{ number_format($recent->confidence_score, 1) }}%</strong>
                                        @elseif($recent->detection_status === 'no_leaf')
                                            <span class="text-amber-600 font-medium">Bukan daun</span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </span>
                                    <span class="text-green-600 font-semibold group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">
                                        Detail →
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="bg-gradient-to-br from-gray-50 to-white rounded-3xl border-2 border-dashed border-gray-200 p-12 lg:p-16 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-green-50 rounded-full mb-6">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <p class="text-xl font-semibold text-gray-900 mb-2">Belum ada riwayat deteksi</p>
                    <p class="text-gray-600">Mulai deteksi pertama Anda untuk melihat hasilnya di sini!</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endauth

@push('scripts')
<script>
// Handle file selection
function handleFileSelect(event) {
    const file = event.target.files[0];
    if (file) {
        // Validate file size (10MB)
        if (file.size > 10 * 1024 * 1024) {
            alert('❌ Ukuran file terlalu besar!\n\nMaksimal 10MB. File Anda: ' + (file.size / 1024 / 1024).toFixed(2) + 'MB');
            resetUpload();
            return;
        }

        // Validate file type
        const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!validTypes.includes(file.type)) {
            alert('❌ Format file tidak didukung!\n\nGunakan format: JPG, PNG, atau JPEG');
            resetUpload();
            return;
        }

        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
            document.getElementById('previewArea').classList.remove('hidden');
            document.getElementById('placeholderArea').classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
}

// Reset upload
function resetUpload() {
    document.getElementById('imageInput').value = '';
    document.getElementById('previewArea').classList.add('hidden');
    document.getElementById('placeholderArea').classList.remove('hidden');
}

// Drag and drop
const dropZone = document.getElementById('dropZone');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropZone.addEventListener(eventName, () => {
        dropZone.classList.add('border-green-500', 'bg-green-50');
    }, false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, () => {
        dropZone.classList.remove('border-green-500', 'bg-green-50');
    }, false);
});

dropZone.addEventListener('drop', function(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    
    if (files.length > 0) {
        document.getElementById('imageInput').files = files;
        handleFileSelect({ target: { files: files } });
    }
}, false);

// Form submission
document.getElementById('uploadForm').addEventListener('submit', function() {
    document.getElementById('submitBtn').disabled = true;
    document.getElementById('submitText').classList.add('hidden');
    document.getElementById('loadingText').classList.remove('hidden');
});
</script>
@endpush
@endsection
