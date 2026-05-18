<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-50 rounded-2xl border border-blue-100 shadow-sm">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                </div>
                <div>
                    <h2 class="font-display font-bold text-2xl text-earth-900 tracking-tight">
                        Logistics & Distribution
                    </h2>
                    <p class="text-earth-800/60 text-sm mt-1">Distributor Portal - Manage outgoing shipments</p>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Main Content Area -->
    <div class="space-y-8 pb-12 animate-fade-in relative z-10">
        
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Stat 1 -->
            <div class="bg-white p-6 rounded-[2rem] border border-earth-100 shadow-soft relative overflow-hidden group hover:border-blue-200 transition-all">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full mix-blend-multiply transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-10 h-10 rounded-xl bg-white border border-blue-100 flex items-center justify-center text-blue-500 mb-4 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </div>
                    <h3 class="text-earth-800/60 text-sm font-medium mb-1">Total Deliveries</h3>
                    <div class="flex items-baseline gap-2">
                        <h2 class="text-3xl font-display font-bold text-earth-900">{{ $distributions->count() }}<span class="text-lg text-earth-800/40 ml-1">Orders</span></h2>
                    </div>
                </div>
            </div>

            <!-- Stat 2 -->
            <div class="bg-white p-6 rounded-[2rem] border border-earth-100 shadow-soft relative overflow-hidden group hover:border-amber-200 transition-all">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-50 rounded-full mix-blend-multiply transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-10 h-10 rounded-xl bg-white border border-amber-100 flex items-center justify-center text-amber-500 mb-4 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-earth-800/60 text-sm font-medium mb-1">In Transit</h3>
                    <div class="flex items-baseline gap-2">
                        <h2 class="text-3xl font-display font-bold text-earth-900">{{ $distributions->where('status', 'In Transit')->count() }}<span class="text-lg text-earth-800/40 ml-1">Active</span></h2>
                    </div>
                </div>
            </div>

            <!-- Stat 3 -->
            <div class="bg-white p-6 rounded-[2rem] border border-earth-100 shadow-soft relative overflow-hidden group hover:border-leaf-200 transition-all">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-leaf-50 rounded-full mix-blend-multiply transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-10 h-10 rounded-xl bg-white border border-leaf-100 flex items-center justify-center text-leaf-500 mb-4 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h3 class="text-earth-800/60 text-sm font-medium mb-1">Delivered Successfully</h3>
                    <div class="flex items-baseline gap-2">
                        <h2 class="text-3xl font-display font-bold text-earth-900">{{ $distributions->where('status', 'Delivered')->count() }}<span class="text-lg text-earth-800/40 ml-1">Orders</span></h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Distributions Data Table -->
        <div class="bg-white border border-earth-200/50 shadow-soft rounded-[2rem] overflow-hidden">
            <div class="px-8 py-6 border-b border-earth-100 flex justify-between items-center bg-white">
                <div>
                    <h3 class="text-xl font-display font-bold text-earth-900">Distribution Queue</h3>
                    <p class="text-sm text-earth-800/60 mt-1">Manage shipments and delivery tracking</p>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-earth-50/50 text-xs text-earth-800/50 font-bold uppercase tracking-wider">
                            <th class="px-8 py-4 border-b border-earth-100">Shipment ID</th>
                            <th class="px-8 py-4 border-b border-earth-100">Destination</th>
                            <th class="px-8 py-4 border-b border-earth-100">Product Detail</th>
                            <th class="px-8 py-4 border-b border-earth-100">Vehicle</th>
                            <th class="px-8 py-4 border-b border-earth-100">ETA</th>
                            <th class="px-8 py-4 border-b border-earth-100">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-earth-100 text-sm">
                        @forelse($distributions as $dist)
                        <tr class="hover:bg-earth-50/50 transition-colors group">
                            <td class="px-8 py-5">
                                <span class="font-mono text-earth-800/60 text-xs font-semibold">#SHP-{{ str_pad($dist->id, 3, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="px-8 py-5 text-earth-900 font-semibold">
                                {{ $dist->destination }}
                            </td>
                            <td class="px-8 py-5 text-earth-800 font-medium">
                                {{ $dist->warehouseInventory?->packaging?->processingBatch?->rawMaterial?->name ?? 'Mixed Payload' }}
                            </td>
                            <td class="px-8 py-5 text-earth-800 font-medium">
                                {{ $dist->vehicle_details }}
                            </td>
                            <td class="px-8 py-5 text-earth-800 font-medium">
                                {{ \Carbon\Carbon::parse($dist->delivery_eta)->format('M d, Y H:i') }}
                            </td>
                            <td class="px-8 py-5">
                                @if($dist->status == 'Delivered')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-leaf-100 text-leaf-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-leaf-500 mr-2"></span> Delivered
                                    </span>
                                @elseif($dist->status == 'In Transit')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-2 animate-pulse"></span> In Transit
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-earth-100 text-earth-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-earth-500 mr-2"></span> {{ $dist->status }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-8 py-5 text-center text-earth-800/50 text-sm font-medium">
                                No distributions found in the queue.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
