@extends('layouts.admin')

@section('page-title', 'Tambah Penyakit')
@section('page-subtitle', 'Daftarkan penyakit baru ke dalam sistem')

@section('content')
<!-- Decorative Background Elements -->
<div class="fixed top-20 right-20 w-96 h-96 bg-green-100/20 rounded-full blur-3xl pointer-events-none -z-10"></div>
<div class="fixed bottom-20 left-20 w-80 h-80 bg-green-50/30 rounded-full blur-3xl pointer-events-none -z-10"></div>

<div class="max-w-4xl">
    <form method="POST" action="{{ route('admin.diseases.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Basic Information Card -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 pb-3 border-b-2 border-gray-200 flex items-center gap-2">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Informasi Dasar
            </h3>
            
            <div class="space-y-5">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-bold text-gray-700 mb-2">
                        Nama Penyakit <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        required
                        class="w-full px-4 py-3 text-sm border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all @error('name') border-red-500 ring-2 ring-red-200 @enderror"
                        placeholder="Contoh: Batuk"
                    >
                    @error('name')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-bold text-gray-700 mb-2">
                        Slug (URL-friendly)
                    </label>
                    <input 
                        type="text" 
                        id="slug" 
                        name="slug" 
                        value="{{ old('slug') }}"
                        class="w-full px-4 py-3 text-sm border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all @error('slug') border-red-500 ring-2 ring-red-200 @enderror"
                        placeholder="Kosongkan untuk auto-generate dari nama"
                    >
                    <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Biarkan kosong untuk otomatis generate dari nama penyakit
                    </p>
                    @error('slug')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-bold text-gray-700 mb-2">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="4"
                        required
                        class="w-full px-4 py-3 text-sm border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all @error('description') border-red-500 ring-2 ring-red-200 @enderror"
                        placeholder="Deskripsi umum tentang penyakit ini..."
                    >{{ old('description') }}</textarea>
                    @error('description')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div>
                    <label for="image" class="block text-sm font-bold text-gray-700 mb-2">
                        Gambar Ilustrasi
                    </label>
                    <div class="space-y-3">
                        <!-- Upload Area -->
                        <div id="upload-area" class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-green-500 transition-all cursor-pointer bg-gray-50 hover:bg-green-50/50" onclick="document.getElementById('image').click()">
                            <input 
                                type="file" 
                                id="image" 
                                name="image" 
                                accept="image/*"
                                class="hidden"
                                onchange="previewImage(event)"
                                onclick="event.stopPropagation()"
                            >
                            <div class="cursor-pointer block">
                                <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4 pointer-events-none">
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-gray-700 mb-1 pointer-events-none">Klik untuk upload atau drag & drop</p>
                                <p class="text-xs text-gray-500 pointer-events-none">PNG, JPG, GIF hingga 2MB</p>
                            </div>
                        </div>
                        
                        <!-- Preview Area -->
                        <div id="image-preview" class="hidden">
                            <div class="relative inline-block">
                                <img id="preview" class="w-full h-52 rounded-2xl object-cover shadow-lg border-2 border-gray-200">
                                <button type="button" onclick="removeImage()" class="absolute top-3 right-3 p-2.5 bg-gray-500 text-white rounded-xl hover:bg-gray-600 transition-all shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    @error('image')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Detail Information Card -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 pb-3 border-b-2 border-gray-200 flex items-center gap-2">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Informasi Detail
            </h3>
            
            <div class="space-y-5">
                <!-- Symptoms -->
                <div>
                    <label for="symptoms" class="block text-sm font-bold text-gray-700 mb-2">
                        Gejala-gejala
                    </label>
                    <textarea 
                        id="symptoms" 
                        name="symptoms" 
                        rows="3"
                        class="w-full px-4 py-3 text-sm border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all @error('symptoms') border-red-500 ring-2 ring-red-200 @enderror"
                        placeholder="Daftar gejala yang muncul pada penyakit ini..."
                    >{{ old('symptoms') }}</textarea>
                    @error('symptoms')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Causes -->
                <div>
                    <label for="causes" class="block text-sm font-bold text-gray-700 mb-2">
                        Penyebab
                    </label>
                    <textarea 
                        id="causes" 
                        name="causes" 
                        rows="3"
                        class="w-full px-4 py-3 text-sm border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all @error('causes') border-red-500 ring-2 ring-red-200 @enderror"
                        placeholder="Faktor-faktor penyebab penyakit ini..."
                    >{{ old('causes') }}</textarea>
                    @error('causes')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Prevention -->
                <div>
                    <label for="prevention" class="block text-sm font-bold text-gray-700 mb-2">
                        Pencegahan
                    </label>
                    <textarea 
                        id="prevention" 
                        name="prevention" 
                        rows="3"
                        class="w-full px-4 py-3 text-sm border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all @error('prevention') border-red-500 ring-2 ring-red-200 @enderror"
                        placeholder="Cara-cara mencegah penyakit ini..."
                    >{{ old('prevention') }}</textarea>
                    @error('prevention')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Settings Card -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 pb-3 border-b-2 border-gray-200 flex items-center gap-2">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Pengaturan
            </h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Order -->
                <div>
                    <label for="order" class="block text-sm font-bold text-gray-700 mb-2">
                        Urutan Tampilan
                    </label>
                    <input 
                        type="number" 
                        id="order" 
                        name="order" 
                        value="{{ old('order', 0) }}"
                        min="0"
                        class="w-full px-4 py-3 text-sm border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all @error('order') border-red-500 ring-2 ring-red-200 @enderror"
                        placeholder="0"
                    >
                    <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Semakin kecil, semakin atas
                    </p>
                    @error('order')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Is Active -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">
                        Status
                    </label>
                    <div class="flex items-center gap-3 mt-3 p-4 bg-gray-50 rounded-xl border-2 border-gray-100">
                        <label class="inline-flex items-center cursor-pointer">
                            <input 
                                type="checkbox" 
                                name="is_active" 
                                value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="w-5 h-5 text-green-600 bg-white border-2 border-gray-300 rounded focus:ring-2 focus:ring-green-500 transition-all"
                            >
                            <span class="ml-2 text-sm font-semibold text-gray-700">Aktifkan penyakit ini</span>
                        </label>
                    </div>
                    <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Nonaktif = tidak ditampilkan di website
                    </p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.diseases.index') }}" class="inline-flex items-center justify-center px-5 py-3 text-sm font-semibold text-gray-700 bg-white border-2 border-gray-200 hover:border-gray-300 hover:bg-gray-50 rounded-xl transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Batal
            </a>
            <button type="submit" class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Penyakit
            </button>
        </div>
    </form>
