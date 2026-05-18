<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-leaf-50 rounded-2xl border border-leaf-100 shadow-sm">
                    <svg class="w-6 h-6 text-leaf-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                </div>
                <div>
                    <h2 class="font-display font-bold text-2xl text-earth-900 tracking-tight">
                        Platform Overview
                    </h2>
                    <p class="text-earth-800/60 text-sm mt-1">Real-time processing & quality analytics</p>
                </div>
            </div>
            <div class="flex gap-4">
                <button x-data @click="$dispatch('open-new-batch')" class="px-6 py-2.5 bg-white text-earth-800 font-semibold text-sm rounded-2xl border border-earth-200 hover:bg-earth-50 transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    New Batch
                </button
            </div>
        </div>
    </x-slot>

    <!-- Main Dashboard Area -->
    <div x-data="dashboardData()" 
         @open-new-batch.window="showNewBatchModal = true"
         x-init="init()"
         class="space-y-8 pb-12 animate-fade-in relative z-10">
         
        <!-- Notifications -->
        @if(session('success'))
        <div x-show="showNotification" x-transition.opacity.duration.500ms class="fixed top-8 right-8 bg-white/90 backdrop-blur-xl border border-leaf-100 text-earth-800 px-6 py-4 rounded-2xl shadow-organic z-50 flex items-center gap-4">
            <div class="w-8 h-8 rounded-full bg-leaf-100 flex items-center justify-center text-leaf-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div class="flex flex-col">
                <span class="text-leaf-600 text-xs font-bold uppercase tracking-wider">Success</span>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Stat 1 -->
            <div class="bg-white p-6 rounded-[2rem] border border-earth-100 shadow-soft relative overflow-hidden group hover:border-leaf-200 transition-all">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-leaf-50 rounded-full mix-blend-multiply transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-10 h-10 rounded-xl bg-white border border-leaf-100 flex items-center justify-center text-leaf-500 mb-4 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h3 class="text-earth-800/60 text-sm font-medium mb-1">Raw Ingredients</h3>
                    <div class="flex items-baseline gap-2">
                        <h2 class="text-3xl font-display font-bold text-earth-900"><span x-text="stats.raw_ingredients">1,245</span><span class="text-lg text-earth-800/40 ml-1">kg</span></h2>
                    </div>
                    <div class="mt-3 flex items-center text-xs font-semibold text-leaf-600">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        +12.5% vs last week
                    </div>
                </div>
            </div>

            <!-- Stat 2 -->
            <div class="bg-white p-6 rounded-[2rem] border border-earth-100 shadow-soft relative overflow-hidden group hover:border-citrus-200 transition-all">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-citrus-50 rounded-full mix-blend-multiply transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-10 h-10 rounded-xl bg-white border border-citrus-100 flex items-center justify-center text-citrus-500 mb-4 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h3 class="text-earth-800/60 text-sm font-medium mb-1">Active Processing</h3>
                    <div class="flex items-baseline gap-2">
                        <h2 class="text-3xl font-display font-bold text-earth-900"><span x-text="stats.active_processing">12</span><span class="text-lg text-earth-800/40 ml-1">Batches</span></h2>
                    </div>
                    <div class="mt-3 flex items-center text-xs font-semibold text-citrus-600">
                        Optimal flow rate
                    </div>
                </div>
            </div>

            <!-- Stat 3 -->
            <div class="bg-white p-6 rounded-[2rem] border border-earth-100 shadow-soft relative overflow-hidden group hover:border-blue-200 transition-all">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full mix-blend-multiply transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-10 h-10 rounded-xl bg-white border border-blue-100 flex items-center justify-center text-blue-500 mb-4 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-earth-800/60 text-sm font-medium mb-1">Average Freshness</h3>
                    <div class="flex items-baseline gap-2">
                        <h2 class="text-3xl font-display font-bold text-earth-900"><span x-text="stats.average_freshness">94.2</span><span class="text-lg text-earth-800/40 ml-1">%</span></h2>
                    </div>
                    <div class="mt-3 flex items-center text-xs font-semibold text-blue-600">
                        High retention
                    </div>
                </div>
            </div>

            <!-- Stat 4 -->
            <div class="bg-white p-6 rounded-[2rem] border border-earth-100 shadow-soft relative overflow-hidden group hover:border-red-200 transition-all">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-red-50 rounded-full mix-blend-multiply transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-10 h-10 rounded-xl bg-white border border-red-100 flex items-center justify-center text-red-500 mb-4 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h3 class="text-earth-800/60 text-sm font-medium mb-1">Food Waste</h3>
                    <div class="flex items-baseline gap-2">
                        <h2 class="text-3xl font-display font-bold text-earth-900"><span x-text="stats.food_waste">2.1</span><span class="text-lg text-earth-800/40 ml-1">%</span></h2>
                    </div>
                    <div class="mt-3 flex items-center text-xs font-semibold text-leaf-600">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                        -0.3% vs last week
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Main Analytics Chart -->
            <div class="lg:col-span-2 bg-white border border-earth-200/50 shadow-soft rounded-[2rem] p-8 relative overflow-hidden">
                <div class="flex justify-between items-center mb-8 relative z-10">
                    <div>
                        <h3 class="text-xl font-display font-bold text-earth-900">Processing Yield Analytics</h3>
                        <p class="text-earth-800/60 text-sm mt-1">Monthly organic output volume</p>
                    </div>
                    <select class="bg-earth-50 border border-earth-200 text-sm font-medium rounded-xl text-earth-800 focus:ring-leaf-500 focus:border-leaf-500 px-4 py-2 cursor-pointer outline-none">
                        <option>Last 6 Months</option>
                        <option>This Year</option>
                    </select>
                </div>
                <div class="relative h-[300px] w-full z-10">
                    <canvas id="processingChart"></canvas>
                </div>
            </div>

            <!-- Insights Sidebar -->
            <div class="space-y-6">
                <!-- AI Recommendations -->
                <div class="bg-gradient-to-br from-leaf-50 to-leaf-100 border border-leaf-200 rounded-[2rem] p-6 shadow-soft relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/40 rounded-full blur-2xl pointer-events-none"></div>
                    <div class="flex items-center gap-3 mb-6 relative z-10">
                        <div class="w-10 h-10 rounded-full bg-leaf-500 text-white flex items-center justify-center shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h3 class="text-base font-bold text-earth-900">AI Quality Insights</h3>
                    </div>
                    
                    <div class="space-y-4 relative z-10">
                        <div class="bg-white/60 backdrop-blur-sm p-4 rounded-2xl border border-white">
                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 mt-1.5 rounded-full bg-citrus-500 flex-shrink-0"></div>
                                <p class="text-sm text-earth-800 leading-relaxed font-medium">
                                    <span class="font-bold">Batch #002</span> temperature slightly high. Decrease ambient cooling by 2°C for optimal freshness.
                                </p>
                            </div>
                        </div>
                        <div class="bg-white/60 backdrop-blur-sm p-4 rounded-2xl border border-white">
                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 mt-1.5 rounded-full bg-leaf-500 flex-shrink-0"></div>
                                <p class="text-sm text-earth-800 leading-relaxed font-medium">
                                    <span class="font-bold">Storage Sec B</span> humidity perfect. Current organic tomatoes will retain 98% quality for 5 more days.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Storage Chart -->
                <div class="bg-white border border-earth-200/50 shadow-soft rounded-[2rem] p-6">
                    <h3 class="text-base font-bold text-earth-900 mb-6">Warehouse Capacity</h3>
                    <div class="relative h-[160px] w-full">
                        <canvas id="inventoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Processing Now Data Table -->
        <div class="bg-white border border-earth-200/50 shadow-soft rounded-[2rem] overflow-hidden mb-8">
            <div class="px-8 py-6 border-b border-earth-100 flex justify-between items-center bg-white">
                <div>
                    <h3 class="text-xl font-display font-bold text-earth-900">Processing Now Data</h3>
                    <p class="text-sm text-earth-800/60 mt-1">Live tracking of active processing batches</p>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-earth-50/50 text-xs text-earth-800/50 font-bold uppercase tracking-wider">
                            <th class="px-8 py-4 border-b border-earth-100">Batch ID</th>
                            <th class="px-8 py-4 border-b border-earth-100">Raw Material</th>
                            <th class="px-8 py-4 border-b border-earth-100">Stage</th>
                            <th class="px-8 py-4 border-b border-earth-100">Temperature</th>
                            <th class="px-8 py-4 border-b border-earth-100">Duration</th>
                            <th class="px-8 py-4 border-b border-earth-100">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-earth-100 text-sm">
                        @forelse($processingNowData as $batch)
                        <tr class="hover:bg-earth-50/50 transition-colors group">
                            <td class="px-8 py-5">
                                <span class="font-mono text-earth-800/60 text-xs font-semibold">#BAT-{{ str_pad($batch->id, 3, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="px-8 py-5 text-earth-900 font-semibold">
                                {{ $batch->rawMaterial ? $batch->rawMaterial->name : 'N/A' }}
                            </td>
                            <td class="px-8 py-5 text-earth-800 font-medium">
                                {{ $batch->stage }}
                            </td>
                            <td class="px-8 py-5 text-earth-800 font-medium">
                                {{ $batch->temperature }}°C
                            </td>
                            <td class="px-8 py-5 text-earth-800 font-medium">
                                {{ $batch->duration }} mins
                            </td>
                            <td class="px-8 py-5">
                                @if($batch->status == 'In Progress')
                                    @php
                                        $isPast = $batch->created_at->addMinutes($batch->duration)->isPast();
                                        $minsLeft = max(0, $batch->created_at->addMinutes($batch->duration)->diffInMinutes(now()));
                                    @endphp
                                    @if($isPast)
                                        <form action="{{ route('batches.complete', $batch->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-leaf-500 text-white hover:bg-leaf-600 transition-colors shadow-sm cursor-pointer">
                                                Complete Processing
                                            </button>
                                        </form>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-citrus-50 text-citrus-600">
                                            <span class="w-1.5 h-1.5 rounded-full bg-citrus-500 mr-2 animate-pulse"></span> Processing
                                            <span class="ml-2 text-[10px] text-citrus-500/70 border-l border-citrus-200 pl-2">{{ $minsLeft }}m left</span>
                                        </span>
                                    @endif
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-leaf-100 text-leaf-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-leaf-500 mr-2"></span> {{ $batch->status }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-8 py-5 text-center text-earth-800/50 text-sm font-medium">
                                No batches are currently processing.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Premium Data Table -->
        <div class="bg-white border border-earth-200/50 shadow-soft rounded-[2rem] overflow-hidden">
            <div class="px-8 py-6 border-b border-earth-100 flex justify-between items-center bg-white">
                <div>
                    <h3 class="text-xl font-display font-bold text-earth-900">Live Quality Monitoring</h3>
                    <p class="text-sm text-earth-800/60 mt-1">Real-time stats from the processing floor</p>
                </div>
                <a href="{{ route('directory.index') }}" class="text-sm font-semibold text-leaf-600 hover:text-leaf-700 bg-leaf-50 hover:bg-leaf-100 px-4 py-2 rounded-xl transition-colors inline-block">
                    View Full Directory
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-earth-50/50 text-xs text-earth-800/50 font-bold uppercase tracking-wider">
                            <th class="px-8 py-4 border-b border-earth-100">Batch ID</th>
                            <th class="px-8 py-4 border-b border-earth-100">Product</th>
                            <th class="px-8 py-4 border-b border-earth-100">Freshness Meter</th>
                            <th class="px-8 py-4 border-b border-earth-100">pH Level</th>
                            <th class="px-8 py-4 border-b border-earth-100">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-earth-100 text-sm">
                        <!-- Row 1 -->
                        <tr class="hover:bg-earth-50/50 transition-colors group">
                            <td class="px-8 py-5">
                                <span class="font-mono text-earth-800/60 text-xs font-semibold">#BAT-001</span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center text-red-500 border border-red-100">
                                        🍅
                                    </div>
                                    <span class="text-earth-900 font-semibold">Organic Tomatoes</span>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <!-- Circular Progress Mockup -->
                                    <div class="relative w-8 h-8 flex items-center justify-center rounded-full border-2 border-leaf-100">
                                        <div class="absolute inset-0 border-2 border-leaf-500 rounded-full" style="clip-path: polygon(50% 0%, 100% 0, 100% 100%, 0 100%, 0 0, 50% 0, 50% 50%); transform: rotate(45deg);"></div>
                                        <span class="text-[10px] font-bold text-earth-900 relative z-10">98</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-earth-900 font-bold">98%</span>
                                        <span class="text-xs text-earth-800/50">Optimal</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-earth-800 font-medium">6.8 <span class="text-xs text-earth-800/50 ml-1">Neutral</span></td>
                            <td class="px-8 py-5">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-leaf-100 text-leaf-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-leaf-500 mr-2"></span> Processing
                                </span>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="hover:bg-earth-50/50 transition-colors group">
                            <td class="px-8 py-5">
                                <span class="font-mono text-earth-800/60 text-xs font-semibold">#BAT-002</span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-500 border border-amber-100">
                                        🌾
                                    </div>
                                    <span class="text-earth-900 font-semibold">Wheat Synthetics</span>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="relative w-8 h-8 flex items-center justify-center rounded-full border-2 border-amber-100">
                                        <div class="absolute inset-0 border-2 border-amber-500 rounded-full" style="clip-path: polygon(50% 0%, 100% 0, 100% 100%, 0 100%, 0 50%, 50% 50%); transform: rotate(15deg);"></div>
                                        <span class="text-[10px] font-bold text-earth-900 relative z-10">85</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-earth-900 font-bold">85%</span>
                                        <span class="text-xs text-earth-800/50">Good</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-earth-800 font-medium">6.5 <span class="text-xs text-earth-800/50 ml-1">Slight Acid</span></td>
                            <td class="px-8 py-5">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-2"></span> Cooling
                                </span>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr class="hover:bg-earth-50/50 transition-colors group">
                            <td class="px-8 py-5">
                                <span class="font-mono text-earth-800/60 text-xs font-semibold">#BAT-003</span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-green-500 border border-green-100">
                                        🥬
                                    </div>
                                    <span class="text-earth-900 font-semibold">Leafy Greens</span>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="relative w-8 h-8 flex items-center justify-center rounded-full border-2 border-red-100">
                                        <div class="absolute inset-0 border-2 border-red-400 rounded-full" style="clip-path: polygon(50% 0%, 100% 0, 100% 50%, 50% 50%); transform: rotate(45deg);"></div>
                                        <span class="text-[10px] font-bold text-earth-900 relative z-10">60</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-earth-900 font-bold">60%</span>
                                        <span class="text-xs text-red-500">Review</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-earth-800 font-medium">5.2 <span class="text-xs text-earth-800/50 ml-1">Acidic</span></td>
                            <td class="px-8 py-5">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-citrus-50 text-citrus-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-citrus-500 mr-2"></span> Quality Check
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Elegant Modal for New Batch -->
        <div x-show="showNewBatchModal" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center">
            <!-- Blur overlay -->
            <div x-show="showNewBatchModal" x-transition.opacity.duration.400ms @click="showNewBatchModal = false" class="absolute inset-0 bg-earth-800/40 backdrop-blur-sm"></div>
            
            <div x-show="showNewBatchModal" x-transition.scale.95.duration.400ms class="relative w-full max-w-lg bg-white rounded-[2rem] shadow-organic p-8 overflow-hidden border border-earth-100">
                <div class="absolute top-0 right-0 w-32 h-32 bg-leaf-50 rounded-full blur-2xl pointer-events-none -mr-10 -mt-10"></div>
                
                <div class="flex justify-between items-center mb-6 relative z-10">
                    <h3 class="text-2xl font-display font-bold text-earth-900">Initiate Batch</h3>
                    <button @click="showNewBatchModal = false" class="text-earth-800/40 hover:text-earth-800 transition-colors bg-earth-50 p-2 rounded-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form action="{{ route('batches.store') }}" method="POST" class="space-y-5 relative z-10">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-earth-800 mb-1.5">Raw Material</label>
                        <textarea name="raw_material" rows="2" class="w-full bg-white border border-earth-200 focus:border-leaf-500 focus:ring-4 focus:ring-leaf-500/20 text-earth-900 rounded-xl px-4 py-3 outline-none transition-all placeholder-earth-800/40 text-sm font-medium shadow-sm" placeholder="Enter raw material details..."></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-earth-800 mb-1.5">Processing Stage</label>
                        <input type="text" name="stage" required class="w-full bg-white border border-earth-200 focus:border-leaf-500 focus:ring-4 focus:ring-leaf-500/20 text-earth-900 rounded-xl px-4 py-3 outline-none transition-all placeholder-earth-800/40 text-sm font-medium shadow-sm" placeholder="e.g. Initial Sorting & Washing">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-earth-800 mb-1.5">Target Temp (°C)</label>
                            <input type="number" name="temperature" step="0.1" required class="w-full bg-white border border-earth-200 focus:border-leaf-500 focus:ring-4 focus:ring-leaf-500/20 text-earth-900 rounded-xl px-4 py-3 outline-none transition-all placeholder-earth-800/40 text-sm font-medium shadow-sm" placeholder="4.0">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-earth-800 mb-1.5">Duration (mins)</label>
                            <input type="number" name="duration" required class="w-full bg-white border border-earth-200 focus:border-leaf-500 focus:ring-4 focus:ring-leaf-500/20 text-earth-900 rounded-xl px-4 py-3 outline-none transition-all placeholder-earth-800/40 text-sm font-medium shadow-sm" placeholder="45">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-earth-800 mb-1.5">Assigned Quality Supervisor</label>
                        <input type="text" name="operator" required class="w-full bg-white border border-earth-200 focus:border-leaf-500 focus:ring-4 focus:ring-leaf-500/20 text-earth-900 rounded-xl px-4 py-3 outline-none transition-all placeholder-earth-800/40 text-sm font-medium shadow-sm" placeholder="Jane Doe">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-earth-800 mb-1.5">Food Input Details</label>
                        <textarea name="food_input" rows="2" class="w-full bg-white border border-earth-200 focus:border-leaf-500 focus:ring-4 focus:ring-leaf-500/20 text-earth-900 rounded-xl px-4 py-3 outline-none transition-all placeholder-earth-800/40 text-sm font-medium shadow-sm" placeholder="Describe the food batch (e.g. 500kg organic tomatoes)"></textarea>
                    </div>
                    <input type="hidden" name="raw_material_id" value="1">

                    <div class="pt-6 flex justify-end gap-3 mt-4">
                        <button type="button" @click="showNewBatchModal = false" class="px-6 py-3 rounded-xl bg-earth-50 text-earth-800 hover:bg-earth-100 transition-all text-sm font-bold">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-3 rounded-xl bg-leaf-500 text-white hover:bg-leaf-600 transition-all text-sm font-bold shadow-lg shadow-leaf-500/30 flex items-center gap-2">
                            Start Processing
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Alpine Data Component & Chart.js Setup -->
    <script>
        function dashboardData() {
            return {
                showNewBatchModal: false,
                showReportModal: false,
                showNotification: true,
                stats: {
                    raw_ingredients: '1,245',
                    active_processing: '12',
                    average_freshness: '94.2',
                    food_waste: '2.1'
                },
                init() {
                    setTimeout(() => this.showNotification = false, 4000);
                    
                    // Poll for real-time stats every 3 seconds
                    setInterval(() => {
                        fetch('{{ route('api.dashboard.stats') }}')
                            .then(res => res.json())
                            .then(data => {
                                this.stats.raw_ingredients = new Intl.NumberFormat().format(data.stats.raw_ingredients);
                                this.stats.active_processing = data.stats.active_processing;
                                this.stats.average_freshness = data.stats.average_freshness;
                                this.stats.food_waste = data.stats.food_waste;
                                
                                // Dispatch event to update charts
                                window.dispatchEvent(new CustomEvent('update-charts', { detail: data.charts }));
                            });
                    }, 3000);
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            Chart.defaults.font.family = "'Inter', sans-serif";
            Chart.defaults.color = '#4b5563'; // earth-800/60 equivalent
            
            const gridColor = 'rgba(0,0,0,0.04)';

            const ctx1 = document.getElementById('processingChart').getContext('2d');
            
            // Fresh Leaf Gradient
            const gradient1 = ctx1.createLinearGradient(0, 0, 0, 400);
            gradient1.addColorStop(0, 'rgba(34, 197, 94, 0.2)'); // leaf-500
            gradient1.addColorStop(1, 'rgba(34, 197, 94, 0.0)');

            const yieldChart = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Processed Output',
                        data: [1200, 1900, 2400, 5000, 3200, 4800],
                        borderColor: '#22c55e', // leaf-500
                        backgroundColor: gradient1,
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#22c55e',
                        pointBorderWidth: 3,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        pointHoverBackgroundColor: '#22c55e',
                        fill: true,
                        tension: 0.4 // Smooth organic curves
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#ffffff',
                            titleColor: '#1a1816',
                            bodyColor: '#4b5563',
                            borderColor: 'rgba(0,0,0,0.05)',
                            borderWidth: 1,
                            padding: 12,
                            displayColors: false,
                            cornerRadius: 12,
                            titleFont: { family: "'Outfit', sans-serif", size: 14, weight: '700' },
                            bodyFont: { family: "'Inter', sans-serif", size: 13, weight: '500' },
                            boxShadow: '0 10px 40px -10px rgba(0,0,0,0.1)'
                        }
                    },
                    scales: { 
                        y: { 
                            beginAtZero: true,
                            grid: { color: gridColor, drawBorder: false },
                            border: { dash: [4, 4] }
                        },
                        x: {
                            grid: { display: false, drawBorder: false }
                        }
                    },
                    interaction: { intersect: false, mode: 'index' },
                }
            });

            const ctx2 = document.getElementById('inventoryChart').getContext('2d');
            const inventoryChart = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ['Sec A', 'Sec B', 'Sec C', 'Cold'],
                    datasets: [{
                        data: [85, 45, 90, 60],
                        backgroundColor: [
                            '#22c55e', // leaf-500
                            '#fb923c', // citrus-400
                            '#86efac', // leaf-300
                            '#3b82f6'  // blue for cold storage
                        ],
                        borderRadius: 8,
                        borderSkipped: false,
                        barThickness: 24
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#ffffff',
                            titleColor: '#1a1816',
                            bodyColor: '#4b5563',
                            borderColor: 'rgba(0,0,0,0.05)',
                            borderWidth: 1,
                            padding: 12,
                            displayColors: false,
                            cornerRadius: 12,
                            bodyFont: { family: "'Inter', sans-serif", size: 13, weight: '500' }
                        }
                    },
                    scales: { 
                        y: { 
                            beginAtZero: true, max: 100,
                            grid: { color: gridColor, drawBorder: false },
                            border: { dash: [4, 4] }
                        },
                        x: {
                            grid: { display: false, drawBorder: false }
                        }
                    }
                }
            });

            // Update charts on Alpine event
            window.addEventListener('update-charts', (e) => {
                if (e.detail.yield) {
                    yieldChart.data.datasets[0].data = e.detail.yield;
                    yieldChart.update();
                }
                if (e.detail.inventory) {
                    inventoryChart.data.datasets[0].data = e.detail.inventory;
                    inventoryChart.update();
                }
            });
        });
    </script>
</x-app-layout>
