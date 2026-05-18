<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SmartFood') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|outfit:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <style>
            [x-cloak] { display: none !important; }
            ::-webkit-scrollbar { width: 6px; height: 6px; }
            ::-webkit-scrollbar-track { background: transparent; }
            ::-webkit-scrollbar-thumb { background: rgba(34, 197, 94, 0.2); border-radius: 10px; }
            ::-webkit-scrollbar-thumb:hover { background: rgba(34, 197, 94, 0.4); }
        </style>
    </head>
    <body class="font-sans antialiased bg-earth-50 text-earth-800 selection:bg-leaf-200 selection:text-leaf-900 overflow-hidden">
        
        <!-- Soft Organic Background -->
        <div class="fixed inset-0 z-[-2] bg-earth-50 overflow-hidden">
            <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-leaf-100 rounded-full mix-blend-multiply filter blur-[100px] opacity-60 animate-blob"></div>
            <div class="absolute -bottom-32 -left-32 w-[600px] h-[600px] bg-citrus-100 rounded-full mix-blend-multiply filter blur-[100px] opacity-40 animate-blob" style="animation-delay: 4s;"></div>
        </div>

        <div class="flex h-screen w-full relative z-10" x-data="{ dockExpanded: false }">
            
            <!-- Clean Glass Floating Dock Navigation -->
            <nav class="absolute left-6 top-1/2 -translate-y-1/2 flex flex-col gap-4 py-6 px-3 bg-white/70 backdrop-blur-2xl border border-white rounded-[2.5rem] shadow-organic transition-all duration-500 hover:bg-white/90 z-50"
                 @mouseenter="dockExpanded = true" @mouseleave="dockExpanded = false">
                
                <div class="mb-8 flex justify-center">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-leaf-400 to-leaf-600 flex items-center justify-center shadow-organic text-white font-bold text-xl">
                        SF
                    </div>
                </div>

                <!-- Nav Items -->
                <a href="{{ url('/') }}" class="group relative flex items-center p-3 rounded-2xl transition-all duration-300 hover:bg-leaf-50 border border-transparent hover:border-leaf-100">
                    <svg class="w-6 h-6 text-earth-800/60 group-hover:text-leaf-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span x-show="dockExpanded" x-transition.opacity.duration.300ms class="absolute left-16 text-sm font-semibold text-earth-800 whitespace-nowrap">Landing Page</span>
                </a>

                <a href="{{ route('dashboard') }}" class="group relative flex items-center p-3 rounded-2xl transition-all duration-300 hover:bg-leaf-50 border border-transparent hover:border-leaf-100">
                    <svg class="w-6 h-6 text-earth-800/60 group-hover:text-leaf-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span x-show="dockExpanded" x-transition.opacity.duration.300ms class="absolute left-16 text-sm font-semibold text-earth-800 whitespace-nowrap">Overview</span>
                </a>
                
                <a href="{{ route('processing.index') }}" class="group relative flex items-center p-3 rounded-2xl transition-all duration-300 hover:bg-leaf-50 border border-transparent hover:border-leaf-100">
                    <svg class="w-6 h-6 text-earth-800/60 group-hover:text-leaf-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    <span x-show="dockExpanded" x-transition.opacity.duration.300ms class="absolute left-16 text-sm font-semibold text-earth-800 whitespace-nowrap">Processing</span>
                </a>

                <a href="{{ route('storage.index') }}" class="group relative flex items-center p-3 rounded-2xl transition-all duration-300 hover:bg-leaf-50 border border-transparent hover:border-leaf-100">
                    <svg class="w-6 h-6 text-earth-800/60 group-hover:text-leaf-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <span x-show="dockExpanded" x-transition.opacity.duration.300ms class="absolute left-16 text-sm font-semibold text-earth-800 whitespace-nowrap">Storage</span>
                </a>

                <div class="mt-auto pt-8 flex justify-center border-t border-earth-200/50 w-full">
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full group relative flex items-center justify-center p-3 rounded-2xl transition-all duration-300 hover:bg-red-50 border border-transparent hover:border-red-100">
                            <svg class="w-6 h-6 text-earth-800/60 group-hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <span x-show="dockExpanded" x-transition.opacity.duration.300ms class="absolute left-16 text-sm font-semibold text-red-500 whitespace-nowrap">Sign Out</span>
                        </button>
                    </form>
                </div>
            </nav>

            <!-- Main Interactive Area -->
            <main class="flex-1 ml-32 p-10 overflow-y-auto overflow-x-hidden h-screen scroll-smooth">
                @isset($header)
                    <header class="mb-10 flex justify-between items-center pb-6 border-b border-earth-200/50">
                        {{ $header }}
                    </header>
                @endisset
                
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
