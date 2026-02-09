<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.orders.index') }}" class="p-2 bg-white rounded-xl shadow-sm text-slate-400 hover:text-primary transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <h2 class="font-black text-3xl text-slate-900 tracking-tight">
                {{ __('Detail Pesanan') }} <span class="text-primary">#{{ $order->id }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="space-y-8 animate-reveal">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Order Summary --}}
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                        <h3 class="font-black text-slate-900 uppercase tracking-widest text-sm">Item Pesanan</h3>
                        <span class="px-4 py-1 bg-slate-100 text-slate-600 rounded-full text-[10px] font-black uppercase tracking-widest">
                            {{ count($order->items) }} Produk
                        </span>
                    </div>
                    <div class="p-8">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                                    <th class="pb-4 px-2">PRODUK</th>
                                    <th class="pb-4 px-2 text-center">JUMLAH</th>
                                    <th class="pb-4 px-2 text-right">SUBTOTAL</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach($order->items as $item)
                                    <tr>
                                        <td class="py-6 px-2">
                                            <div class="flex items-center gap-4">
                                                @if($item->product && $item->product->image)
                                                    <img src="{{ $item->product->image }}" class="size-14 object-cover rounded-2xl shadow-sm border border-slate-100">
                                                @else
                                                    <div class="size-14 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400">
                                                        <span class="material-symbols-outlined">inventory_2</span>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="font-black text-slate-900">{{ $item->product ? $item->product->name : 'Produk Terhapus' }}</div>
                                                    <div class="text-xs text-slate-400 font-bold">Rp{{ number_format($item->price, 0, ',', '.') }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-6 px-2 text-center">
                                            <span class="font-black font-mono text-slate-600 bg-slate-50 px-3 py-1 rounded-lg">x{{ $item->quantity }}</span>
                                        </td>
                                        <td class="py-6 px-2 text-right">
                                            <div class="font-black text-slate-900">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="pt-8 text-right font-black text-slate-400 uppercase tracking-widest text-xs">Total Pembayaran</td>
                                    <td class="pt-8 text-right font-black text-2xl text-primary tracking-tight">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Order Actions & Customer Info --}}
            <div class="space-y-8">
                {{-- Status Update --}}
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-4 ml-2">Update Status Pesanan</label>
                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" onchange="this.form.submit()" class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-black text-sm text-slate-900 appearance-none">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>🕒 Pending</option>
                            <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>💳 Paid</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>🚚 Shipped</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>✅ Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                        </select>
                    </form>
                    <p class="mt-4 text-[10px] text-slate-400 italic px-2">Memilih status akan secara otomatis memperbarui data dan memberitahu sistem.</p>
                </div>

                {{-- Customer Info --}}
                <div class="bg-primary p-8 rounded-[2.5rem] shadow-xl shadow-primary/20 text-white">
                    <h4 class="text-[10px] font-black uppercase tracking-widest opacity-60 mb-6">Informasi Pelanggan</h4>
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="size-12 rounded-2xl bg-white/20 flex items-center justify-center">
                                <span class="material-symbols-outlined">person</span>
                            </div>
                            <div>
                                <div class="text-xs opacity-60 font-bold uppercase tracking-tighter">Nama</div>
                                <div class="font-black">{{ $order->user ? $order->user->name : 'Guest' }}</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="size-12 rounded-2xl bg-white/20 flex items-center justify-center">
                                <span class="material-symbols-outlined">mail</span>
                            </div>
                            <div class="overflow-hidden">
                                <div class="text-xs opacity-60 font-bold uppercase tracking-tighter">Email</div>
                                <div class="font-black truncate">{{ $order->user ? $order->user->email : 'Pembelian Langsung' }}</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="size-12 rounded-2xl bg-white/20 flex items-center justify-center">
                                <span class="material-symbols-outlined">calendar_today</span>
                            </div>
                            <div>
                                <div class="text-xs opacity-60 font-bold uppercase tracking-tighter">Tanggal Order</div>
                                <div class="font-black">{{ $order->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
