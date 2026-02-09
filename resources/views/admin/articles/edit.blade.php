<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.articles.index') }}" class="p-2 bg-white rounded-xl shadow-sm text-slate-400 hover:text-primary transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <h2 class="font-black text-3xl text-slate-900 tracking-tight">
                {{ __('Edit Artikel') }}
            </h2>
        </div>
    </x-slot>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden animate-reveal">
        <div class="p-10 md:p-14">
            <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    {{-- Main Content --}}
                    <div class="lg:col-span-2 space-y-6">
                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Judul Artikel</label>
                            <input type="text" name="title" value="{{ $article->title }}" required class="w-full h-16 px-8 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-black text-xl text-slate-900 shadow-inner">
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Konten Artikel</label>
                            <textarea name="content" rows="15" required class="w-full px-8 py-6 rounded-[2.5rem] bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-medium text-slate-700 leading-relaxed shadow-inner">{{ $article->content }}</textarea>
                        </div>
                    </div>

                    {{-- Sidebar Settings --}}
                    <div class="space-y-8">
                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Kategori</label>
                            <input type="text" name="category" value="{{ $article->category }}" required class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900">
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Ringkasan (Excerpt)</label>
                            <textarea name="excerpt" rows="4" required class="w-full px-6 py-4 rounded-[1.5rem] bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900 text-sm">{{ $article->excerpt }}</textarea>
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Banner Image</label>
                            <div class="space-y-4">
                                @if($article->image)
                                    <div class="relative group w-full h-32 rounded-[1.5rem] overflow-hidden shadow-md">
                                        <img src="{{ asset($article->image) }}" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <span class="text-[10px] font-black text-white uppercase tracking-widest truncate px-4">Banner Saat Ini</span>
                                        </div>
                                    </div>
                                @endif
                                <div class="relative">
                                    <input type="file" name="image" class="hidden" id="image">
                                    <label for="image" class="w-full h-24 border-2 border-dashed border-slate-200 rounded-[1.5rem] flex flex-col items-center justify-center gap-1 cursor-pointer hover:bg-slate-50 transition-colors group">
                                        <span class="material-symbols-outlined text-slate-400 text-xl">cloud_upload</span>
                                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Ganti Banner</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 bg-slate-50 rounded-[2rem] border border-slate-100 italic text-slate-500 text-xs leading-relaxed">
                            <span class="font-black uppercase block mb-1">Status:</span>
                            Artikel ini dipublikasikan pada {{ $article->created_at->format('d M Y, H:i') }} WIB.
                        </div>
                    </div>
                </div>

                <div class="pt-10 border-t border-slate-50 flex items-center justify-end gap-4">
                    <a href="{{ route('admin.articles.index') }}" class="px-8 py-4 font-black text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-widest text-sm">Batal</a>
                    <button type="submit" class="px-12 py-4 bg-primary text-white font-black rounded-full shadow-xl shadow-primary/30 hover:scale-105 active:scale-95 transition-all uppercase tracking-widest">
                        Perbarui Artikel
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
