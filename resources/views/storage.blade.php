<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-50 rounded-2xl border border-blue-100 shadow-sm">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <div>
                    <h2 class="font-display font-bold text-2xl text-earth-900 tracking-tight">
                        Storage Overview
                    </h2>
                    <p class="text-earth-800/60 text-sm mt-1">Warehouse inventory and climate control</p>
                </div>
            </div>
            <div class="flex gap-4">
                 <button class="px-6 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold text-sm rounded-2xl hover:shadow-lg hover:shadow-blue-500/30 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    Export Inventory
                </button>
            </div>
        </div>
    </x-slot>

    <!-- Main Content Area -->
    <div class="space-y-8 pb-12 animate-fade-in relative z-10">

        <!-- Storage Data Table -->
        <div class="bg-white border border-earth-200/50 shadow-soft rounded-[2rem] overflow-hidden" x-data="storageData" x-init="init()">
            <div class="px-8 py-6 border-b border-earth-100 flex justify-between items-center bg-white">
                <div>
                    <h3 class="text-xl font-display font-bold text-earth-900">Current Inventory</h3>
                    <p class="text-sm text-earth-800/60 mt-1">Detailed view of stored packages and warehouse conditions</p>
                </div>
                <div class="flex items-center gap-2" title="Real-time updates enabled">
                    <span class="relative flex h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span>
                    <span class="text-xs font-semibold text-green-600 uppercase tracking-wide">Live</span>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-earth-50/50 text-xs text-earth-800/50 font-bold uppercase tracking-wider">
                            <th class="px-8 py-4 border-b border-earth-100">Inv ID</th>
                            <th class="px-8 py-4 border-b border-earth-100">Product Name</th>
                            <th class="px-8 py-4 border-b border-earth-100">Section</th>
                            <th class="px-8 py-4 border-b border-earth-100">Climate</th>
                            <th class="px-8 py-4 border-b border-earth-100">Quantity</th>
                            <th class="px-8 py-4 border-b border-earth-100">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-earth-100 text-sm">
                        <template x-for="item in items" :key="item.id">
                            <tr class="hover:bg-earth-50/50 transition-colors group">
                                <td class="px-8 py-5">
                                    <span class="font-mono text-earth-800/60 text-xs font-semibold" x-text="'#INV-' + item.id"></span>
                                </td>
                                <td class="px-8 py-5 text-earth-900 font-semibold" x-text="item.product_name"></td>
                                <td class="px-8 py-5 text-earth-800 font-medium" x-text="item.section"></td>
                                <td class="px-8 py-5">
                                    <div class="flex flex-col gap-1">
                                        <span class="text-earth-800 font-medium text-xs flex items-center gap-1">
                                            <svg class="w-3 h-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                            <span x-text="item.temperature + '°C'"></span>
                                        </span>
                                        <span class="text-earth-800 font-medium text-xs flex items-center gap-1">
                                            <svg class="w-3 h-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                                            <span x-text="item.humidity + '%'"></span>
                                        </span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-earth-800 font-medium" x-text="item.quantity + ' units'"></td>
                                <td class="px-8 py-5">
                                    <span :class="item.status === 'Optimal' ? 'bg-leaf-100 text-leaf-700' : 'bg-amber-100 text-amber-700'" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold transition-colors duration-300">
                                        <span :class="item.status === 'Optimal' ? 'bg-leaf-500' : 'bg-amber-500'" class="w-1.5 h-1.5 rounded-full mr-2"></span> 
                                        <span x-text="item.status"></span>
                                    </span>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="items.length === 0" style="display: none;">
                            <td colspan="6" class="px-8 py-5 text-center text-earth-800/50 text-sm font-medium">
                                No items found in storage.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('storageData', () => ({
                items: [],
                init() {
                    // Fetch immediately on load
                    this.fetchData();
                    
                    // Poll every 3 seconds for a responsive real-time feel
                    setInterval(() => {
                        this.fetchData();
                    }, 3000);
                },
                fetchData() {
                    fetch('/api/storage/data')
                        .then(res => res.json())
                        .then(data => {
                            this.items = data.data;
                        })
                        .catch(err => console.error('Failed to fetch live storage updates:', err));
                }
            }));
        });
    </script>
</x-app-layout>
