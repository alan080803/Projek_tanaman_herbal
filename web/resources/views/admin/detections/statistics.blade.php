@extends('layouts.admin')

@section('page-title', 'Statistik Deteksi')
@section('page-subtitle', 'Analisis dan laporan deteksi tanaman')

@section('content')
<!-- Decorative Background Elements -->
<div class="fixed top-20 right-20 w-96 h-96 bg-green-100/20 rounded-full blur-3xl pointer-events-none -z-10"></div>
<div class="fixed bottom-20 left-20 w-80 h-80 bg-green-50/30 rounded-full blur-3xl pointer-events-none -z-10"></div>

<!-- Header Actions -->
<div class="flex items-center justify-between mb-6">
    <a href="{{ route('admin.detections.index') }}" class="btn-secondary">
        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali ke Daftar
    </a>
</div>

<!-- Overview Statistics (5 Status Cards) -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
    <!-- Total Deteksi -->
    <div class="p-5 bg-white rounded-2xl border-2 border-gray-100 shadow-sm hover:shadow-md transition-all border-l-4 border-l-green-600">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">Total Deteksi</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalDetections ?? 0 }}</p>
                <p class="text-xs text-gray-500 mt-1">Keseluruhan</p>
            </div>
            <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center shadow-sm border-2 border-green-200">
                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Berhasil -->
    <div class="p-5 bg-white rounded-2xl border-2 border-gray-100 shadow-sm hover:shadow-md transition-all border-l-4 border-l-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">Berhasil</p>
                <p class="text-3xl font-bold text-green-700">{{ $successfulDetections ?? 0 }}</p>
                <p class="text-xs text-gray-500 mt-1">
                    {{ $totalDetections > 0 ? number_format(($successfulDetections / $totalDetections) * 100, 1) : 0 }}% dari total
                </p>
            </div>
            <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center shadow-sm border-2 border-green-200">
                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Tidak Ada Daun -->
    <div class="p-5 bg-white rounded-2xl border-2 border-gray-100 shadow-sm hover:shadow-md transition-all border-l-4 border-l-amber-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">Tidak Ada Daun</p>
                <p class="text-3xl font-bold text-amber-700">{{ $noLeafDetections ?? 0 }}</p>
                <p class="text-xs text-gray-500 mt-1">
                    {{ $totalDetections > 0 ? number_format(($noLeafDetections / $totalDetections) * 100, 1) : 0 }}% dari total
                </p>
            </div>
            <div class="w-14 h-14 bg-gradient-to-br from-amber-100 to-amber-200 rounded-xl flex items-center justify-center shadow-sm border-2 border-amber-200">
                <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Pending -->
    <div class="p-5 bg-white rounded-2xl border-2 border-gray-100 shadow-sm hover:shadow-md transition-all border-l-4 border-l-slate-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">Pending</p>
                <p class="text-3xl font-bold text-slate-700">{{ $pendingDetections ?? 0 }}</p>
                <p class="text-xs text-gray-500 mt-1">
                    {{ $totalDetections > 0 ? number_format(($pendingDetections / $totalDetections) * 100, 1) : 0 }}% dari total
                </p>
            </div>
            <div class="w-14 h-14 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center shadow-sm border-2 border-slate-200">
                <svg class="w-7 h-7 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Gagal -->
    <div class="p-5 bg-white rounded-2xl border-2 border-gray-100 shadow-sm hover:shadow-md transition-all border-l-4 border-l-gray-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">Gagal</p>
                <p class="text-3xl font-bold text-gray-700">{{ $failedDetections ?? 0 }}</p>
                <p class="text-xs text-gray-500 mt-1">
                    {{ $totalDetections > 0 ? number_format(($failedDetections / $totalDetections) * 100, 1) : 0 }}% dari total
                </p>
            </div>
            <div class="w-14 h-14 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center shadow-sm border-2 border-gray-200">
                <svg class="w-7 h-7 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Success Rate & Confidence Score Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Success Rate Visualization -->
    <div class="bg-white rounded-3xl shadow-lg border-2 border-gray-100 p-7 hover:shadow-xl hover:border-green-200 transition-all duration-300">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span>Tingkat Keberhasilan</span>
            </h3>
        </div>

        <div class="flex items-center justify-center py-6">
            <div class="relative w-56 h-56">
                @php
                    $successRate = $totalDetections > 0 ? ($successfulDetections / $totalDetections) * 100 : 0;
                @endphp
                <div class="w-56 h-56 rounded-full flex items-center justify-center shadow-md" 
                     style="background: conic-gradient(
                        #16a34a 0deg {{ $successRate * 3.6 }}deg,
                        #f3f4f6 {{ $successRate * 3.6 }}deg 360deg
                     );">
                    <div class="w-40 h-40 bg-white rounded-full flex flex-col items-center justify-center shadow-inner">
                        <span class="text-4xl font-bold text-green-600">{{ number_format($successRate, 1) }}%</span>
                        <span class="text-xs text-gray-500 font-semibold mt-1">Tingkat Keberhasilan</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-3 mt-4 pt-6 border-t-2 border-gray-100">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-3 h-3 bg-green-500 rounded-full mb-1"></div>
                <p class="text-base font-bold text-gray-900">{{ $successfulDetections }}</p>
                <p class="text-xs text-gray-500">Berhasil</p>
            </div>
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-3 h-3 bg-amber-500 rounded-full mb-1"></div>
                <p class="text-base font-bold text-gray-900">{{ $noLeafDetections ?? 0 }}</p>
                <p class="text-xs text-gray-500">Tidak Ada Daun</p>
            </div>
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-3 h-3 bg-slate-500 rounded-full mb-1"></div>
                <p class="text-base font-bold text-gray-900">{{ $pendingDetections }}</p>
                <p class="text-xs text-gray-500">Pending</p>
            </div>
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-3 h-3 bg-gray-500 rounded-full mb-1"></div>
                <p class="text-base font-bold text-gray-900">{{ $failedDetections }}</p>
                <p class="text-xs text-gray-500">Gagal</p>
            </div>
        </div>
    </div>

    <!-- Average Confidence Score & Activity -->
    <div class="bg-white rounded-3xl shadow-lg border-2 border-gray-100 p-7 hover:shadow-xl hover:border-green-200 transition-all duration-300 flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900 flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/30">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <span>Rata-rata Confidence Score</span>
                </h3>
            </div>
            
            @if(isset($averageConfidence))
            <div class="text-center py-6">
                <div class="inline-flex items-center justify-center w-36 h-36 rounded-full bg-gradient-to-br from-green-500 to-green-600 shadow-xl shadow-green-500/25 mb-3">
                    <div class="text-center">
                        <span class="text-4xl font-bold text-white">{{ number_format($averageConfidence, 1) }}%</span>
                    </div>
                </div>
                <p class="text-sm text-gray-600 font-medium">Rata-rata tingkat kepercayaan deteksi model AI</p>
            </div>
            @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-sm">Belum ada data confidence score</p>
            </div>
            @endif
        </div>

        <!-- Activity Overview (7 Days & 30 Days) -->
        <div class="grid grid-cols-2 gap-4 mt-4 pt-6 border-t-2 border-gray-100">
            <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 text-center">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">7 Hari Terakhir</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $detectionsLastWeek ?? 0 }}</p>
                <p class="text-xs text-gray-500">deteksi</p>
            </div>
            <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 text-center">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">30 Hari Terakhir</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $detectionsLastMonth ?? 0 }}</p>
                <p class="text-xs text-gray-500">deteksi</p>
            </div>
        </div>
    </div>
