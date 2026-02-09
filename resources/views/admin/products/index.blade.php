<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-3xl text-slate-900 tracking-tight">
                {{ __('Daftar Produk Shop') }}
            </h2>
            <a href="{{ route('admin.products.create') }}" class="px-6 py-3 bg-primary text-white font-black rounded-2xl shadow-lg shadow-primary/20 hover:scale-105 active:scale-95 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined">add</span>
                Tambah Produk
            </a>
        </div>
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
                            <th class="pb-4 px-4 w-24 text-center">GAMBAR</th>
                            <th class="pb-4 px-4">NAMA PRODUK</th>
                            <th class="pb-4 px-4">KATEGORI</th>
                            <th class="pb-4 px-4">HARGA</th>
                            <th class="pb-4 px-4 text-right">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($products as $product)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-4">
                                    <div class="flex justify-center">
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-2xl shadow-sm border border-slate-100 group-hover:scale-110 transition-transform">
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="font-black text-slate-900">{{ $product->name }}</div>
                                    <div class="text-xs text-slate-400 font-bold uppercase tracking-tighter mt-1 truncate max-w-[200px]">{{ Str::limit($product->description, 50) }}</div>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-[10px] font-black uppercase tracking-widest">
                                        {{ $product->category }}
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="font-black text-primary">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                                </td>
                                <td class="py-4 px-4 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition-all">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus produk ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition-all">
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($products->hasPages())
                <div class="mt-8 border-t border-slate-50 pt-6">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
