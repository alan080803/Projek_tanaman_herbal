@extends('layouts.admin')

@section('page-title', 'Daftar Deteksi Tanaman')
@section('page-subtitle', 'Riwayat deteksi tanaman dari pengguna')

@section('content')
<!-- Decorative Background Elements -->
<div class="fixed top-20 right-20 w-96 h-96 bg-green-100/20 rounded-full blur-3xl pointer-events-none -z-10"></div>
<div class="fixed bottom-20 left-20 w-80 h-80 bg-green-50/30 rounded-full blur-3xl pointer-events-none -z-10"></div>

<div class="bg-white rounded-3xl shadow-lg border-2 border-gray-100 p-8 hover:shadow-xl hover:border-green-200 transition-all duration-300">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Daftar Deteksi</h2>
            <p class="text-sm text-gray-600 mt-1 flex items-center gap-1.5">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Total: <span class="font-semibold text-gray-900">{{ $detections->total() }}</span> deteksi
            </p>
        </div>
        <a href="{{ route('admin.detections.statistics') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            Lihat Statistik
        </a>
    </div>

    <!-- Filters -->
    <div class="mb-6 p-4 bg-gray-50 rounded-xl border-2 border-gray-100">
        <form method="GET" action="{{ route('admin.detections.index') }}" class="space-y-3">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Status</label>
                    <select name="status" class="w-full px-4 py-2.5 text-sm border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all">
                        <option value="">Semua Status</option>
                        <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Berhasil</option>
                        <option value="no_leaf" {{ request('status') == 'no_leaf' ? 'selected' : '' }}>Tidak Ada Daun</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Gagal</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Tanaman</label>
                    <select name="plant_id" class="w-full px-4 py-2.5 text-sm border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all">
                        <option value="">Semua Tanaman</option>
                        @foreach($plants as $plant)
                        <option value="{{ $plant->id }}" {{ request('plant_id') == $plant->id ? 'selected' : '' }}>{{ $plant->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Dari Tanggal</label>
                    <input 
                        type="date" 
                        name="date_from" 
                        value="{{ request('date_from') }}"
                        class="w-full px-4 py-2.5 text-sm border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                    >
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Sampai Tanggal</label>
                    <input 
                        type="date" 
                        name="date_to" 
                        value="{{ request('date_to') }}"
                        class="w-full px-4 py-2.5 text-sm border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                    >
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Terapkan Filter
                </button>
                @if(request()->hasAny(['status', 'plant_id', 'date_from', 'date_to']))
                <a href="{{ route('admin.detections.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold text-gray-700 bg-white border-2 border-gray-200 hover:border-gray-300 hover:bg-gray-50 rounded-xl transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Reset Filter
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Statistics Summary -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="p-5 bg-white rounded-2xl border-2 border-gray-100 shadow-sm hover:shadow-md transition-all border-l-4 border-l-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">Berhasil</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $successCount ?? 0 }}</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center shadow-sm border-2 border-green-200">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="p-5 bg-white rounded-2xl border-2 border-gray-100 shadow-sm hover:shadow-md transition-all border-l-4 border-l-amber-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">Tidak Ada Daun</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $noLeafCount ?? 0 }}</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-amber-100 to-amber-200 rounded-xl flex items-center justify-center shadow-sm border-2 border-amber-200">
                    <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="p-5 bg-white rounded-2xl border-2 border-gray-100 shadow-sm hover:shadow-md transition-all border-l-4 border-l-slate-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">Pending</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $pendingCount ?? 0 }}</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center shadow-sm border-2 border-slate-200">
                    <svg class="w-7 h-7 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="p-5 bg-white rounded-2xl border-2 border-gray-100 shadow-sm hover:shadow-md transition-all border-l-4 border-l-gray-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">Gagal</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $failedCount ?? 0 }}</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center shadow-sm border-2 border-gray-200">
                    <svg class="w-7 h-7 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-xl border-2 border-gray-100">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                <tr class="border-b-2 border-gray-200">
                    <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase">No</th>
                    <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase">Gambar</th>
                    <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase">Tanaman</th>
                    <th class="text-center py-4 px-4 text-xs font-bold text-gray-700 uppercase hidden md:table-cell">Confidence</th>
                    <th class="text-center py-4 px-4 text-xs font-bold text-gray-700 uppercase">Status</th>
                    <th class="text-left py-4 px-4 text-xs font-bold text-gray-700 uppercase hidden lg:table-cell">Tanggal</th>
                    <th class="text-center py-4 px-4 text-xs font-bold text-gray-700 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($detections as $detection)
                <tr class="hover:bg-green-50/30 transition-all duration-200">
                    <td class="py-4 px-4 whitespace-nowrap">
                        <span class="text-sm font-semibold text-gray-700">{{ $detections->firstItem() + $loop->index }}</span>
                    </td>
                    <td class="py-4 px-4">
                        @if($detection->uploaded_image_path)
                        <img src="{{ asset('storage/' . $detection->uploaded_image_path) }}" 
                             alt="Deteksi" 
                             class="w-20 h-20 rounded-xl object-cover shadow-md border-2 border-gray-200"
                             onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center shadow-sm\'><svg class=\'w-10 h-10 text-gray-400\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg></div>';">
                        @else
                        <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center shadow-sm">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        @endif
                    </td>
                    <td class="py-4 px-4">
                        @if($detection->plant)
                        <div>
                            <p class="text-sm font-bold text-gray-900">{{ $detection->plant->name }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $detection->plant->local_name }}</p>
                        </div>
                        @else
                        <span class="text-sm text-gray-400 italic">Belum teridentifikasi</span>
                        @endif
                    </td>
                    <td class="py-4 px-4 hidden md:table-cell">
                        @if($detection->confidence_score)
                        <div class="flex items-center justify-center">
                            <div class="flex-1 bg-gray-200 rounded-full h-3 mr-3 max-w-[100px]">
                                <div class="bg-gradient-to-r from-green-500 to-green-600 h-3 rounded-full transition-all" style="width: {{ $detection->confidence_score }}%"></div>
                            </div>
                            <span class="text-sm font-bold text-gray-900 min-w-[45px]">{{ number_format($detection->confidence_score, 1) }}%</span>
                        </div>
                        @else
                        <span class="text-sm text-gray-400 text-center block">-</span>
                        @endif
                    </td>
                    <td class="py-4 px-4 text-center">
                        @if($detection->detection_status === 'success')
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200 shadow-sm">
                            <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Berhasil
                        </span>
                        @elseif($detection->detection_status === 'no_leaf')
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 border border-amber-200 shadow-sm">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            Tidak Ada Daun
                        </span>
                        @elseif($detection->detection_status === 'pending')
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-800 border border-slate-200 shadow-sm">
                            <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            Pending
                        </span>
                        @else
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800 border border-gray-200 shadow-sm">
                            <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            Gagal
                        </span>
                        @endif
                    </td>
                    <td class="py-4 px-4 hidden lg:table-cell">
                        <div>
                            <p class="text-sm font-medium text-gray-700">{{ $detection->created_at->format('d M Y') }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $detection->created_at->format('H:i') }} WIB</p>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.detections.show', $detection->id) }}" class="p-2 text-green-600 hover:bg-green-50 rounded-xl transition-all duration-200 border-2 border-transparent hover:border-green-200" title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('admin.detections.destroy', $detection->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data deteksi ini?\n\nTindakan ini tidak dapat dibatalkan.');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit"
                                    class="p-2 text-gray-600 hover:bg-gray-50 rounded-xl transition-all duration-200 border-2 border-transparent hover:border-gray-200" 
                                    title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-16 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-24 h-24 bg-green-100 rounded-2xl flex items-center justify-center mb-4">
                                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">
                                @if(request()->hasAny(['search', 'status']))
                                    Tidak Ada Hasil
                                @else
                                    Belum Ada Deteksi
                                @endif
                            </h3>
                            <p class="text-gray-500 text-sm mb-6 max-w-md">
                                @if(request('search'))
                                    Tidak ada deteksi yang ditemukan dengan kata kunci "{{ request('search') }}".
                                @elseif(request('status'))
                                    Tidak ada deteksi dengan status filter yang dipilih.
                                @else
                                    Belum ada riwayat deteksi tanaman dari pengguna.
                                @endif
                            </p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($detections->hasPages())
    <div class="mt-6 pt-6 border-t-2 border-gray-100">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-sm text-gray-600">
                Menampilkan <span class="font-bold text-gray-900">{{ $detections->firstItem() }}</span> 
                sampai <span class="font-bold text-gray-900">{{ $detections->lastItem() }}</span> 
                dari <span class="font-bold text-gray-900">{{ $detections->total() }}</span> data
            </div>
            <div>
                {{ $detections->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