</div>

<!-- Detection Trends (Last 30 Days) -->
@if(isset($detectionTrends) && count($detectionTrends) > 0)
<div class="bg-white rounded-3xl shadow-lg border-2 border-gray-100 p-7 hover:shadow-xl hover:border-green-200 transition-all duration-300 mb-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/30">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <span>Tren Deteksi (30 Hari Terakhir)</span>
        </h3>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border-2 border-green-200">
            {{ count($detectionTrends) }} Hari Aktif
        </span>
    </div>
    
    <div class="overflow-x-auto pb-2">
        <div class="min-w-full">
            <!-- Simple clean bar chart -->
            <div class="flex items-end justify-between h-64 px-4 border-b-2 border-gray-200 gap-2">
                @php
                    $maxCount = (int) (collect($detectionTrends)->max('count') ?? 0);
                    $maxCount = $maxCount > 0 ? $maxCount : 1;
                @endphp
                @foreach($detectionTrends as $trend)
                @php
                    $trendCount = (int) data_get($trend, 'count', 0);
                    $trendDate = data_get($trend, 'date');
                    $barHeight = ($trendCount / $maxCount) * 100;
                @endphp
                <div class="flex flex-col items-center flex-1 mx-1 group">
                    <span class="text-xs font-bold text-green-700 mb-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        {{ $trendCount }}
                    </span>
                    <div class="w-full flex flex-col items-center justify-end h-48">
                        @if($maxCount > 0)
                        <div class="w-full max-w-[48px] bg-gradient-to-t from-green-500 to-green-400 rounded-t-lg group-hover:from-green-600 group-hover:to-green-500 shadow-sm transition-all"
                             style="height: {{ max($barHeight, 6) }}%"
                             title="{{ $trendDate }}: {{ $trendCount }} deteksi">
                        </div>
                        @endif
                    </div>
                    <span class="text-xs text-gray-500 font-medium mt-3 transform -rotate-45 origin-top-left">
                        {{ $trendDate ? \Carbon\Carbon::parse($trendDate)->format('d/m') : '-' }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

<!-- Most Detected Plants (Table Layout) -->
<div class="bg-white rounded-3xl shadow-lg border-2 border-gray-100 p-7 hover:shadow-xl hover:border-green-200 transition-all duration-300 mb-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/30">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <span>Tanaman Paling Banyak Terdeteksi</span>
        </h3>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border-2 border-green-200">
            Top 10
        </span>
    </div>
    
    @if(isset($mostDetectedPlants) && $mostDetectedPlants->count() > 0)
    @php
        $topPlantMax = (int) ($mostDetectedPlants->first()->detection_count ?? 1);
        $topPlantMax = $topPlantMax > 0 ? $topPlantMax : 1;
    @endphp
    <div class="overflow-x-auto rounded-2xl border-2 border-gray-100">
        <table class="w-full">
            <thead>
                <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                    <th class="text-center py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider w-16">Peringkat</th>
                    <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider">Tanaman</th>
                    <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider hidden md:table-cell">Nama Ilmiah</th>
                    <th class="text-center py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider">Total Deteksi</th>
                    <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider w-40 hidden sm:table-cell">Proporsi</th>
                    <th class="text-center py-4 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider w-24">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @foreach($mostDetectedPlants as $item)
                @php
                    $plant = $item->plant;
                    $count = (int) ($item->detection_count ?? 0);
                    $percentage = round(($count / $topPlantMax) * 100);
                @endphp
                <tr class="hover:bg-gradient-to-r hover:from-green-50/50 hover:to-transparent transition-all duration-200 group">
                    <td class="py-4 px-4 text-center">
                        <div class="inline-flex items-center justify-center w-8 h-8 rounded-xl font-bold text-sm
                            @if($loop->iteration == 1) bg-amber-100 text-amber-800 border-2 border-amber-300
                            @elseif($loop->iteration == 2) bg-slate-100 text-slate-800 border-2 border-slate-300
                            @elseif($loop->iteration == 3) bg-orange-100 text-orange-800 border-2 border-orange-300
                            @else bg-gray-100 text-gray-700
                            @endif">
                            #{{ $loop->iteration }}
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center flex-shrink-0 text-white font-bold text-sm shadow-sm group-hover:scale-105 transition-transform">
                                @if($plant)
                                    {{ substr($plant->name, 0, 1) }}
                                @else
                                    ?
                                @endif
                            </div>
                            <div>
                                @if($plant)
                                    <p class="font-bold text-gray-900 group-hover:text-green-600 transition-colors">{{ $plant->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $plant->local_name ?? '-' }}</p>
                                @else
                                    <p class="text-sm text-gray-500 italic">Tidak teridentifikasi</p>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4 hidden md:table-cell">
                        <span class="text-sm text-gray-600 italic">{{ $plant->scientific_name ?? '-' }}</span>
                    </td>
                    <td class="py-4 px-4 text-center">
                        <span class="text-lg font-bold text-green-700">{{ $count }}</span>
                        <span class="text-xs text-gray-500 ml-1">kali</span>
                    </td>
                    <td class="py-4 px-4 hidden sm:table-cell">
                        <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-gradient-to-r from-green-500 to-green-600 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                        </div>
                    </td>
                    <td class="py-4 px-4 text-center">
                        @if($plant)
                        <a href="{{ route('admin.plants.show', $plant->id) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-bold text-green-700 bg-green-50 hover:bg-green-100 rounded-lg transition-colors border border-green-200">
                            Detail
                        </a>
                        @else
                        <span class="text-xs text-gray-400">-</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="text-center py-12">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
        </svg>
        <p class="text-gray-500 text-sm">Belum ada data deteksi tanaman</p>
    </div>
    @endif
</div>
@endsection
