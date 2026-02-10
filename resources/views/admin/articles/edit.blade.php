<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.articles.index') }}" class="p-2 bg-white rounded-xl shadow-sm text-slate-400 hover:text-primary transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <h2 class="font-black text-3xl text-slate-900 tracking-tight">
                {{ __('Edit Berita') }}
            </h2>
        </div>
    </x-slot>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden animate-reveal">
        <div class="p-10 md:p-14">
            <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Left Column --}}
                    <div class="space-y-6">
                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Judul Berita</label>
                            <input type="text" name="title" value="{{ $article->title }}" required class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900" placeholder="Judul berita...">
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Kategori</label>
                            <select name="category" class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900">
                                <option value="News" {{ $article->category == 'News' ? 'selected' : '' }}>News</option>
                                <option value="Event" {{ $article->category == 'Event' ? 'selected' : '' }}>Event</option>
                                <option value="Tips" {{ $article->category == 'Tips' ? 'selected' : '' }}>Tips</option>
                                <option value="Story" {{ $article->category == 'Story' ? 'selected' : '' }}>Story</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Ringkasan (Excerpt)</label>
                            <textarea name="excerpt" rows="3" class="w-full px-6 py-4 rounded-[2rem] bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900" placeholder="Ringkasan singkat...">{{ $article->excerpt }}</textarea>
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Konten Lengkap</label>
                            <textarea name="content" rows="10" class="w-full px-6 py-4 rounded-[2rem] bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900" placeholder="Isi berita lengkap...">{{ $article->content }}</textarea>
                        </div>
                    </div>

                    {{-- Right Column --}}
                    <div class="space-y-6">
                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Gambar Utama</label>
                            <div class="space-y-4">
                                @if($article->image)
                                    <div class="p-4 bg-slate-50 rounded-[2rem] border border-slate-200">
                                        <p class="text-xs font-bold text-slate-400 mb-2 uppercase tracking-widest">Gambar Saat Ini</p>
                                        <img src="{{ $article->image }}" alt="Preview" class="w-full h-48 object-cover rounded-xl shadow-sm">
                                    </div>
                                @endif
                                
                                <input type="text" name="image" value="{{ $article->image }}" placeholder="Paste URL Gambar (Opsional)" class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900 text-sm">
                                <div class="relative">
                                    <input type="file" name="image_file" class="hidden" id="image_file">
                                    <label for="image_file" class="w-full h-32 border-2 border-dashed border-slate-200 rounded-[2rem] flex flex-col items-center justify-center gap-2 cursor-pointer hover:bg-slate-50 transition-colors">
                                        <span class="material-symbols-outlined text-slate-400 text-3xl">cloud_upload</span>
                                        <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Ganti Gambar (Upload)</span>
                                    </label>
                                </div>
                                Kembali
                            </button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update Berita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
