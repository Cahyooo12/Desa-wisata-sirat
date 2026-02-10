<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.articles.index') }}" class="p-2 bg-white rounded-xl shadow-sm text-slate-400 hover:text-primary transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <h2 class="font-black text-3xl text-slate-900 tracking-tight">
                {{ __('Tambah Berita Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden animate-reveal">
        <div class="p-10 md:p-14">
            @if ($errors->any())
                <div class="mb-8 p-6 bg-rose-50 border border-rose-100 rounded-2xl animate-fade-in-down">
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-rose-500 mt-0.5">error</span>
                        <div>
                            <h3 class="font-black text-rose-900 text-lg mb-1">Terjadi Kesalahan</h3>
                            <ul class="list-disc list-inside text-rose-700 font-bold text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Left Column --}}
                    <div class="space-y-6">
                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Judul Berita</label>
                            <input type="text" name="title" value="{{ old('title') }}" required class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900" placeholder="Judul berita...">
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Kategori</label>
                            <select name="category" class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900">
                                <option value="News" {{ old('category') == 'News' ? 'selected' : '' }}>News</option>
                                <option value="Event" {{ old('category') == 'Event' ? 'selected' : '' }}>Event</option>
                                <option value="Tips" {{ old('category') == 'Tips' ? 'selected' : '' }}>Tips</option>
                                <option value="Story" {{ old('category') == 'Story' ? 'selected' : '' }}>Story</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Ringkasan (Excerpt)</label>
                            <textarea name="excerpt" rows="3" class="w-full px-6 py-4 rounded-[2rem] bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900" placeholder="Ringkasan singkat...">{{ old('excerpt') }}</textarea>
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Konten Lengkap</label>
                            <textarea name="content" rows="10" class="w-full px-6 py-4 rounded-[2rem] bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900" placeholder="Isi berita lengkap...">{{ old('content') }}</textarea>
                        </div>
                    </div>

                    {{-- Right Column --}}
                    <div class="space-y-6">
                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Gambar Utama</label>
                            <div class="space-y-4">
                                <input type="text" name="image" value="{{ old('image') }}" placeholder="Paste URL Gambar (Opsional)" class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900 text-sm">
                                <div class="relative">
                                    <input type="file" name="image_file" class="hidden" id="image_file">
                                    <label for="image_file" class="w-full h-48 border-2 border-dashed border-slate-200 rounded-[2rem] flex flex-col items-center justify-center gap-2 cursor-pointer hover:bg-slate-50 transition-colors">
                                        <span class="material-symbols-outlined text-slate-400 text-3xl">cloud_upload</span>
                                        <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Klik untuk Upload File</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Tanggal Publish (Opsional)</label>
                            <input type="date" name="published_at" value="{{ old('published_at') }}" class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900">
                        </div>
                    </div>
                </div>

                <div class="pt-10 border-t border-slate-50 flex items-center justify-end gap-4">
                    <a href="{{ route('admin.articles.index') }}" class="px-8 py-4 font-black text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-widest text-sm">Batal</a>
                    <button type="submit" class="px-12 py-4 bg-primary text-white font-black rounded-full shadow-xl shadow-primary/30 hover:scale-105 active:scale-95 transition-all uppercase tracking-widest">
                        Simpan Berita
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
