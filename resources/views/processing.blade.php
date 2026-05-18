<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-citrus-50 rounded-2xl border border-citrus-100 shadow-sm">
                    <svg class="w-6 h-6 text-citrus-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
                <div>
                    <h2 class="font-display font-bold text-2xl text-earth-900 tracking-tight">
                        Processing Overview
                    </h2>
                    <p class="text-earth-800/60 text-sm mt-1">All batches and processing logs</p>
                </div>
            </div>
            <div class="flex gap-4">
                 <button x-data @click="$dispatch('open-new-batch')" class="px-6 py-2.5 bg-gradient-to-r from-citrus-400 to-citrus-500 text-white font-semibold text-sm rounded-2xl hover:shadow-lg hover:shadow-citrus-500/30 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    New Batch
                </button>
            </div>
        </div>
    </x-slot>

    <!-- Main Content Area -->
    <div x-data="{ showNewBatchModal: false, showNotification: true }" 
         @open-new-batch.window="showNewBatchModal = true"
         x-init="setTimeout(() => showNotification = false, 4000)"
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

        <!-- Processing Data Table -->
        <div class="bg-white border border-earth-200/50 shadow-soft rounded-[2rem] overflow-hidden">
            <div class="px-8 py-6 border-b border-earth-100 flex justify-between items-center bg-white">
                <div>
                    <h3 class="text-xl font-display font-bold text-earth-900">All Processing Data</h3>
                    <p class="text-sm text-earth-800/60 mt-1">Complete history of processed and active batches</p>
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
                            <th class="px-8 py-4 border-b border-earth-100">Operator</th>
                            <th class="px-8 py-4 border-b border-earth-100">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-earth-100 text-sm">
                        @forelse($batches as $batch)
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
                            <td class="px-8 py-5 text-earth-800 font-medium">
                                {{ $batch->operator }}
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
                            <td colspan="7" class="px-8 py-5 text-center text-earth-800/50 text-sm font-medium">
                                No processing batches found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Elegant Modal for New Batch -->
        <div x-show="showNewBatchModal" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center">
            <!-- Blur overlay -->
            <div x-show="showNewBatchModal" x-transition.opacity.duration.400ms @click="showNewBatchModal = false" class="absolute inset-0 bg-earth-800/40 backdrop-blur-sm"></div>
            
            <div x-show="showNewBatchModal" x-transition.scale.95.duration.400ms class="relative w-full max-w-lg bg-white rounded-[2rem] shadow-organic p-8 overflow-hidden border border-earth-100">
                <div class="absolute top-0 right-0 w-32 h-32 bg-citrus-50 rounded-full blur-2xl pointer-events-none -mr-10 -mt-10"></div>
                
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
                        <textarea name="raw_material" rows="2" class="w-full bg-white border border-citrus-200 focus:border-citrus-500 focus:ring-4 focus:ring-citrus-500/20 text-earth-900 rounded-xl px-4 py-3 outline-none transition-all placeholder-earth-800/40 text-sm font-medium shadow-sm" placeholder="Enter raw material details..."></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-earth-800 mb-1.5">Processing Stage</label>
                        <input type="text" name="stage" required class="w-full bg-white border border-earth-200 focus:border-citrus-500 focus:ring-4 focus:ring-citrus-500/20 text-earth-900 rounded-xl px-4 py-3 outline-none transition-all placeholder-earth-800/40 text-sm font-medium shadow-sm" placeholder="e.g. Initial Sorting & Washing">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-earth-800 mb-1.5">Target Temp (°C)</label>
                            <input type="number" name="temperature" step="0.1" required class="w-full bg-white border border-earth-200 focus:border-citrus-500 focus:ring-4 focus:ring-citrus-500/20 text-earth-900 rounded-xl px-4 py-3 outline-none transition-all placeholder-earth-800/40 text-sm font-medium shadow-sm" placeholder="4.0">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-earth-800 mb-1.5">Duration (mins)</label>
                            <input type="number" name="duration" required class="w-full bg-white border border-earth-200 focus:border-citrus-500 focus:ring-4 focus:ring-citrus-500/20 text-earth-900 rounded-xl px-4 py-3 outline-none transition-all placeholder-earth-800/40 text-sm font-medium shadow-sm" placeholder="45">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-earth-800 mb-1.5">Assigned Quality Supervisor</label>
                        <input type="text" name="operator" required class="w-full bg-white border border-earth-200 focus:border-citrus-500 focus:ring-4 focus:ring-citrus-500/20 text-earth-900 rounded-xl px-4 py-3 outline-none transition-all placeholder-earth-800/40 text-sm font-medium shadow-sm" placeholder="Jane Doe">
                    </div>
                    <input type="hidden" name="raw_material_id" value="1">
                    <input type="hidden" name="redirect_to" value="processing">

                    <div class="pt-6 flex justify-end gap-3 mt-4">
                        <button type="button" @click="showNewBatchModal = false" class="px-6 py-3 rounded-xl bg-earth-50 text-earth-800 hover:bg-earth-100 transition-all text-sm font-bold">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-3 rounded-xl bg-citrus-500 text-white hover:bg-citrus-600 transition-all text-sm font-bold shadow-lg shadow-citrus-500/30 flex items-center gap-2">
                            Start Processing
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
