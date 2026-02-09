<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.products.index') }}" class="p-2 bg-white rounded-xl shadow-sm text-slate-400 hover:text-primary transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <h2 class="font-black text-3xl text-slate-900 tracking-tight">
                {{ __('Edit Produk') }}
            </h2>
        </div>
    </x-slot>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden animate-reveal">
        <div class="p-10 md:p-14">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Left Column --}}
                    <div class="space-y-6">
                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Nama Produk</label>
                            <input type="text" name="name" value="{{ $product->name }}" required class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900">
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Kategori</label>
                            <select name="category" class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900">
                                <option value="Drink" {{ $product->category == 'Drink' ? 'selected' : '' }}>Drink</option>
                                <option value="Care" {{ $product->category == 'Care' ? 'selected' : '' }}>Care</option>
                                <option value="Seed" {{ $product->category == 'Seed' ? 'selected' : '' }}>Seed</option>
                                <option value="Other" {{ $product->category == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Harga (Rp)</label>
                                <input type="number" name="price" value="{{ $product->price }}" required class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900">
                            </div>
                            <div>
                                <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Stok</label>
                                <input type="number" name="stock" value="{{ $product->stock }}" class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900">
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Ukuran / Berat</label>
                            <input type="text" name="size" value="{{ $product->size }}" class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900" placeholder="Misal: 250ml, 100gr">
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Deskripsi Ringkas</label>
                            <textarea name="description" rows="4" class="w-full px-6 py-4 rounded-[2rem] bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900">{{ $product->description }}</textarea>
                        </div>
                    </div>

                    {{-- Right Column --}}
                    <div class="space-y-6">
                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Media Produk</label>
                            <div class="space-y-4">
                                @if($product->image)
                                    <div class="relative group size-32 mx-auto">
                                        <img src="{{ $product->image }}" class="w-full h-full object-cover rounded-[2rem] shadow-md border-2 border-slate-50">
                                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity rounded-[2rem] flex items-center justify-center">
                                            <span class="text-[10px] font-black text-white uppercase tracking-widest">Current</span>
                                        </div>
                                    </div>
                                @endif
                                <input type="text" name="image" value="{{ $product->image }}" placeholder="Paste URL Gambar Baru" class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900 text-sm">
                                <div class="relative">
                                    <input type="file" name="image_file" class="hidden" id="image_file">
                                    <label for="image_file" class="w-full h-32 border-2 border-dashed border-slate-200 rounded-[2rem] flex flex-col items-center justify-center gap-2 cursor-pointer hover:bg-slate-50 transition-colors">
                                        <span class="material-symbols-outlined text-slate-400 text-3xl">cloud_upload</span>
                                        <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Ganti File Gambar</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Komposisi & Penggunaan</label>
                            <div class="space-y-4">
                                <textarea name="ingredients" rows="2" class="w-full px-6 py-4 rounded-[1.5rem] bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900 text-sm" placeholder="Komposisi...">{{ $product->ingredients }}</textarea>
                                <textarea name="usage" rows="2" class="w-full px-6 py-4 rounded-[1.5rem] bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900 text-sm" placeholder="Cara pakai...">{{ $product->usage }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-10 border-t border-slate-50 flex items-center justify-end gap-4">
                    <a href="{{ route('admin.products.index') }}" class="px-8 py-4 font-black text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-widest text-sm">Batal</a>
                    <button type="submit" class="px-12 py-4 bg-primary text-white font-black rounded-full shadow-xl shadow-primary/30 hover:scale-105 active:scale-95 transition-all uppercase tracking-widest">
                        Perbarui Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
