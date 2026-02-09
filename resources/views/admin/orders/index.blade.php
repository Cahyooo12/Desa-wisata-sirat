<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-black text-3xl text-slate-900 tracking-tight">
            {{ __('Manajemen Pesanan') }}
        </h2>
    </x-slot>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden animate-reveal">
        <div class="p-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center gap-3">
                    <span class="material-symbols-outlined text-emerald-500">check_circle</span>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-slate-400 text-xs font-bold uppercase tracking-widest border-b border-slate-50">
                            <th class="pb-4 px-4">ORDER ID</th>
                            <th class="pb-4 px-4">TANGGAL</th>
                            <th class="pb-4 px-4">PELANGGAN</th>
                            <th class="pb-4 px-4">TOTAL</th>
                            <th class="pb-4 px-4">STATUS</th>
                            <th class="pb-4 px-4 text-right">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($orders as $order)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-4">
                                    <div class="font-black text-slate-900">#{{ $order->id }}</div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="text-sm font-bold text-slate-600">{{ $order->created_at->format('d M Y') }}</div>
                                    <div class="text-[10px] text-slate-400 uppercase tracking-widest font-bold">{{ $order->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="font-black text-slate-800">{{ $order->user ? $order->user->name : 'Guest' }}</div>
                                    <div class="text-xs text-slate-500">{{ $order->user ? $order->user->email : 'Pembelian Langsung' }}</div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="font-black text-primary">Rp{{ number_format($order->total_price, 0, ',', '.') }}</div>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest 
                                        {{ $order->status == 'completed' ? 'bg-emerald-100 text-emerald-700' : 
                                           ($order->status == 'pending' ? 'bg-orange-100 text-orange-700' : 'bg-slate-100 text-slate-700') }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-right">
                                    <div class="flex items-center justify-end opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="flex items-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition-all text-xs font-black uppercase tracking-widest">
                                            Rincian
                                            <span class="material-symbols-outlined text-[18px]">visibility</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($orders->hasPages())
                <div class="mt-8 border-t border-slate-50 pt-6">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
