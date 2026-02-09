<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.articles.index') }}" class="p-2 bg-white rounded-xl shadow-sm text-slate-400 hover:text-primary transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <h2 class="font-black text-3xl text-slate-900 tracking-tight">
                {{ __('Tulis Artikel Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden animate-reveal">
        <div class="p-10 md:p-14">
            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    {{-- Main Content --}}
                    <div class="lg:col-span-2 space-y-6">
                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Judul Artikel</label>
                            <input type="text" name="title" required class="w-full h-16 px-8 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-black text-xl text-slate-900 shadow-inner" placeholder="Masukkan judul yang menarik...">
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Konten Artikel</label>
                            <textarea name="content" rows="15" required class="w-full px-8 py-6 rounded-[2.5rem] bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-medium text-slate-700 leading-relaxed shadow-inner" placeholder="Mulai menulis cerita Anda di sini..."></textarea>
                        </div>
                    </div>

                    {{-- Sidebar Settings --}}
                    <div class="space-y-8">
                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Kategori</label>
                            <input type="text" name="category" required class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900" placeholder="Misal: Wisata, Kuliner">
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Ringkasan (Excerpt)</label>
                            <textarea name="excerpt" rows="4" required class="w-full px-6 py-4 rounded-[1.5rem] bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900 text-sm" placeholder="Tuliskan intisari artikel..."></textarea>
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Cover Image</label>
                            <div class="relative">
                                <input type="file" name="image" class="hidden" id="image">
                                <label for="image" class="w-full h-48 border-2 border-dashed border-slate-200 rounded-[2rem] flex flex-col items-center justify-center gap-3 cursor-pointer hover:bg-slate-50 transition-colors group">
                                    <div class="size-12 rounded-full bg-slate-100 flex items-center justify-center group-hover:bg-primary/10 transition-colors">
                                        <span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors">image</span>
                                    </div>
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Upload Banner</span>
                                </label>
                            </div>
                        </div>

                        <div class="p-6 bg-purple-50 rounded-[2rem] border border-purple-100 italic text-purple-700 text-xs leading-relaxed">
                            <span class="font-black uppercase block mb-1">SEO Tip:</span>
                            Gunakan judul yang mengandung kata kunci populer untuk memudahkan artikel ditemukan di mesin pencari.
                        </div>
                    </div>
                </div>

                <div class="pt-10 border-t border-slate-50 flex items-center justify-end gap-4">
                    <a href="{{ route('admin.articles.index') }}" class="px-8 py-4 font-black text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-widest text-sm">Batal</a>
                    <button type="submit" class="px-12 py-4 bg-primary text-white font-black rounded-full shadow-xl shadow-primary/30 hover:scale-105 active:scale-95 transition-all uppercase tracking-widest">
                        Tayangkan Artikel
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