</div>

<script>
// Image preview functionality
function previewImage(event) {
    const files = event.target ? event.target.files : (event.files || null);
    const file = files && files[0] ? files[0] : null;
    if (file) {
        // Validate file type
        if (!file.type.startsWith('image/')) {
            alert('File harus berupa gambar (JPG, PNG, GIF, dll).');
            const imgInput = document.getElementById('image');
            if (imgInput) imgInput.value = '';
            return;
        }

        // Validate file size (2MB max)
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 2MB.');
            const imgInput = document.getElementById('image');
            if (imgInput) imgInput.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
            document.getElementById('upload-area').classList.add('hidden');
        }
        reader.readAsDataURL(file);
    }
}

// Remove image functionality
function removeImage() {
    document.getElementById('image').value = '';
    document.getElementById('image-preview').classList.add('hidden');
    document.getElementById('upload-area').classList.remove('hidden');
}

// Drag and drop handlers
const uploadArea = document.getElementById('upload-area');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    uploadArea.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    uploadArea.addEventListener(eventName, () => {
        uploadArea.classList.add('border-green-500', 'bg-green-50');
    }, false);
});

['dragleave', 'drop'].forEach(eventName => {
    uploadArea.addEventListener(eventName, () => {
        uploadArea.classList.remove('border-green-500', 'bg-green-50');
    }, false);
});

uploadArea.addEventListener('drop', (e) => {
    const dt = e.dataTransfer;
    const files = dt.files;
    
    if (files.length > 0) {
        document.getElementById('image').files = files;
        previewImage({ target: { files: files } });
    }
}, false);
</script>
@endsection
