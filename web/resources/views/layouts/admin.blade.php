<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - HerbalBolaangMongondow</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Modern Active State - Linear/Notion/Vercel Style */
        .sidebar-link.active {
            background-color: #16a34a;
            color: white;
            font-weight: 600;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08), 0 1px 2px rgba(0, 0, 0, 0.04);
        }
        
        .sidebar-link.active .menu-icon svg {
            color: white;
        }
        
        /* Modern Hover Effects - Light Green */
        .sidebar-link:not(.active):hover {
            background-color: #f0fdf4;
            color: #16a34a;
        }
        
        .sidebar-link:not(.active):hover .menu-icon svg {
            color: #16a34a;
        }
        
        /* Default State */
        .sidebar-link {
            background-color: transparent;
            color: #475569;
            font-weight: 500;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Icon Styling */
        .menu-icon svg {
            color: #475569;
            transition: color 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Clean Icon Container */
        .menu-icon {
            @apply w-6 h-6 flex items-center justify-center;
            transition: all 0.2s ease;
        }
        
        .menu-icon svg {
            @apply text-gray-600;
            transition: all 0.2s ease;
        }
        
        /* Badge Style */
        .menu-badge {
            @apply px-2 py-0.5 bg-blue-500 text-white text-xs font-semibold rounded;
        }
        
        /* Luxury Scrollbar */
        nav::-webkit-scrollbar {
            width: 6px;
        }
        nav::-webkit-scrollbar-track {
            background: rgba(34, 197, 94, 0.05);
            border-radius: 10px;
        }
        nav::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, rgba(34, 197, 94, 0.4), rgba(22, 163, 74, 0.6));
            border-radius: 10px;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }
        nav::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, rgba(34, 197, 94, 0.6), rgba(22, 163, 74, 0.8));
        }
        
        /* Premium Transitions */
        .sidebar-link {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Logo Premium Glow */
        .logo-container {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 50%, #15803d 100%);
            box-shadow: 0 8px 16px rgba(34, 197, 94, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .logo-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: shine 3s infinite;
        }
        
        @keyframes shine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }
        
        /* Glassmorphism Pro */
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
        }
        
        /* User Card Premium */
        .user-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
        }
        
        .user-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(34, 197, 94, 0.1);
            border-color: rgba(34, 197, 94, 0.3);
        }
        
        /* Badge Styles */
        .menu-badge {
            @apply absolute -top-1 -right-1 w-5 h-5 bg-gradient-to-br from-red-500 to-pink-600 text-white text-xs font-bold rounded-full flex items-center justify-center;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        /* Section Divider */
        .section-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(34, 197, 94, 0.1), transparent);
        }
        
        /* Premium Shadow */
        .premium-shadow {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.03);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Premium Sidebar -->
        <aside class="w-72 bg-white hidden lg:block border-r border-gray-200 flex flex-col premium-shadow">
            <div class="h-full flex flex-col">
                <!-- Premium Logo Header -->
                <div class="px-6 py-6 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="logo-container w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h1 class="text-lg font-black text-gray-900 tracking-tight leading-none">HerbalBolaangMongondow</h1>
                            <p class="text-xs text-gray-500 font-semibold mt-1">Admin Dashboard</p>
                        </div>
                    </div>
                </div>

                <!-- Modern Navigation -->
                <nav class="flex-1 overflow-y-auto py-6 px-4">
                    <div class="mb-4 px-5">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Main Menu</p>
                    </div>
                    <div class="space-y-2">
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <div class="menu-icon">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                            <span class="flex-1">Dashboard</span>
                        </a>

                        <a href="{{ route('admin.diseases.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 rounded-xl {{ request()->routeIs('admin.diseases.*') ? 'active' : '' }}">
                            <div class="menu-icon">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <span class="flex-1">Penyakit</span>
                        </a>

                        <a href="{{ route('admin.plants.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 rounded-xl {{ request()->routeIs('admin.plants.*') ? 'active' : '' }}">
                            <div class="menu-icon">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <span class="flex-1">Tanaman Herbal</span>
                        </a>

                        <a href="{{ route('admin.recipes.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 rounded-xl {{ request()->routeIs('admin.recipes.*') ? 'active' : '' }}">
                            <div class="menu-icon">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <span class="flex-1">Racikan</span>
                        </a>

                        <a href="{{ route('admin.detections.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 rounded-xl {{ request()->routeIs('admin.detections.*') ? 'active' : '' }}">
                            <div class="menu-icon">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <span class="flex-1">Deteksi</span>
                        </a>
                    </div>
                </nav>

                <!-- Premium User Card -->
                <div class="p-4 border-t border-gray-100 bg-gradient-to-br from-gray-50/50 to-transparent">
                    <a href="{{ route('admin.profile.edit') }}" class="user-card flex items-center gap-3.5 p-3.5 border border-gray-200 rounded-xl cursor-pointer hover:shadow-md transition-all">
                        <div class="w-11 h-11 bg-gradient-to-br from-green-500 via-green-600 to-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-green-500/30">
                            <span class="text-base font-black text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-gray-900 truncate leading-tight">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate mt-0.5">{{ auth()->user()->email }}</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Premium Header -->
            <header class="glass-effect border-b border-gray-200 sticky top-0 z-10 shadow-lg">
                <div class="px-6 py-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-5">
                            <!-- Premium Mobile Menu Button -->
                            <button id="mobile-menu-button" class="lg:hidden p-3 text-gray-600 hover:text-green-600 hover:bg-gradient-to-br hover:from-green-50 hover:to-emerald-50 rounded-xl transition-all duration-300 border border-gray-200 hover:border-green-300 shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            
                            <div>
                                <h2 class="text-xl font-black text-gray-900 tracking-tight">@yield('page-title', 'Dashboard')</h2>
                                <div class="flex items-center gap-2 mt-1">
                                    <div class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></div>
                                    <p class="text-xs text-gray-600 font-semibold">@yield('page-subtitle', 'Selamat datang kembali')</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="group flex items-center gap-2.5 px-5 py-3 text-sm font-bold text-gray-700 hover:text-gray-900 bg-white hover:bg-gradient-to-br hover:from-gray-50 hover:to-white rounded-xl transition-all duration-300 border border-gray-200 hover:border-gray-300 shadow-md hover:shadow-lg">
                                    <svg class="w-4 h-4 transition-all duration-300 group-hover:translate-x-1 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                <div class="px-5 py-5">
                    <!-- Alerts -->
                    @if(session('success'))
                    <div class="mb-5 bg-green-50 border-l-3 border-green-500 p-4 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="mb-5 bg-red-50 border-l-3 border-red-500 p-4 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                        </div>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="mb-5 bg-red-50 border-l-3 border-red-500 p-4 rounded-lg">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-red-800 mb-2">Terdapat kesalahan:</p>
                                <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Page Content -->
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Premium Mobile Menu -->
    <div id="mobile-menu" class="fixed inset-0 z-50 lg:hidden hidden">
        <div class="fixed inset-0 bg-gray-900/70 backdrop-blur-md transition-opacity" id="mobile-menu-overlay"></div>
        <aside class="fixed inset-y-0 left-0 w-72 bg-white shadow-2xl transform transition-transform">
            <div class="h-full flex flex-col">
                <!-- Premium Mobile Header -->
                <div class="px-6 py-6 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="logo-container w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h1 class="text-lg font-black text-gray-900 tracking-tight leading-none">HerbalBolaangMongondow</h1>
                            <p class="text-xs text-gray-500 font-semibold mt-1">Admin Dashboard</p>
                        </div>
                    </div>
                    
                    <button id="mobile-menu-close" class="p-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modern Mobile Navigation -->
                <nav class="flex-1 overflow-y-auto py-6 px-4">
                    <div class="mb-4 px-5">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Main Menu</p>
                    </div>
                    <div class="space-y-2">
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <div class="menu-icon">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                            <span class="flex-1">Dashboard</span>
                        </a>

                        <a href="{{ route('admin.diseases.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 rounded-xl {{ request()->routeIs('admin.diseases.*') ? 'active' : '' }}">
                            <div class="menu-icon">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <span class="flex-1">Penyakit</span>
                        </a>

                        <a href="{{ route('admin.plants.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 rounded-xl {{ request()->routeIs('admin.plants.*') ? 'active' : '' }}">
                            <div class="menu-icon">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <span class="flex-1">Tanaman Herbal</span>
                        </a>

                        <a href="{{ route('admin.recipes.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 rounded-xl {{ request()->routeIs('admin.recipes.*') ? 'active' : '' }}">
                            <div class="menu-icon">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <span class="flex-1">Racikan</span>
                        </a>

                        <a href="{{ route('admin.detections.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 rounded-xl {{ request()->routeIs('admin.detections.*') ? 'active' : '' }}">
                            <div class="menu-icon">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <span class="flex-1">Deteksi</span>
                        </a>
                    </div>
                </nav>

                <!-- Premium Mobile User Card -->
                <div class="p-4 border-t border-gray-100 bg-gradient-to-br from-gray-50/50 to-transparent">
                    <a href="{{ route('admin.profile.edit') }}" class="user-card flex items-center gap-3.5 p-3.5 border border-gray-200 rounded-xl cursor-pointer hover:shadow-md transition-all">
                        <div class="w-11 h-11 bg-gradient-to-br from-green-500 via-green-600 to-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-green-500/30">
                            <span class="text-base font-black text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-gray-900 truncate leading-tight">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate mt-0.5">{{ auth()->user()->email }}</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </aside>
    </div>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuClose = document.getElementById('mobile-menu-close');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

        mobileMenuButton?.addEventListener('click', () => {
            mobileMenu?.classList.remove('hidden');
        });

        mobileMenuClose?.addEventListener('click', () => {
            mobileMenu?.classList.add('hidden');
        });

        mobileMenuOverlay?.addEventListener('click', () => {
            mobileMenu?.classList.add('hidden');
        });
    </script>
</body>
</html>
