<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-black text-3xl text-slate-900 tracking-tight">Dashboard Overview</h2>
    </x-slot>

    <div class="space-y-8">
        <!-- Stats Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Products Stat --}}
            <a href="{{ route('admin.products.index') }}" class="bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 block group">
                <div class="flex items-center gap-4">
                    <div class="size-14 rounded-full bg-blue-500 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-white text-2xl">shopping_bag</span>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Total Produk</p>
                        <h4 class="text-3xl font-black text-slate-900">{{ $stats['total_products'] }}</h4>
                    </div>
                </div>
            </a>

            {{-- Events Stat --}}
            <a href="{{ route('admin.events.index') }}" class="bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 block group">
                <div class="flex items-center gap-4">
                    <div class="size-14 rounded-full bg-orange-500 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-white text-2xl">calendar_month</span>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Total Event</p>
                        <h4 class="text-3xl font-black text-slate-900">{{ $stats['total_events'] }}</h4>
                    </div>
                </div>
            </a>

            {{-- Articles Stat --}}
            <a href="{{ route('admin.articles.index') }}" class="bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 block group">
                <div class="flex items-center gap-4">
                    <div class="size-14 rounded-full bg-purple-500 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-white text-2xl">newspaper</span>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Total Artikel</p>
                        <h4 class="text-3xl font-black text-slate-900">{{ $stats['total_articles'] }}</h4>
                    </div>
                </div>
            </a>
        </div>

        <!-- Welcome Card -->
        <div class="bg-white rounded-[2rem] p-10 shadow-sm">
            <h3 class="text-xl font-black text-slate-900 mb-3">Selamat Datang di Admin Panel</h3>
            <p class="text-slate-500 text-sm leading-relaxed">
                Gunakan menu di samping untuk mengelola Produk, Event, dan Berita. Perubahan yang Anda buat akan langsung tersimpan di sistem dan muncul di halaman publik.
            </p>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                <h3 class="font-black text-slate-900 uppercase tracking-widest text-xs">Pesanan Terbaru</h3>
                <a href="{{ route('admin.orders.index') }}" class="text-primary text-xs font-black uppercase tracking-widest hover:underline">Lihat Semua &rarr;</a>
            </div>
            <div class="p-0">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50/50">
                            <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                                <th class="py-4 px-8">ORDER ID</th>
                                <th class="py-4 px-8">PELANGGAN</th>
                                <th class="py-4 px-8">TOTAL</th>
                                <th class="py-4 px-8">STATUS</th>
                                <th class="py-4 px-8 text-right">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($recent_orders as $order)
                                <tr class="group hover:bg-slate-50/50 transition-colors">
                                    <td class="py-4 px-8">
                                        <span class="font-black text-slate-900 font-mono">#{{ $order->id }}</span>
                                    </td>
                                    <td class="py-4 px-8">
                                        <div class="font-bold text-slate-800 text-sm">{{ $order->user ? $order->user->name : 'Guest' }}</div>
                                    </td>
                                    <td class="py-4 px-8">
                                        <div class="font-black text-primary text-sm">Rp{{ number_format($order->total_price, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="py-4 px-8">
                                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest 
                                            {{ $order->status == 'completed' ? 'bg-emerald-100 text-emerald-700' : 
                                               ($order->status == 'pending' ? 'bg-orange-100 text-orange-700' : 'bg-slate-100 text-slate-700') }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-8 text-right">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex size-10 items-center justify-center bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition-all">
                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-slate-400 text-sm font-bold italic">Belum ada pesanan masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
