@extends('layouts.app')

@section('title', 'Tentang Kami - HerbalBolaangMongondow')

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
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm font-semibold text-gray-700">Tentang Platform</span>
            </div>
            
            <!-- Title -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight tracking-tight">
                Menghubungkan Tradisi
                <span class="block mt-2 bg-gradient-to-r from-green-600 to-green-500 bg-clip-text text-transparent">
                    dengan Teknologi Modern
                </span>
            </h1>
            
            <!-- Subtitle -->
            <p class="text-lg md:text-xl text-gray-600 leading-relaxed font-light max-w-3xl mx-auto">
                HerbalBolaangMongondow adalah platform digital yang memadukan kearifan lokal pengobatan tradisional Indonesia dengan teknologi Artificial Intelligence untuk kemudahan akses informasi kesehatan herbal
            </p>
        </div>
    </div>
</section>

<!-- About Platform -->
<section class="py-16 lg:py-20 bg-white">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Content -->
                <div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 text-green-600 rounded-full text-sm font-semibold mb-6">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                        </svg>
                        <span>Tentang Kami</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 tracking-tight">
                        Platform Identifikasi Tanaman Herbal Suku Bolaang Mongondow
                    </h2>
                    <div class="space-y-4 text-gray-600 leading-relaxed">
                        <p>
                            <strong class="text-gray-900">HerbalBolaangMongondow</strong> merupakan platform berbasis web yang memanfaatkan teknologi Artificial Intelligence (AI) melalui pendekatan Deep Learning dengan arsitektur MobileNetV2 untuk membantu mengidentifikasi tanaman herbal berdasarkan citra.
                        </p>
                        <p>
                            Platform ini menyediakan fitur identifikasi 13 jenis tanaman herbal berdasarkan citra yang diunggah oleh pengguna. Selain fitur identifikasi, HerbalMongondow juga menyediakan informasi mengenai tanaman herbal serta direktori pengobatan tradisional yang memuat informasi penyakit, tanaman yang berkaitan, bahan, takaran, dan cara pengolahan berdasarkan pengetahuan pengobatan tradisional Suku Bolaang Mongondow.
                        </p>
                        <p>
                            Platform ini dikembangkan sebagai media digital untuk membantu mengenalkan, mendokumentasikan, dan memudahkan akses terhadap pengetahuan tanaman herbal dan pengobatan tradisional Suku Bolaang Mongondow.
                        </p>
                    </div>
                </div>
                
                <!-- Visual Element -->
                <div class="relative">
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-3xl p-8 lg:p-12">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="bg-white rounded-2xl p-6 shadow-sm border-2 border-gray-100 hover:border-green-500 transition-all duration-300">
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <div class="text-3xl font-bold text-green-600 mb-1">13+</div>
                                <div class="text-sm text-gray-600 font-medium">Tanaman Herbal</div>
                            </div>
                            <div class="bg-white rounded-2xl p-6 shadow-sm border-2 border-gray-100 hover:border-green-500 transition-all duration-300">
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <div class="text-3xl font-bold text-green-600 mb-1">15+</div>
                                <div class="text-sm text-gray-600 font-medium">Resep Racikan</div>
                            </div>
                            <div class="bg-white rounded-2xl p-6 shadow-sm border-2 border-gray-100 hover:border-green-500 transition-all duration-300">
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                    </svg>
                                </div>
                                <div class="text-3xl font-bold text-green-600 mb-1">95%</div>
                                <div class="text-sm text-gray-600 font-medium">Akurasi AI</div>
                            </div>
                            <div class="bg-white rounded-2xl p-6 shadow-sm border-2 border-gray-100 hover:border-green-500 transition-all duration-300">
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <div class="text-3xl font-bold text-green-600 mb-1">100%</div>
                                <div class="text-sm text-gray-600 font-medium">Gratis</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-16 lg:py-20 bg-gradient-to-b from-gray-50/50 to-white">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 tracking-tight">Misi & Visi Kami</h2>
                <p class="text-gray-600 text-lg font-light max-w-2xl mx-auto">
                    Melestarikan warisan pengobatan tradisional dan membuatnya mudah diakses oleh generasi modern
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Mission -->
                <div class="bg-white rounded-3xl p-8 lg:p-10 border-2 border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Misi Kami</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-600 leading-relaxed">Melestarikan pengetahuan pengobatan tradisional Indonesia</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-600 leading-relaxed">Mempermudah akses informasi tanaman herbal untuk masyarakat</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-600 leading-relaxed">Mengedukasi masyarakat tentang khasiat dan pengolahan herbal yang benar</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-600 leading-relaxed">Mengintegrasikan teknologi AI untuk identifikasi tanaman yang akurat</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Vision -->
                <div class="bg-white rounded-3xl p-8 lg:p-10 border-2 border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Visi Kami</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Menjadi platform digital terdepan dalam pelestarian dan edukasi pengobatan tradisional Indonesia, yang memadukan kearifan lokal dengan teknologi modern untuk meningkatkan kesejahteraan masyarakat.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Kami berkomitmen untuk terus mengembangkan fitur dan memperluas database tanaman herbal agar dapat memberikan manfaat maksimal bagi kesehatan keluarga Indonesia.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Technology -->
<section class="py-16 lg:py-20 bg-white">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 text-green-600 rounded-full text-sm font-semibold mb-6">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    <span>Teknologi</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 tracking-tight">
                    Teknologi yang Kami Gunakan
                </h2>
                <p class="text-gray-600 text-lg font-light max-w-2xl mx-auto">
                    Platform modern dengan teknologi terkini untuk pengalaman pengguna terbaik
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                <!-- AI Technology -->
                <div class="group bg-gradient-to-br from-green-50 to-white rounded-2xl p-8 border-2 border-gray-100 hover:border-green-500 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-white rounded-xl flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">MobileNetV2</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Deep Learning model untuk identifikasi tanaman dengan akurasi tinggi dan kecepatan optimal
                    </p>
                </div>
                
                <!-- Web Technology -->
                <div class="group bg-gradient-to-br from-green-50 to-white rounded-2xl p-8 border-2 border-gray-100 hover:border-green-500 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-white rounded-xl flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Laravel & Tailwind</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Framework modern untuk performa maksimal dan antarmuka yang responsif di semua perangkat
                    </p>
                </div>
                
                <!-- Database -->
                <div class="group bg-gradient-to-br from-green-50 to-white rounded-2xl p-8 border-2 border-gray-100 hover:border-green-500 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-white rounded-xl flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Database Lengkap</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Sistem database terstruktur dengan informasi lengkap tanaman dan racikan obat tradisional
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="relative py-20 lg:py-24 overflow-hidden">
    <!-- Background Gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-green-600 via-green-500 to-green-600"></div>
    
    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 leading-tight tracking-tight">
                Siap Memulai Perjalanan Kesehatan Herbal Anda?
            </h2>
            
            <p class="text-xl md:text-2xl mb-10 text-white/90 leading-relaxed font-light">
                Bergabunglah dengan ribuan pengguna yang telah merasakan manfaat platform kami
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('detection.index') }}" class="group inline-flex items-center justify-center gap-3 px-8 py-4 bg-white text-green-600 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-3xl hover:scale-105 transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span>Deteksi Tanaman Sekarang</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="{{ route('plants.index') }}" class="group inline-flex items-center justify-center gap-3 px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-2xl font-bold text-lg border-2 border-white/30 hover:bg-white/20 hover:border-white/50 transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <span>Jelajahi Database</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
